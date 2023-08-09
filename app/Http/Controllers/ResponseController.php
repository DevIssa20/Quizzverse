<?php

namespace App\Http\Controllers;

use App\Models\Quizze;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{

    // Show response
    public function show(Request $request){
        $quizze = $request->session()->get('quizze');
        $questions = $quizze->questions;
        $questionResponses = [];
        foreach($questions as $question => $att){
            $questionResponses[$att['id']] = Response::where('user_id', auth()->user()->id)
            ->where('question_id', $att['id'])->get();
        }
        return view("responses.show", ['quizze' => $quizze, 'user_id' => auth()->user()->id, 'questions' => $questions, 'questionResponses' => $questionResponses])->with('message', 'Response submitted successfully');
    }

    // Store Response
    public function store(Request $request){
        $quizze_id = $request->input('quizze_id');
        if (Response::where('user_id' ,auth()->user()->id)->where('quizze_id', $quizze_id)->exists()) {
            return back()->with('message', "You've alread submitted this quizz");
        }
        $questionAnswers = [];
        $oldval = "";
        foreach ($request->all() as $key => $val){
            if(preg_match("/^question_id_[0-9]+$/", $key)){
                $questionAnswers[$val] = [];
                $oldval = $val;
            }
            else if(preg_match("/^q[0-9]+answer([0-9]+)?$/", $key)){
                array_push($questionAnswers[$oldval], $val);
            }
        }
        foreach ($questionAnswers as $question => $answer){
            $q = Question::find($question);
            if($q['type'] == 'MSQ'){
                $trueAnswer = array_map('trim', explode(',', $q['answer']));
                sort($trueAnswer); sort($answer);
                $correct = $trueAnswer === $answer;
                $formFields = [
                    'quizze_id' => $q['quizze_id'],
                    'question_id' => $q['id'],
                    'answer' => implode(",", $answer),
                    'true_answer' => $q['answer'],
                    'grade' => $q['grade'],
                    'correct' => $correct,
                    'user_id' => auth()->user()->id
                ];
                $r = Response::create($formFields);
            }
            else{
                if(!isset($answer[0])) $answer[0] = "";
                $correct = $q['answer'] == $answer[0];
                $formFields = [
                    'quizze_id' => $q['quizze_id'],
                    'question_id' => $q['id'],
                    'answer' => $answer[0],
                    'true_answer' => $q['answer'],
                    'grade' => $q['grade'],
                    'correct' => $correct,
                    'user_id' => auth()->user()->id
                ];
                $r = Response::create($formFields);
            }
        }

        $quizze = Quizze::find($quizze_id);
        return redirect("responses/viewResponse")->with(['quizze' => $quizze, 'message' => "Quizz submitted successfully"]);
    }
}

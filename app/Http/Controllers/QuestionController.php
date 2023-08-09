<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    // Show Create Question Form
    public function create(Request $request){
        $quizze_id = $request->input('quizze_id');
        return view('questions.create', ["quizze_id" => $quizze_id]);
    }

    // Store Question in Quizz
    public function store(Request $request){
        $formFields = [];
        if($request->input('type') == 'Text'){
            $formFields = $request->validate([
                'type' => 'required',
                'title' => 'required',
                'answer' => 'required',
                'grade' => 'required',
                'quizze_id' => 'required'
            ]);
            $formFields['choices'] = NULL;
        }
        else if($request->input('type') == 'MSQ'){
            $formFields = $request->validate([
                'type' => 'required',
                'title' => 'required',
                'choices' => 'required',
                'answer' => ['required', function(string $attribute, mixed $value, Closure $fail) use ($request){
                    $answerArr = array_map('trim', explode(',', $request->input('answer')));
                    $choicesArr = array_map('trim', explode(',', $request->input('choices')));
                    if(!(array_intersect($answerArr, $choicesArr) == $answerArr)){
                        $fail('Answers must be subset of choices for MSQ question');
                    }
                }],
                'grade' => 'required',
                'quizze_id' => 'required'
            ]);
        }
        else{
            $formFields = $request->validate([
                'type' => 'required',
                'title' => 'required',
                'choices' => 'required',
                'answer' => ['required', Rule::in(array_map('trim', explode(',', $request->input('choices'))))],
                'grade' => 'required',
                'quizze_id' => 'required'
            ]);
        }
        $formFields['description'] = $request->input('description');
        
        Question::create($formFields);
        $quizzID = $request->input('quizze_id');
        return redirect("/quizzes/$quizzID/edit")->with("message", "New question created !");
    }

    // Delete Quizz
    public function destroy(Question $question){
        $question->delete();
        return redirect('/quizzes/' . $question->quizze_id . '/edit')->with('message', 'Question Deleted Successfully');
    }
}

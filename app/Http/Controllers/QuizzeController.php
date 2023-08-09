<?php

namespace App\Http\Controllers;

use App\Models\Quizze;
use App\Models\Response;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;

use function PHPUnit\Framework\isEmpty;

class QuizzeController extends Controller
{
    // Show all quizzes
    public function index(){
        return view('quizzes.index', [
            //'listings' => Listing::all()
            'quizzes' => Quizze::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show one quizz
    public function show(Quizze $quizze){
        return view('quizzes.show', ['quizze' => $quizze, 'questions' => $quizze->questions]);
    }

    public function viewResponses(Quizze $quizze){
        if(auth()->user()->id != $quizze->user_id){
            return redirect('/')->with('message', 'Unauthorized access');
        }
        $url = $_SERVER["REQUEST_URI"];
        $responseNum = explode("/", $url);
        $responseNum = $responseNum[count($responseNum) - 1];
        $userIDs = json_decode(json_encode(DB::table('Responses')->select('user_id')->distinct()
        ->where('quizze_id', '=', $quizze->id)->get()->toArray(), true));
        if(count($userIDs) == 0){
            return view("/quizzes/viewResponses", ['quizze' => $quizze, 'empty' => 1]);
        }
        $userArr = [];
        foreach($userIDs as $key => $val){
            $userArr[] = $val->user_id;
        }

        if($responseNum <= -1) $responseNum = count($userArr) - 1;
        else if($responseNum >= count($userArr)) $responseNum = 0;
        
        $responseUserID = $userArr[$responseNum];

        $questions = $quizze->questions;
        $questionResponses = [];
        foreach($questions as $question => $att){
            if(Response::where('user_id', $responseUserID)->exists()){
                $questionResponses[$att['id']] = Response::where('user_id', $responseUserID)
                ->where('question_id', $att['id'])->get();
            }
        }
        $userName = User::find($responseUserID)->name;
        return view("/quizzes/viewResponses", ['quizze' => $quizze, 'userName' => $userName, 'questions' => $questions, 'questionResponses' => $questionResponses, 'responseUserID' => $responseUserID, 'userArr' => $userArr, 'responseNum' => $responseNum, 'empty' => 0]);
    }

    // Show create form
    public function create(Request $request){
        $questions = $request->session()->get('questions');
        if(!isset($questions)) $questions = [];
        return view('quizzes.create', ['questions' => $questions]);
    }

    // Store Quizz (Confidguartion)
    public function storeConfig(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
        ]);

        if($request->private == 1) $formFields['private'] = True;
        else $formFields['private'] = False;

        if(isset($request->description)) $formFields['description'] = $request->description;

        $formFields['user_id'] = auth()->id();
        $newQuiz = Quizze::create($formFields);
        return redirect("/quizzes/$newQuiz->id/edit")->with('message', 'Quizz Created Successfully');
    }

    // Update Quizz (Configuration)
    public function updateConfig(Request $request, Quizze $quizze){

        $formFields = $request->validate([
            'title' => 'required',
            'tags' => 'required',
        ]);

        if(isset($request->description)) $formFields['description'] = $request->description;

        if($request->private == 1) $formFields['private'] = True;
        else $formFields['private'] = False;

        $quizze->update($formFields);

        return redirect("/quizzes/$quizze->id/edit")->with('message', 'Quizz Updated Successfully');
    }

    // Show edit data
    public function edit(Quizze $quizze){
        if(auth()->user()->id != $quizze->user_id){
            return redirect('/')->with('message', 'Unauthorized access');
        }
        return view('quizzes.edit', ['quizze' => $quizze, 'questions' => $quizze->questions]);
    }

    // Show edit configuration form
    public function editConfig(Quizze $quizze){
        if(auth()->user()->id != $quizze->user_id){
            return redirect('/')->with('message', 'Unauthorized access');
        }
        return view('quizzes.editConfig', ['quizze' => $quizze]);
    }

    // Delete Quizz
    public function destroy(Quizze $quizze){
        if(auth()->user()->id != $quizze->user_id){
            return redirect('/')->with('message', 'Unauthorized access');
        }
        $quizze->delete();
        return redirect('/quizzes/manage')->with('message', 'Quizz Deleted Successfully');
    }

    // Manage Quizz
    public function manage(){
        return view('quizzes.manage', ['quizzes' => auth()->user()->quizzes]);
    }
}

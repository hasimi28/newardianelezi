<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asker;
use App\Questions;
use Mews\Purifier\Facades\Purifier;

class AskController extends Controller
{
    public function index(){

        return view('ask');

    }

    public function view_questions(){


     $questions = Questions::where('status_public','=','2')->orderBy('created_at','desc')->paginate(20);

     return view('vquestions')->withQuestions($questions);

    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'question' => 'required',
            'question_title' => 'required',
            'status_public' => 'required',
        ]);

            $asker = new Asker();
            $asker->name = $request->name;
            $asker->email = $request->email;

            if($asker->save()){

                $question = new Questions();
                $question->status_public = $request->status_public;
                $question->question_title = $request->question_title;
                $question->question = Purifier::clean($request->question);
                $question->asker_id = $asker->id;

                $question->save();

                return redirect()->back()->with('success','Pyetja juaj u dergua dhe pret te shqyrtohet');
            }

    }


}

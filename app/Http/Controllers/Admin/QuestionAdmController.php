<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Questions;
use App\Asker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mews\Purifier\Facades\Purifier;

class QuestionAdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('on-answer')) {
        $questions = Questions::all();

        return view('backend.pages.questions')->withQuestions($questions);

        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        if (Auth::user()->can('on-answer')) {
        return view('backend.pages.add_question');
    }else{

        return redirect()->back()->with('success','Nuk keni qasje');
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('on-answer')) {
        $this->validate($request, [
            'question' => 'required',
            'question_title' => 'required',
        ]);

        $asker = new Asker();
        $asker->name = 'Anonym';
        $asker->email = 'ardianelezi@hotmail.com';

        if ($asker->save()) {

            $question = new Questions();
            $question->status_public = $request->status_public;
            $question->question_title = $request->question_title;
            $question->question = Purifier::clean($request->question);
            $question->asker_id = $asker->id;

            $question->save();

            return redirect('backend/questions/'.$question->id)->with('success', 'Pyetja juaj u shtua me sukses');
        }

        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->can('on-answer')) {
        $question = Questions::findOrFail($id);
        return view('backend.pages.viewquestion')->withQuestion($question);

        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('on-answer')) {
        $questions = Questions::findOrFail($id);
        return view('backend.pages.question_edit')->withQuestions($questions);

        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('on-answer')) {

        $questions = Questions::findOrFail($id);

        $questions->question_title = $request->question_title;
        $questions->question = Purifier::clean($request->question);

        $questions->save();

        return redirect()->back()->with('success','Pyetja u ndryshua me sukses');


        }else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $val = input::get('val');

        if (Auth::user()->can('on-answer')) {


            $questions = Questions::findOrFail($val);
            $questions->asker->delete();


            $questions->delete();



            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'Nuk keni qasje'
            ], 200);
        }



    }



}

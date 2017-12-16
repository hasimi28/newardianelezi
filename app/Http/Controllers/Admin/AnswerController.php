<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Answer;
use App\Questions;
use Mews\Purifier\Facades\Purifier;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'answer_title' => 'required',
            'answer' => 'required',
            'questions_id' => 'required',
            'status_public' => 'required',
        ]);

        $answer = new Answer();
        $answer->answer_title = $request->answer_title;
        $answer->answer =  Purifier::clean($request->answer);
        $answer->questions_id = $request->questions_id;

        if($answer->save()){

                    $questions = Questions::find($request->questions_id);
                    $questions->status_public = $request->status_public;
                    $questions->save();
                    return redirect()->back();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        return view('backend.pages.answer_edit')->withAnswer($answer);
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

        $this->validate($request, [
            'answer_title' => 'required',
            'answer' => 'required',

        ]);

        $answer = Answer::findOrFail($id);
        $answer->answer_title = $request->answer_title;
        $answer->answer = Purifier::clean($request->answer);
        $answer->save();

        $question = Questions :: findOrFail($answer->questions->id);
        $question->status_public = $request->status_public;
        $question->save();

        return redirect('backend/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

<?php

namespace App\Http\Controllers;

use App\Video_Category_De;
use App\Video_de;
use Illuminate\Http\Request;

class VideodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Video_Category_De::all();
        $video = Video_de::orderBy('id','desc')->get();
        $video_category = Video_Category_De::all();
        return view('videode')->withVideo($video)->withVideocategory($video_category)->withAll($all);




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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $cat = Video_Category_De::where('name',$name)->get();
        $all = Video_Category_De::all();

        foreach($cat as $s){
            $video = Video_de::where('category_id',$s->id)->get();
            return view('videode')->withVideo($video)->withCat($cat)->withAll($all);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

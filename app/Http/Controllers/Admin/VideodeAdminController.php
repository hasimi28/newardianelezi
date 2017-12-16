<?php

namespace App\Http\Controllers\Admin;

use App\Video_Category_De;
use App\Video_de;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class VideodeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video_de::paginate(10);

        return view('backend.pages.video_de')->withVideo($video);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Video_Category_De::all();
        return view('backend.pages.add_video_de')->withCat($cat);
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
            'title' => 'required',
            'video__category_id' => 'required',
            'youtube_id' => 'required',

        ]);

        $video = New Video_de;
        $video->title = $request->title;
        $video->youtube_id = $request->youtube_id;
        $video->category_id = $request->video__category_id;
        $video->filename = 'nofile';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('postimages/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            $video->image = $filename;

        }


        $video->save();
        return redirect('backend/videomanagerde');
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
        $categories = Video_Category_De::all()->pluck('name','id');
        $video = Video_de::findOrFail($id);


        return view('backend.pages.edit_video_de')->withVideo($video)->withCategories($categories);
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
            'title' => 'required',
            'video__category_id' => 'required',
            'youtube_id' => 'required',

        ]);

        $video = Video_de::findOrFail($id);
        $video->title = $request->title;
        $video->youtube_id = $request->youtube_id;
        $video->category_id = $request->video__category_id;
        $video->filename = 'nofile';

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('postimages/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);

            if(file_exists('postimages/'.$video->image)){
                @unlink('postimages/'.$video->image);
            }

            $video->image = $filename;
        }


        $video->save();
        return redirect('backend/videomanagerde');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video_de::findOrFail($id)->delete();
        return redirect('backend/videomanagerde');
    }
}

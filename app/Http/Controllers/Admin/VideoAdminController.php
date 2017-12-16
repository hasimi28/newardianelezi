<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Video_Category;
use Intervention\Image\Facades\Image;

class VideoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $video = Video::paginate(10);

        return view('backend.pages.video')->withVideo($video);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Video_Category::all();
        return view('backend.pages.add_video')->withCat($cat);
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



        $video = New Video;
        $video->title = $request->title;
        $video->youtube_id = $request->youtube_id;
        $video->video__category_id = $request->video__category_id;
        $video->filename = 'nofile';

        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('postimages/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            $video->image = $filename;

        }


        $video->save();
        return redirect('backend/videomanager');

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
    {   $categories = Video_Category::all()->pluck('name','id');
        $video = Video::findOrFail($id);


        return view('backend.pages.edit_video')->withVideo($video)->withCategories($categories);
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

        $video = Video::findOrFail($id);
        $video->title = $request->title;
        $video->youtube_id = $request->youtube_id;
        $video->video__category_id = $request->video__category_id;
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
        return redirect('backend/videomanager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect('backend/videomanager');
    }
}

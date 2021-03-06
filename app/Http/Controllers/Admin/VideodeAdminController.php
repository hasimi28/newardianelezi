<?php

namespace App\Http\Controllers\Admin;

use App\Video_Category_De;
use App\Video_de;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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

        if (Auth::user()->can('read-video')) {


        $video = Video_de::paginate(10);

        return view('backend.pages.video_de')->withVideo($video);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-video')) {
        $cat = Video_Category_De::all();
        return view('backend.pages.add_video_de')->withCat($cat);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
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

        if (Auth::user()->can('create-video')) {

        $this->validate($request, [
            'title' => 'required',
            'video__category_id' => 'required',


        ]);


        if($request->hasFile('video')){


            $this->validate($request, [

                'video' => 'required|mimes:mp4,avi,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'

            ]);
        }


        $video = New Video_de;
        $video->title = $request->title;
        $video->youtube_id = $request->youtube_id;
        $video->category_id = $request->video__category_id;


        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('postimages/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            $video->image = $filename;

        }


        if($request->hasFile('video')){

            $videofile = $request->file('video');
            $filename = time().'.'.$videofile->getClientOriginalExtension();
            $path = public_path().'/videoligjerata/';
            $videofile->move($path, $filename);
            $video->filename = $filename;

        }else{

            $video->filename = 'nofile';
        }



        $video->save();
        return redirect('backend/videomanagerde')->with('success', 'Video u shtua me sukses');;

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
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
        if (Auth::user()->can('update-video')) {

        $categories = Video_Category_De::all()->pluck('name','id');
        $video = Video_de::findOrFail($id);


        return view('backend.pages.edit_video_de')->withVideo($video)->withCategories($categories);


        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
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

        if (Auth::user()->can('update-video')) {

        $this->validate($request, [
            'title' => 'required',
            'video__category_id' => 'required',
//            'youtube_id' => 'required',

        ]);


        if($request->hasFile('video')){


            $this->validate($request, [

                'video' => 'required|mimes:mp4,avi,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'

            ]);
        }


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

        if($request->hasFile('video')) {

            $videofile = $request->file('video');
            $filename = time() . '.' . $videofile->getClientOriginalExtension();
            $path = public_path() . '/videoligjerata/';
            $videofile->move($path, $filename);

            if (file_exists('videoligjerata/' . $video->filename)) {
                @unlink('videoligjerata/' . $video->filename);

            }

            $video->filename = $filename;
        }else{

            $video->filename = 'nofile';
        }

        $video->save();
        return redirect('backend/videomanagerde')->with('success', 'Video u ndryshua me sukses');;


        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
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
        if (Auth::user()->can('delete-video')) {

       $video = Video_de::findOrFail($val);

        if ($video->filename == 'nofile') {

            $video->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);
        }else{

            if (file_exists('videoligjerata/' . $video->filename)) {
                @unlink('videoligjerata/' . $video->filename);

            }

            $video->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);
        }

        } else {

            return response()->json([
                'success' => false,
                'status' => 'Nuk keni qasje'
            ], 200);
        }
    }


}

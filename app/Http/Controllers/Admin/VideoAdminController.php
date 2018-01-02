<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Video_Category;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VideoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('read-video')) {

            $video = Video::paginate(10);

            return view('backend.pages.video')->withVideo($video);


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
            $cat = Video_Category::all();
            return view('backend.pages.add_video')->withCat($cat);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->can('create-video')) {
            $this->validate($request, [
                'title' => 'required',
                'video__category_id' => 'required',
//          'video' => 'required|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'

            ]);

            if ($request->hasFile('video')) {


                $this->validate($request, [

                    'video' => 'required|mimes:mp4,avi,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'

                ]);
            }


            $video = New Video;
            $video->title = $request->title;
            $video->youtube_id = $request->youtube_id;
            $video->video__category_id = $request->video__category_id;


            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('postimages/' . $filename);
                Image::make($image)->resize(800, 600)->save($location);
                $video->image = $filename;

            }


            if ($request->hasFile('video')) {

                $videofile = $request->file('video');
                $filename = time() . '.' . $videofile->getClientOriginalExtension();
                $path = public_path() . '/videoligjerata/';
                $videofile->move($path, $filename);
                $video->filename = $filename;

            } else {

                $video->filename = 'nofile';
            }


            $video->save();
            return redirect('backend/videomanager');

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->can('update-video')) {

            $categories = Video_Category::all()->pluck('name', 'id');
            $video = Video::findOrFail($id);


            return view('backend.pages.edit_video')->withVideo($video)->withCategories($categories);

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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


            if ($request->hasFile('video')) {


                $this->validate($request, [

                    'video' => 'required|mimes:mp4,avi,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'

                ]);
            }


            $video = Video::findOrFail($id);
            $video->title = $request->title;
            $video->youtube_id = $request->youtube_id;
            $video->video__category_id = $request->video__category_id;


            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('postimages/' . $filename);
                Image::make($image)->resize(800, 600)->save($location);

                if (file_exists('postimages/' . $video->image)) {
                    @unlink('postimages/' . $video->image);
                }

                $video->image = $filename;
            }


            if ($request->hasFile('video')) {

                $videofile = $request->file('video');
                $filename = time() . '.' . $videofile->getClientOriginalExtension();
                $path = public_path() . '/videoligjerata/';
                $videofile->move($path, $filename);

                if (file_exists('videoligjerata/' . $video->filename)) {
                    @unlink('videoligjerata/' . $video->filename);

                }

                $video->filename = $filename;
            } else {

                $video->filename = 'nofile';
            }


            $video->save();
            return redirect('backend/videomanager');

        } else {

            return redirect()->back()->with('success', 'Nuk keni qasje');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete-video')) {

            $video = Video::findOrFail($id);


            if ($video->filename == 'nofile') {

                $video->delete();

                return redirect('backend/videomanager');
            } else {

                if (file_exists('videoligjerata/' . $video->filename)) {
                    @unlink('videoligjerata/' . $video->filename);

                }

                $video->delete();

                return redirect('backend/videomanager');
            }
        } else{

return redirect()->back()->with('success','Nuk keni qasje');
}


    }


}
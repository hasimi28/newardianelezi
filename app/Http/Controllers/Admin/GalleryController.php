<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Gallery;
use App\CatGallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('read-galery')) {

        $cat = CatGallery::all();
        $galery = Gallery::all();
        return view('backend.pages.galery')->withCat($cat)->withGalery($galery);

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-galery')) {
        $cat = CatGallery::all();
        return view('backend.pages.add_galery')->withCat($cat);

        } else{

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
        if (Auth::user()->can('create-galery')) {
        $gallery = new Gallery;

            $img = $request->file('file');

        if ($request->hasFile('file')) {
            $filename = $request->file('file');
            //$this->validate($request,[
            // 'file' => 'required',
            // 'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // ]); Add laravel validate if you wish
            foreach ($filename as $n => $file) {
                $k = $n+1;
                $filenames =  time().'.'.$filename[$n]->getClientOriginalName();
                $gallery->image = $filenames;
                $gallery->category_id = $request->category_id;
                $location = public_path('gallery/' . $filenames);
                Image::make($file)->resize(800, 600)->save($location);

            }
            $gallery->save();
        }

        } else{

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

        $val = input::get('val');

        if (Auth::user()->can('delete-galery')) {


        $gal = Gallery::find($val);


        if(file_exists('gallery/'.$gal->image)){
            @unlink('gallery/'.$gal->image);
        }

        $gal->delete();

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

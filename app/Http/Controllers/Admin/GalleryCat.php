<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CatGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GalleryCat extends Controller
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
       return view('backend.pages.gallery_cat')->withCat($cat);

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
        if (Auth::user()->can('create-galery')) {

        $this->validate($request, [
            'name_sq' => 'required|max:255',
            'name_de' => 'required|max:255',
        ]);


        $tag = New CatGallery();
        $tag->name_sq = $request->name_sq;
        $tag->name_de = $request->name_de;

        $tag->save();

        Session::flash('success','Kategoria u shtua me sukses');

        return redirect()->back();

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
        if (Auth::user()->can('update-galery')) {

        $cat = CatGallery::findOrFail($id);
        return view('backend.pages.edit_gallerycat')->withCat($cat);

        } else{

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
        if (Auth::user()->can('update-galery')) {


        $this->validate($request, [
            'name_sq' => 'required|max:255',
            'name_de' => 'required|max:255',
        ]);

        $cat = CatGallery::findOrFail($id);
        $cat->name_sq = $request->name_sq;
        $cat->name_de = $request->name_de;

        $cat->save();

        Session::flash('success','Kategoria u ndryshua me sukses');

        return redirect('backend/gallerycat');


        } else{

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
        if (Auth::user()->can('delete-galery')) {


        $cat = CatGallery::find($id);

        foreach ($cat->gallery as $gall) {

            if (file_exists('gallery/' . $gall->image)) {
                @unlink('gallery/' . $gall->image);
            }

            $gall->delete();
        }




        $cat->delete();

        Session::flash('success','Kategoria u fshi me sukses');
        return redirect('backend/gallerycat');

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }
}

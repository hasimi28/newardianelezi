<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CatGallery;
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

       $cat = CatGallery::all();
       return view('backend.pages.gallery_cat')->withCat($cat);
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
            'name_sq' => 'required|max:255',
            'name_de' => 'required|max:255',
        ]);


        $tag = New CatGallery();
        $tag->name_sq = $request->name_sq;
        $tag->name_de = $request->name_de;

        $tag->save();

        Session::flash('success','Kategoria u shtua me sukses');

        return redirect()->back();
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
        $cat = CatGallery::findOrFail($id);
        return view('backend.pages.edit_gallerycat')->withCat($cat);
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
            'name_sq' => 'required|max:255',
            'name_de' => 'required|max:255',
        ]);

        $cat = CatGallery::findOrFail($id);
        $cat->name_sq = $request->name_sq;
        $cat->name_de = $request->name_de;

        $cat->save();

        Session::flash('success','Kategoria u ndryshua me sukses');

        return redirect('backend/gallerycat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = CatGallery::find($id);

        $cat->delete();

        Session::flash('success','Kategoria u fshi me sukses');
        return redirect('backend/gallerycat');
    }
}

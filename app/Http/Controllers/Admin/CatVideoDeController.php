<?php

namespace App\Http\Controllers\Admin;

use App\Video_Category_De;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatVideoDeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catde = Video_Category_De::all();
        return view('backend.pages.video_category_de')->withCatde($catde);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.add_videocategoryde');
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

            'name' => 'required|unique:video_categories_de,name',


        ]);

        $category = new Video_Category_De();
        $category->name = $request->name;
        $category->save();

        return redirect('backend/categorymanagerde')->with('success','Kategoria u shtua me sukses');
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
        $catde = Video_Category_De::findOrFail($id);
        return view('backend.pages.edit_videocat')->withCatde($catde);
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
        $cat = Video_Category_De::find($id);

        $this->validate($request, [

            'name' => 'required|unique:video_categories_de,name,' . $cat->id,

        ]);

        $cat->name = $request->name;
        $cat->save();

        return redirect('backend/categorymanagerde')->with('success','Kategoria u ndryshua me sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Video_Category_De::find($id);
        $cat->delete();

        return redirect('backend/categorymanagerde')->with('success','Kategoria u fshi me sukses');
    }
}

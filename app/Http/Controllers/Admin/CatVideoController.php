<?php

namespace App\Http\Controllers\Admin;

use App\Video_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Video_Category::all();
        return view('backend.pages.video_category')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.pages.add_videocategory');
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

            'name' => 'required|unique:video_categories,name',


        ]);

        $category = new Video_Category();
        $category->name = $request->name;
        $category->save();

        return redirect('backend/categorymanager')->with('success','Kategoria u shtua me sukses');
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
        $cat = Video_Category::findOrFail($id);
        return view('backend.pages.edit_videocat')->withCat($cat);

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
        $cat = Video_Category::find($id);

        $this->validate($request, [

            'name' => 'required|unique:video_categories,name,' . $cat->id,

        ]);

        $cat->name = $request->name;
        $cat->save();

        return redirect('backend/categorymanager')->with('success','Kategoria u ndryshua me sukses');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Video_Category::find($id);
        $cat->delete();

        return redirect('backend/categorymanager')->with('success','Kategoria u fshi me sukses');
    }
}

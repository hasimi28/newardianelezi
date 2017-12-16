<?php

namespace App\Http\Controllers\Admin;

use App\PostCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryPost extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $postcategory = PostCategory::orderBy('id','desc')->get();

        return view('backend.pages.postcategory')->withPostcategory($postcategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.add_categorypost');
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
            'name_sq' => 'required|unique:post_categories',
            'name_de' => 'required|unique:post_categories',
        ]);


        $cat = New PostCategory;
        $cat->name_sq = $request->name_sq;
        $cat->name_de = $request->name_de;

        $cat->save();

        Session::flash('success','Kategoria u shtua me sukses');

        return redirect()->route('category.index');
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
       $cat = PostCategory::findOrFail($id);
       return view('backend.pages.edit_cat')->withCat($cat);
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

        $cat = PostCategory::findOrFail($id);

        $this->validate($request, [
            'name_sq' => 'required|unique:post_categories,name_sq,'.$cat->id,
            'name_de' => 'required|unique:post_categories,name_de,'.$cat->id
        ]);


        $cat->name_sq = $request->name_sq;
        $cat->name_de = $request->name_de;

        $cat->save();

        Session::flash('success','Kategoria u ndryshua me sukses');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostCategory::findOrFail($id)->delete();

        Session::flash('success','Kategoria u fshi me sukses');

        return redirect()->back();
    }
}

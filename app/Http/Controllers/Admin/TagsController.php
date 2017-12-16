<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TagsController extends Controller
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
    {   $tags = Tag::all();
        return view('backend.pages.view_tags')->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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


        $tag = New Tag;
        $tag->name_sq = $request->name_sq;
        $tag->name_de = $request->name_de;

        $tag->save();

        Session::flash('success','Tagi u shtua me sukses');

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
        $tags = Tag::findOrFail($id);
        return view('backend.pages.showtag')->withTags($tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::findOrFail($id);
        return view('backend.pages.edit_tags')->withTags($tags);
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

        $tag = Tag::findOrFail($id);
        $tag->name_sq = $request->name_sq;
        $tag->name_de = $request->name_de;

        $tag->save();

        Session::flash('success','Tagi u ndryshua me sukses');

        return redirect('backend/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success','Tagi u fshi me sukses');
        return redirect('backend/tags');
    }
}

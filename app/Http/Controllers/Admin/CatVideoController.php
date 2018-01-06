<?php

namespace App\Http\Controllers\Admin;

use App\Video_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CatVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('read-video')) {


        $categories = Video_Category::all();
        return view('backend.pages.video_category')->withCategories($categories);

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

            if (Auth::user()->can('create-video')) {


                return view('backend.pages.add_videocategory');

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
        if (Auth::user()->can('create-video')) {

        $this->validate($request, [

            'name' => 'required|unique:video_categories,name',


        ]);

        $category = new Video_Category();
        $category->name = $request->name;
        $category->save();

        return redirect('backend/categorymanager')->with('success','Kategoria u shtua me sukses');

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
        if (Auth::user()->can('update-video')) {


        $cat = Video_Category::findOrFail($id);
        return view('backend.pages.edit_videocat')->withCat($cat);

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

        if (Auth::user()->can('update-video')) {


        $cat = Video_Category::find($id);

        $this->validate($request, [

            'name' => 'required|unique:video_categories,name,' . $cat->id,

        ]);

        $cat->name = $request->name;
        $cat->save();

        return redirect('backend/categorymanager')->with('success','Kategoria u ndryshua me sukses');

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


        $val = input::get('val');

        if (Auth::user()->can('delete-video')) {

        $cat = Video_Category::find($val);
        $cat->delete();

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

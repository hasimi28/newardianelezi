<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Mews\Purifier\Facades\Purifier;

class AdminPost extends Controller
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
        if (Auth::user()->can('read-post')) {
            $post = Post::all();

            return view('backend.pages.view_post')->withPosts($post);

        }
        else{

                return redirect()->back()->with('message','Nuk keni qasje');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-post')) {

            $tags = Tag::all();
            $postcategory = PostCategory::all();
            return view('backend.pages.create_post')->withPostcategory($postcategory)->withTags($tags);

        }else{

            return redirect()->back()->with('message','Nuk keni qasje');
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

        if (Auth::user()->can('create-post')) {

        $this->validate($request, [
            'title_sq' => 'required|min:5|max:255|unique:posts,title_sq',
            'title_de' => 'required|min:5|max:255|unique:posts,title_de',

            'desc_sq' => 'required',
            'desc_de' => 'required',
            'image' => 'required|image',
        ]);

        $post = new Post;



        $slug_sq = str_slug($request->title_sq, "-");
        $slug_de = str_slug($request->title_de, "-");


        $post->title_sq = $request->title_sq;
        $post->title_de = $request->title_de;
        $post->slug_sq =  $slug_sq;
        $post->slug_de =  $slug_de;
        $post->desc_sq = Purifier::clean($request->desc_sq);
        $post->desc_de = Purifier::clean($request->desc_de);
        $post->category_id = $request->category_id;


        if($request->hasFile('image')){

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('postimages/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            $post->image = $filename;

        }
        $post->save();
        $post->tags()->sync($request->tags,false);

        return redirect('backend/post')->with('success','Postimi u shtua me sukses');

        }else{

            return redirect()->back()->with('message','Nuk keni qasje');
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
        if (Auth::user()->can('update-post')) {

        $postcategory = PostCategory::all();
        $tags = Tag::all();
        $post = Post::find($id);

        $cats = array();

        foreach($postcategory as $category){

            $cats[$category->id] = $category->NameTrans('name');
        }

        $tag = array();

        foreach($tags as $t){

            $tag[$t->id] = $t->NameTrans('name');
        }


        return view('backend.pages.edit_post')->withPost($post)->withCategories($cats)->withTag($tag);

        }else{

            return redirect()->back()->with('message','Nuk keni qasje');
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

        if (Auth::user()->can('update-post')) {


        $post = Post::find($id);

        $this->validate($request, [
            'title_sq' => 'required|min:5|max:255|unique:posts,slug_sq,' . $post->id,
            'title_de' => 'required|min:5|max:255|unique:posts,slug_de,' . $post->id,
            'desc_sq' => 'required',
            'desc_de' => 'required',
            'image'   => 'image',
        ]);


            $slug_sq = str_slug($request->title_sq, "-");
            $slug_de = str_slug($request->title_de, "-");

        $post->title_sq = $request->title_sq;
        $post->title_de = $request->title_de;
        $post->slug_sq =  $slug_sq;
        $post->slug_de =  $slug_de;
        $post->desc_sq = Purifier::clean($request->desc_sq);
        $post->desc_de = Purifier::clean($request->desc_de);
        $post->category_id = $request->category_id;
        $post->updated_at = Carbon::now();


        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('postimages/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);

            if(file_exists('postimages/'.$post->image)){
                @unlink('postimages/'.$post->image);
            }

            $post->image = $filename;
        }



            $post->save();

        if(isset($request->tags)) {
            $post->tags()->sync($request->tags);
        }else{

            $post->tags()->sync(array());
        }
        return redirect()->back()->with('success','Ky Postim u ndryshua me sukses');

        }else{

            return redirect()->back()->with('message','Nuk keni qasje');
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

        if (Auth::user()->can('delete-post')) {


      $post = Post::find($val);
      $post->tags()->detach();


        if(file_exists('postimages/'.$post->image)){
            @unlink('postimages/'.$post->image);
        }

      $post->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);

        }else{

            return response()->json([
                'success' => false,
                'status' => 'Nuk keni qasje'
            ], 200);
        }
    }


}

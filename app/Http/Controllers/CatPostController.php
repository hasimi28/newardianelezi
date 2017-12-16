<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CategoryPost;
use Illuminate\Http\Request;
use App\Post;
use App\PostCategory;
use DB;

class CatPostController extends Controller
{


    public function posts($name){

        $cat = PostCategory::where('name_sq',strtolower($name))->orWhere('name_de',strtolower($name))->get();

        foreach($cat as $c){
            $posts = Post::where('category_id','=',$c->id)->paginate(10);
        }


        return view('postwithkat')->withCat($cat)->withPosts($posts);
    }


    public function idpost($slug)
    {

        $full_post = Post::where('slug_sq', '=', $slug)->orWhere('slug_de','=',$slug)->get();

        foreach ($full_post as $p){
        $next = Post::where('id', '>', $p->id)->first();
        $prev =  Post::where('id', '<', $p->id)->orderBy('id','desc')->first();
        $post_like_this = Post::where('title_sq', 'like', '%' . $p->title_sq . '%')
            ->orWhere('title_de', 'like', '%' . $p->title_de . '%')->take(2)->get();

        return view('fullpost')->withFullpost($full_post)->withNext($next)->withPrev($prev)->withPostlikethis($post_like_this);

        }
    }
}

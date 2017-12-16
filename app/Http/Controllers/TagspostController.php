<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagspostController extends Controller
{

    public function show($id)
    {
        $tags = Tag::findOrFail($id);
        $post = $tags->posts()->paginate(12);
        return view('postwtag')->withTags($tags)->withPost($post);
    }
}

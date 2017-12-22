<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatGallery;
use App\Gallery;
class GalleryController extends Controller
{



    public function index()
    {
        $cat = CatGallery::all();
        $gallery = Gallery::all();

        return view('gallery')->withCat($cat)->withGallery($gallery);
    }
}

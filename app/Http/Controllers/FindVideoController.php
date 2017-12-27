<?php

namespace App\Http\Controllers;

use App\Video_Category;
use Illuminate\Http\Request;
use App\Video;
use App\Video_de;
use Illuminate\Support\Facades\Input;

class FindVideoController extends Controller
{
    public function findsq(){

        $category_id = Input::get('category_id');


            $video = Video::where('video__category_id',$category_id)->get();



                return response()->json([
                    'video' => $video,

                ]);




    }


    public function urlvideo($cat,$videoname){



    }
}

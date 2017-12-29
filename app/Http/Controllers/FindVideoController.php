<?php

namespace App\Http\Controllers;

use App\Video_Category;
use App\Video_Category_De;
use Illuminate\Http\Request;
use App\Video;
use App\Video_de;
use Illuminate\Support\Facades\Input;

class FindVideoController extends Controller
{
    public function findsq(){

        $category_id = Input::get('category_id');


            $video = Video::where('video__category_id',$category_id)->orderBy('id','desc')->get();



                return response()->json([
                    'video' => $video,

                ]);




    }


    public function urlvideo($cat,$videoname){


        $video = Video::where('youtube_id',$videoname)->orWhere('filename',$videoname)->take(1)->get();

        $all = Video_Category::all();

        if(!empty($cat)){

            $category = Video_Category::where('name',$cat)->get();

            foreach($category as $c){


                $allvideo = $c->video;
            }


        }



        return view('onevideo')->withVideo($video)->withAllvideo($allvideo)->withAll($all);;

    }




    public function video(){


        $video = Video::all();

        $all = Video_Category::all();

        $allvideo = Video::orderBy('id','desc')->get();

        return view('onevideo')->withVideo($video)->withAllvideo($allvideo)->withAll($all);;

    }



    public function bycategory($name)
    {
        $video = Video_Category::all();;
        $cat = Video_Category::where('name',$name)->get();
        $all = Video_Category::all();

        if(count($cat)){
            foreach($cat as $s){

                $catname = Video_Category::where('name',$name)->get();

                $allvideo = Video::where('video__category_id',$s->id)->orderBy('id','desc')->get();
                return view('onevideo')->withAllvideo($allvideo)->withCat($cat)->withAll($all)->withVideo($video)->withCatname($catname);

            }

        }else{

                unset($cat);

                $cat = Video_Category::where('name',$name)->get();

                $allvideo = Video::where('youtube_id',$name)->orWhere('filename',$name)->take(1)->get();
                return view('onevideo')->withAllvideo($allvideo)->withCat($cat)->withAll($all)->withVideo($video);


        }


    }





    /////////////////////////////////////////////////////For deutch Video


    public function urlvideo_de($cat,$videoname){


        $video = Video_de::where('youtube_id',$videoname)->orWhere('filename',$videoname)->take(1)->get();

        $all = Video_Category_de::all();

        if(!empty($cat)){

            $category = Video_Category_de::where('name',$cat)->get();

            foreach($category as $c){


                $allvideo = $c->video;
            }


        }



        return view('onevideode')->withVideo($video)->withAllvideo($allvideo)->withAll($all);;

    }




    public function video_de(){


        $video = Video_de::all();

        $all = Video_Category_de::all();

        $allvideo = Video_de::orderBy('id','desc')->get();

        return view('onevideode')->withVideo($video)->withAllvideo($allvideo)->withAll($all);;

    }



    public function bycategory_de($name)
    {
        $video = Video_Category_De::all();;
        $cat = Video_Category_De::where('name',$name)->get();
        $all = Video_Category_De::all();

        if(count($cat)){
            foreach($cat as $s){

                $catname = Video_Category_De::where('name',$name)->get();

                $allvideo = Video_de::where('video__category_id',$s->id)->orderBy('id','desc')->get();
                return view('onevideode')->withAllvideo($allvideo)->withCat($cat)->withAll($all)->withVideo($video)->withCatname($catname);

            }

        }else{

            unset($cat);

            $cat = Video_Category_de::where('name',$name)->get();

            $allvideo = Video_de::where('youtube_id',$name)->orWhere('filename',$name)->take(1)->get();
            return view('onevideode')->withAllvideo($allvideo)->withCat($cat)->withAll($all)->withVideo($video);


        }


    }

}

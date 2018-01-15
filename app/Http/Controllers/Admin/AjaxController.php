<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Questions;
use App\User;
use App\Video;
use App\Video_Category;
use App\Video_Category_De;
use App\Video_de;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Carbon\Carbon;
use App\Post;
use App\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Mews\Purifier\Facades\Purifier;
class AjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function del_all_post(Request $request)
    {

            $all= input::get('val');



                $post = Post::find($all);
                $post->tags()->detach();


                if(file_exists('postimages/'.$post->image)){
                    @unlink('postimages/'.$post->image);
                }

                $post->delete();


                return response()->json([
                    'success' => true,
                    'status' => 'success'
                ], 200);

        }


   public function del_all_tags(){

       $all = input::get('val');

       if (Auth::user()->can('delete-tags')) {

           $tag = Tag::find($all);
           $tag->posts()->detach();

           $tag->delete();

           return response()->json([
               'success' => true,
               'status' => 'success'
           ], 200);

       } else{

           return response()->json([
               'success' => false,
               'status' => 'success'
           ], 404);
       }





   }


    public function del_all_questions(){

        $all= input::get('val');

        $questions = Questions::findOrFail($all);
        $questions->asker->delete();

        $questions->delete();


        return response()->json([
            'success' => true,
            'status' => 'success'
        ], 200);


    }



    public function del_all_video(){

        $all= input::get('val');

        if (Auth::user()->can('delete-video')) {

            $video = Video::findOrFail($all);


            if ($video->filename == 'nofile') {

                $video->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'success'
                ], 200);
            } else {

                if (file_exists('videoligjerata/' . $video->filename)) {
                    @unlink('videoligjerata/' . $video->filename);

                }

                $video->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'success'
                ], 200);
            }
        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }




    }


    public function del_all_videode(){

        $all= input::get('val');

        if (Auth::user()->can('delete-video')) {

            $video = Video_de::findOrFail($all);


            if ($video->filename == 'nofile') {

                $video->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'success'
                ], 200);

            } else {

                if (file_exists('videoligjerata/' . $video->filename)) {
                    @unlink('videoligjerata/' . $video->filename);

                }

                $video->delete();

                return response()->json([
                    'success' => true,
                    'status' => 'success'
                ], 200);
            }
        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }

    }



    public function del_all_videokatsq(){


        $all= input::get('val');

        if (Auth::user()->can('delete-video')) {



            $cat = Video_Category::find($all);
            $cat->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }


    }



    public function del_all_videokatde(){


        $all= input::get('val');

        if (Auth::user()->can('delete-video')) {



            $cat = Video_Category_De::find($all);
            $cat->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }


    }


    public function del_all_event(){

        $all = input::get('val');

        if (Auth::user()->can('delete-event')) {

            Event::find($all)->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }
    }

    public function del_all_users(){

        $all = input::get('val');

        if (Auth::user()->can('delete-event')) {

           User::find($all)->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }
    }




    public function del_cat_post(){

        $all = input::get('val');

        if (Auth::user()->can('delete-post')) {

            PostCategory::find($all)->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'success'
            ], 404);
        }
    }
}

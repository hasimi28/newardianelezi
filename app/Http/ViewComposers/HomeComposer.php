<?php

namespace App\Http\ViewComposers;
use App\Post;
use Carbon\Carbon;
use Illuminate\View\View;
use \GeniusTS\PrayerTimes\Prayer;
use \GeniusTS\PrayerTimes\Coordinates;
use App\PostCategory;

Class HomeComposer{


        public function compose(View $view){

            $longitude = 7.588576;
            $latitude = 47.559599;

            $prayer = new Prayer(new Coordinates($longitude, $latitude));
            // Or
            $prayer = new Prayer();
            $prayer->setCoordinates($longitude, $latitude);

            // Return an \GeniusTS\PrayerTimes\Times instance
            $times = $prayer->times(Carbon::now());
            $times->setTimeZone(+3);

            $imsaku = $times->fajr->format('h:i a');
            $dreka = $times->duhr->format('h:i a');
            $ikindia = $times->asr->format('h:i a');
            $akshami = $times->maghrib->format('h:i a');
            $jacia = $times->isha->format('h:i a');


            $array = ['kohet' => ['imsaku' => $imsaku,'dreka'=>$dreka,'ikindia'=>$ikindia,'akshami'=>$akshami,'jacia'=>$jacia]];

            $category = PostCategory::all();
            $category5 = PostCategory::all()->random()->get();;
            $new_post = Post::orderBy('id', 'DESC')->take(5)->get();


            $view->with('array',$array)
                ->with('category',$category)
                ->with('category5',$category5)
                ->with('new_post',$new_post);

        }


}
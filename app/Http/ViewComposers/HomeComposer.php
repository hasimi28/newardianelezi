<?php

namespace App\Http\ViewComposers;
use App\Post;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\View\View;
use \GeniusTS\PrayerTimes\Prayer;
use \GeniusTS\PrayerTimes\Coordinates;
use App\PostCategory;
use App\Gallery;
use App\Event;


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

            $home_gallery = Gallery::inRandomOrder()->take('4')->get();
            $home_gallery2 = Gallery::inRandomOrder()->take('1')->get();

            $event = Event::orderBy('id', 'DESC')->where('datetime','>=', Carbon::now())->take(1)->get();
            $five_event = Event::orderBy('id', 'DESC')->where('datetime','>=', Carbon::now())->take(5)->get();

                if(count($event)) {
                    foreach ($event as $ev) {

                        $seconds = strtotime($ev->datetime) - time();

                        $days = floor($seconds / 86400);
                        $seconds %= 86400;

                        $hours = floor($seconds / 3600);
                        $seconds %= 3600;

                        $minutes = floor($seconds / 60);
                        $seconds %= 60;

                    }

                }else{
                    $seconds = 0;

                    $days = 0;


                    $hours = 0;


                    $minutes = 0;

                }



            $view->with('array',$array)
                ->with('category',$category)
                ->with('category5',$category5)
                ->with('new_post',$new_post)
                ->with('home_gallery',$home_gallery)
                ->with('home_gallery2',$home_gallery2)
                ->with('days',$days)
                ->with('hours',$hours)
                ->with('minutes',$minutes)->with('event',$event)->with('five_event',$five_event);

        }


}
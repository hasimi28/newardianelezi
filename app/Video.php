<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Video extends Model
{

    protected $fillable = ['title','filename','youtube_id','video__category_id','image'];



    public function TextTrans($text)
    {


        $locale=App::getLocale();
        $column=$text.'_'.$locale;

        return $this->{$column};
    }


    public function video_category(){

        return $this->belongsTo('App\Video_Category','video__category_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{

    protected $fillable = ['title_sq','title_de','desc_sq','desc_de','category_id'];


    public function TextTrans($text)
    {
        $locale=App::getLocale();
        $column=$text.'_'.$locale;

        return $this->{$column};
    }


    public function categories(){

        return $this->belongsTo('App\PostCategory','category_id');
    }

    public function tags(){

        return $this->belongsToMany('App\Tag');
    }


}

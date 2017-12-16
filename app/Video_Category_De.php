<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_Category_De extends Model
{
    protected $table = 'video_categories_de';


    protected $fillable = ['name','category_id'];


    public function video_de(){

        return $this->hasMany('App\Video_de','category_id');
    }
}

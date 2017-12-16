<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_Category extends Model
{
    protected $table = 'video_categories';


    protected $fillable = ['name','category_id'];


    public function video(){

        return $this->hasMany('App\Video');
    }
}

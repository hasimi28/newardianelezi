<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_de extends Model
{
    protected $table = 'videos_de';
    protected $fillable = ['title','filename','youtube_id','category_id','image'];

    public function video_category_de(){

        return $this->belongsTo('App\Video_Category_De','category_id');
    }
}

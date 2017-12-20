<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $fillable = ['image','category_id'];

    public function catgallery(){

        return $this->belongsTo('App\CatGallery','category_id');
    }
}

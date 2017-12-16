<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    public function asker(){

        return $this->belongsTo('App\Asker');
    }


    public function answer(){

        return $this->hasOne('App\Answer');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asker extends Model
{
    public function questions(){

        return $this->hasMany('App\Questions');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Tag extends Model
{

    protected $fillable = ['name_sq','name_de'];


    public function NameTrans($name)
    {
        $locale=App::getLocale();
        $column=$name.'_'.$locale;

        return $this->{$column};
    }

    public function posts(){

        return $this->belongsToMany('App\Post');
    }
}

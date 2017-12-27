<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CatGallery extends Model
{

    protected $fillabke = ['name_sq','name_de'];


    public function gallery(){

        return $this->hasMany('App\Gallery','category_id');
    }


    public function NameTrans($name)
    {
        $locale=App::getLocale();
        $column=$name.'_'.$locale;

        return $this->{$column};
    }

}

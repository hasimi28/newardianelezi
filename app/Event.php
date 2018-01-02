<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Event extends Model
{

    protected $fillable = ['ti_sq','ti_de','des_sq','des_de','datetime','adress'];

    protected $date = ['datetime'];

    public function getDateTimeAttribute($date)
    {
        return Carbon::parse($date);

    }

    public function NameTrans($name)
    {
        $locale=App::getLocale();
        $column=$name.'_'.$locale;

        return $this->{$column};
    }


}

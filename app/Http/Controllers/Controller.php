<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    public function __construct()
    {
        Carbon::setLocale('sq');
        setlocale(LC_TIME, 'de');
    }


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

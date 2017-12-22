<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('locale')){

            $locale = Session::get('locale',Config::get('app.locale'));

            Carbon::setLocale($locale);

            setlocale(LC_TIME, 'de');
        }else{

            $locale = 'sq';
        }

        App::setLocale($locale);

        return $next($request);
    }
}

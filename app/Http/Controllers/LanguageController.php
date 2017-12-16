<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App;


class LanguageController extends Controller
{
    public function change_lang(Request $request){

        if($request->ajax()){

            Session::put('locale',Input::get('lang'));

            return response()->json([
                'success' => true,
                'message' => Input::get('locale')
            ], 200);



        }
    }


}

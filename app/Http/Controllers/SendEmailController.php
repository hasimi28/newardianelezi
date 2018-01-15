<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function SendMessage(){


        $data = ['title' => 'Selam Alejkum','content'=>'Mesazhi'];

        Mail::send('emails.sendemail', $data, function ($message) {
             $message->from('kadrihasimi86@gmail.com','Kadri');
            $message->to('kadrihasimi86@gmail.com','Kadri')->subject('ky eshte mesazhi');
        });


    }

}

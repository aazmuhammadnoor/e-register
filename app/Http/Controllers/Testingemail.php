<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class Testingemail extends Controller
{
    public function Tes($email)
    {
      Mail::send([], [], function($message) use($email){
               $message->to($email, 'Testing')->subject('Tes Kirim Email');
               $message->setBody('Halo Ganteng Maksimal!');
            });
      return "Kirim";
    }
}

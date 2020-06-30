<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{

    public function index()
    {
    	if(\Auth::guard('pendaftar')->user())
    	{
    		return redirect('/anggota');
    	}elseif(\Auth::user())
    	{
    		return redirect('/admin');
    	}else{
    		\Auth::guard('pendaftar')->logout();
    		\Auth::logout();
    	}
    	
        $title = "Beranda";
        return view('welcome',compact('title'));
    }

}

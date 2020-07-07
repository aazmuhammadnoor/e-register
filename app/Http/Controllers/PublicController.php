<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FormRegister;

class PublicController extends Controller
{

    public function index()
    {
    	if(\Auth::guard('registant')->user())
    	{
    		return redirect('/mypage');
    	}elseif(\Auth::user())
    	{
    		return redirect('/admin');
    	}else{
    		\Auth::guard('registant')->logout();
    		\Auth::logout();
    	}
    	
        $title = "Beranda";
        $form_register = FormRegister::where('utama',1)->first();
        return view('public',compact('title','form_register'));
    }

}

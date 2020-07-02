<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\TempRegister;

class RegisterController extends Controller
{
    /**
     * @method index
     * @param url
     * @return void
     */
    public function index($url)
    {
    	$form_register = FormRegister::where('url',$url)
    								->where('is_active',1)
    								->first();
    	if(!$form_register)
    	{
    		abort('404');
    	}

    	$title = $form_register->form_name;

    	return view('register',compact('title','form_register'));
    }
}

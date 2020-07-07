<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Register;
use App\Models\FormRegister;
use App\Models\RegisterFile;

class MyPageController extends Controller
{
    /**
     * construct
     */
    public function __construct() {
        $this->middleware('auth:registant');
    }

    /**
     * @method index
     * @return void
     */
    public function index()
    {
    	$auth = \Auth::guard('registant')->user();
    	$password_set = true;
    	if(!$auth->password)
    	{
    		$password_set = false;
    	}
    	$title = 'My Page';
    	$register = Register::where('registant',$auth->id)->get();
    	return view('my_page.index',compact('title','password_set','register'));
    }

    /**
     * @method register
     * @param $url
     * @param $register
     * @return void
     */
    public function register($url,$register)
    {
    	$auth = \Auth::guard('registant')->user();
    	$form_register = FormRegister::where('url',$url)->first();
    	if(!$form_register)
    	{
    		abort('404');
    	}
    	$register = Register::where('form_register',$form_register->id)
    							->where('id',$register)
    							->where('registant',$auth->id)
    							->first();
    	if(!$register)
    	{
    		abort('404');
    	}

    	$title = $form_register->form_name.' '.$register->register_number;

    	return view('my_page.register',compact('register','form_register','title','auth'));
    }

    /**
     * @method changePassword
     * @return void
     */
    public function changePassword()
    {
    	$auth = \Auth::guard('registant')->user();
    	$title = 'Ganti Password';

    	return view('my_page.password',compact('register','title','auth'));
    }

    /**
     * @method updatePassword
     * @param $r
     * @return void
     */
    public function updatePassword(Request $r)
    {
    	$auth = \Auth::guard('registant')->user();
    	$this->validate($r,[
    		'password' => 'required|confirmed|string|min:6'
    	]);

    	$auth->password = bcrypt($r->password);
    	$auth->save();

    	flash('Password Diubah')->success();
    	return redirect()->route('mypage.update.password');
    }

    /**
     * @method file
     * @param $r 
     * @param $form_register
     * @param $form_step 
     * @return JSON
     */
    public function file(Request $r,Register $register, RegisterFile $register_file)
    {
    	$auth = \Auth::guard('registant')->user();
        if($register->id != $register_file->register)
        {
            abort('404');
        }
        if($register->registant != $auth->id)
        {
        	abort('404');
        }
        $path = \Storage::path($register_file->file);
        return response()->file($path);
    }
}

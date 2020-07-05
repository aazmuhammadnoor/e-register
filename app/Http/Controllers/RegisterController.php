<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\Register;

class RegisterController extends Controller
{
    /**
     * construct
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @method index
     * @return void
     */
    public function index()
    {
    	$title = 'Register Lists';
    	$form_register = FormRegister::where('is_active',1)
    						->paginate(10);
        return view('admin.register.index',compact('title','form_register'));
    }

    /**
     * @method lists
     * @param $r
     * @param $form_register
     * @return JSOn
     */
    public function lists(Request $r, FormRegister $form_register)
    {
    	$register = Register::where('form_register',$form_register->id)
    						->join('registant','registant.id','register.registant')
    						->join('form_register','form_register.id','register.form_register');
    	if($r->has('email'))
    	{
    		if(!empty($r->email))
    		{
    			$register->where('registant.email','like','%'.$r->email.'%');
    		}
    	}

    	if($r->has('number'))
    	{
    		if(!empty($r->number))
    		{
    			$register->where('register.register_number','like','%'.$r->number.'%');
    		}
    	}

    	if($r->has('date'))
    	{
    		if(!empty($r->date))
    		{
    			$register->where('register.updated_at','like',$r->date.'%');
    		}
    	}
    	$register = $register->select('registant.*','register.*');
    	$register = $register->orderBy('register.updated_at','desc');
    	$register = $register->paginate(10);
    	return response()->json($register);
    }

    /**
     * @method detail
     * @return void
     */
    public function detail(Register $register)
    {
    	$title = ''.$register->thisFormRegister->form_name;
        return view('admin.register.detail',compact('title','register'));
    }
}

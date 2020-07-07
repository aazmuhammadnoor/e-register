<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Registant;
use Mail;
use App\Jobs\SendOTPRegister;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @method index
     * @param $r
     * @return void
     */
    public function index(Request $r)
    {
    	$this->validate($r,[
    		'email' => 'required'
    	]);
    	$registant = Registant::where('email',$r->email)->first();
    	if(!$registant)
    	{
    		flash('Email tidak terdaftar !')->error();
    		return redirect()->back();
    	}

    	$auth = 'otp';
    	if(empty($registant->password))
    	{
    		$auth = 'otp';
    	}else{
    		$auth = 'password';
    	}
    	$email = $r->email;

    	if($auth == 'otp')
    	{
    		return redirect()->route('login.otp',[$email]);
    	}else{
    		return redirect()->route('login.password',[$email]);
    	}
    }

    /**
     * @method password
     * @param email
     * @return void
     */
    public function password($email)
    {
    	$title = 'Login';
    	$registant = Registant::where('email',$email)->first();
    	if(!$registant)
    	{
    		flash('Email tidak terdaftar !')->error();
    		return redirect('login');
    	}

    	if($registant->password == null)
    	{
    		flash('Login Failed')->error();
    		return redirect('login');
    	}

    	return view('auth.anggota.password',compact('email','registant'));
    }

    /**
     * @method otp
     * @param email
     * @return void
     */
    public function otp($email)
    {
    	$title = 'Login';
    	$registant = Registant::where('email',$email)->first();
    	if(!$registant)
    	{
    		flash('Email tidak terdaftar !')->error();
    		return redirect('login');
    	}

    	if($registant->otp == null)
    	{
    		$this->createOTP($registant);
    	}

    	if(\Carbon\Carbon::now()->format('Y-m-d h:i:s') > $registant->otp_expired)
    	{
    		$this->createOTP($registant);
    	}

    	return view('auth.anggota.otp',compact('email','registant'));
    }

    protected function createOTP($registant)
    {
    	$auth = 'otp';
		$otp = rand(100000,999999);
		$en_otp = bcrypt($otp);

		$otp_expired = $registant->otp_expired;
		if(!$otp_expired)
		{
			$registant->otp_expired =  \Carbon\Carbon::now()->addMinutes(5)->format('Y-m-d h:i:s');
			$registant->otp = $en_otp;

			$job = (new SendOTPRegister($registant,$otp));
    		dispatch($job);

		}else{

			if(\Carbon\Carbon::now()->format('Y-m-d h:i:s') > $otp_expired)
			{
				$registant->otp_expired = \Carbon\Carbon::now()->addMinutes(5)->format('Y-m-d h:i:s');
				$registant->otp = $en_otp;

				$job = (new SendOTPRegister($registant,$otp));
    			dispatch($job);
			}
		}
		$registant->save();
    }

    /**
     * @method otpCheck
     * @param $r 
     * @return JSON
     */
    public function otpCheck(Request $r)
    {
    	$data = [
    		'email',
    		'otp'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'Param Error'
    		];
    		return response()->json($response);
    	}

    	$registant = Registant::where('email',$r->email)->first();
    	if(!$registant)
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'Email Not Found'
    		];
    		return response()->json($response);
    	}

    	if (!Hash::check($r->otp, $registant->otp)) {
            $response = [
    			'status' => 'error',
    			'message' => 'OTP Incorrect'
    		];
    		$registant->otp_attempt = $registant->otp_attempt+1;
    		$registant->save();

    		if($registant->otp_attempt >= 5)
    		{
    			$response = [
	    			'status' => 'error',
	    			'message' => 'Too Many Try'
	    		];
	    		$registant->otp_expired = null;
	    		$registant->otp = null;
	    		$registant->otp_attempt = 0;
	    		$registant->save();

	    		return response()->json($response);
    		}

            return response()->json($response);
        }else{

    		if(\Carbon\Carbon::now()->format('Y-m-d h:i:s') > $registant->otp_expired)
	    	{
	    		$response = [
	    			'status' => 'error',
	    			'message' => 'OTP Expired'
	    		];
	    		$registant->otp_expired = null;
	    		$registant->otp = null;
	    		$registant->otp_attempt = 0;
	    		$registant->save();
	    		return response()->json($response);
	    	}

        	$response = [
    			'status' => 'success',
    			'message' => ''
    		];

    		return response()->json($response);
        }
    	
    }

    public function loginWithOtp(Request $r)
    {
    	$this->validate($r,[
    		'email' => 'required',
    		'password' => 'required|string'
    	]);

    	$registant = Registant::where('email',$r->email)
    							->first();
    	if(!$registant)
    	{
    		flash('OTP Incorrect')->error();
    		return redirect()->back();
    	}
    	if (!Hash::check($r->password, $registant->otp)) {
    		flash('OTP Incorrect')->error();
    		return redirect()->back();
    	}
    	if(\Carbon\Carbon::now()->format('Y-m-d h:i:s') > $registant->otp_expired)
    	{
    		$registant->otp_expired = null;
    		$registant->otp = null;
    		$registant->otp_attempt = 0;
    		$registant->save();
    		flash('OTP Expired')->error();
    		return redirect()->back();
    	}
    	if(\Auth::guard('registant')->loginUsingId($registant->id))
	    {
	    	$registant->otp_expired = null;
    		$registant->otp = null;
    		$registant->otp_attempt = 0;
    		$registant->save();
	        return redirect()->intended('/mypage');
	    }   
	    else 
	    {
	    	flash('Login Failed')->error();
	        return redirect()->back();
	    }
    }
}

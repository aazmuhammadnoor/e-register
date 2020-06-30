<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use App\Models\Pendaftar;

class EmailController extends Controller
{
    // aktivasi
	public function aktivasiUlang()
	{
		return view('auth.anggota.resend_activation');
	}

	// aktivasi
	public function sendActivation(Request $r)
	{
		$this->validate($r, [
            'username'=>'required'
        ]);

        $pendaftar = Pendaftar::where(function($q) use ($r)
						        {
						        	$q->where("username",$r->username)
						        	  ->orWhere("email",$r->username);
						        });
       	if($pendaftar->count() > 0)
       	{
       		$pendaftar = $pendaftar->first();
	        $email = new ActivationEmail($pendaftar);
	        Mail::to($pendaftar->email)->send($email);
	        return view('auth.anggota.activation', ['pendaftar' => $pendaftar]);

       	}else{
       		flash('Username / Email belum terdaftar')->error();
			return redirect()->back();
       	}
        
	}
}

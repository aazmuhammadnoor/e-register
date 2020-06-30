<?php

namespace App\Http\Controllers\Auth\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use App\Jobs\SendResetEmail;
use Mail;
use App\Mail\ResetEmail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
      return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
      $this->validate($request, ['username' => 'required']);
      $pendaftar = Pendaftar::where(function($q) use ($request)
                    {
                      $q->where("username",$request->username)
                        ->orWhere("email",$request->username);
                    });
      if ($pendaftar->count() == 0) {
        flash('Username / Email tidak terdaftar')->error();
        return redirect('password/reset');
      }else{
        $pendaftar = $pendaftar->first();
      }

      if ($pendaftar->kode_aktivasi == null) {
          $pendaftar->kode_aktivasi = strtr(base64_encode(bcrypt($pendaftar->username.'b1smill2h'.$pendaftar->email.$pendaftar->password)), '+/=', '._-');
          $pendaftar->save();
      }

      $email = new ResetEmail($pendaftar);
      Mail::to($pendaftar->email)->send($email);

      flash('Link untuk reset password akan dikirim ke alamat email Anda. Silakan cek email Anda.')->success();
      return redirect('password/reset');
    }
}

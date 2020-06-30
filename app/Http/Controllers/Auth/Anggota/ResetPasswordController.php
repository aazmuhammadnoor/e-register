<?php

namespace App\Http\Controllers\Auth\Anggota;

use App\Models\Pendaftar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $pendaftar = Pendaftar::where('kode_aktivasi', $token)->first();
        if ($pendaftar == null) {
            abort(401);
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'username' => $pendaftar->username]
        );
    }

    public function reset(Request $request)
    {
        $this->validate($request, ['token' => 'required','password'=>'required|string|min:6|confirmed']);

        $pendaftar = Pendaftar::where('kode_aktivasi', $request->token)->first();
        if ($pendaftar == null) {
            abort(401);
        }

        $pendaftar->password = $request->password;
        $pendaftar->save();

        flash('Password baru Anda telah disimpan. Silakan login dengan menggunakan password baru Anda.')->success();
        return redirect('anggota/login');
    }
}

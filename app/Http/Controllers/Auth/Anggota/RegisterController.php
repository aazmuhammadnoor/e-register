<?php

namespace App\Http\Controllers\Auth\Anggota;

use App\Models\Pendaftar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Jobs\SendActivationEmail;

use App\Mail\ActivationEmail;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.anggota.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'=>'required|string|max:20|unique:m_pendaftar,username|regex:/^[\w-]*$/',
            'password'=>'required|string|min:6|max:16|confirmed',
            'email'=>'required|string|email|max:100|unique:m_pendaftar,email'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Pendaftar
     */
    protected function create(array $data)
    {
        $kode_aktivasi = strtr(base64_encode(bcrypt($data['username'].'b1smill2h'.$data['email'].$data['password'])), '+/=', '._-');
        return Pendaftar::create([
            'username' => $data['username'],
            'password' => $data['password'],
            'email' => $data['email'],
            'kode_aktivasi' => $kode_aktivasi
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    
        /*event(new Registered($pendaftar = $this->create($request->all())));

        $job = (new SendActivationEmail($pendaftar))->onQueue('aktivasi');

        dispatch($job);*/

        $pendaftar = $this->create($request->all());

        $email = new ActivationEmail($pendaftar);
        Mail::to($pendaftar->email)->send($email);

        return view('auth.anggota.activation', ['pendaftar' => $pendaftar]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function activation($code)
    {
        $pendaftar = Pendaftar::where('kode_aktivasi', $code)->first();
        if ($pendaftar != null) {
            $pendaftar->is_aktif = 1;
            if ($pendaftar->save()) {
                return view('auth.anggota.activated', ['pendaftar' => $pendaftar]);
            }            
        } else {
            abort(401);
        }
    }    
}

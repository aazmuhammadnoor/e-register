<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Register;
use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\TempRegister;
use App\Models\TempRegisterData;
use App\Models\TempRegisterFiles;
use App\Models\RegisterFile;
use App\Models\RegisterData;
use Illuminate\Support\Facades\Hash;

use Mail;
use App\Jobs\SendRegisterJob;
use App\Jobs\AdminRegisterJob;

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

    /**
     * @method revisi
     * @param $url
     * @param $register
     */
    public function revisi($url,Register $register)
    {
        $auth = \Auth::guard('registant')->user();
        $form_register = FormRegister::where('url',$url)->firstOrFail();
        if($register->form_register != $form_register->id)
        {
            abort('404');
        }
        if($register->registant != $auth->id)
        {
            abort('404');
        }
        if($register->status != 'revisi')
        {
            abort('404');
        }
        $title = $form_register->form_name;
        $form_step = FormStep::where('form_register',$form_register->id)
                            ->orderBy('order_number','asc')
                            ->get();

        return view('register_revisi',compact('title','form_register','form_step','register'));
    }

    /**
     * @method update
     * @param $url
     * @return JSON
     */
    public function update(Request $r, $url, Register $register)
    {
        $auth = \Auth::guard('registant')->user();
        $form_register = FormRegister::where('url',$url)
                                    ->where('is_active',1)
                                    ->first();
        if(!$form_register)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }
        if($register->form_register != $form_register->id)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }
        if($register->registant != $auth->id)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }
        if($register->status != 'revisi')
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }
        $data = [
            'token',
            'key',
            'email',
            'aggree'
        ];
        if(!requireData($data,$r))
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }

        if (!Hash::check($r->token, $r->key)) {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }

        $temp_register = TempRegister::where('token',$r->token)
                                    ->where('form_register',$form_register->id)
                                    ->first();
        if(!$temp_register)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Gagal menyimpan formulir'
            ];
            return response()->json($response);
        }

        $count_form_step = count($form_register->hasStep);
        $count_temp_file = count($temp_register->hasData);

        if($count_form_step != $count_temp_file)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Formulir Belum Lengkap!'
            ];
            return response()->json($response);
        }

        //delete old data
        RegisterData::where('register',$register->id)->delete();
        RegisterFile::where('register',$register->id)->delete();

        $temp_register_data = TempRegisterData::where('temp_register',$temp_register->id)
                                                ->get();
        if(count($temp_register_data) > 0)
        {
            foreach($temp_register_data as $row)
            {
               if(!empty($row->data))
               {
                    $register_data = new RegisterData;
                    $register_data->register = $register->id;
                    $register_data->form_step = $row->form_step;
                    $register_data->data = $row->data;
                    $register_data->save();
               }
            }
        }
        $temp_register_files = TempRegisterFiles::where('temp_register',$temp_register->id)->get();
        foreach($temp_register_files as $row)
        {
            $register_file = new RegisterFile;
            $register_file->id = $row->id;
            $register_file->register = $register->id;
            $register_file->form_step = $row->form_step;
            $register_file->field_name = $row->field_name;
            $register_file->file = $row->file;
            $register_file->size = $row->size;
            $register_file->filename = $row->filename;
            $register_file->ext = $row->ext;
            $register_file->save();
        }

        $register->status = "register";
        $register->save();

        $registant = $auth;

        //send email registant
        $job = (new SendRegisterJob($register));
        dispatch($job);

        //send emaill admin
        $users = \App\Models\User::where('email_notif',1)->get();
        foreach ($users as $key => $user) {
            $job = (new AdminRegisterJob($register,$user));
            dispatch($job);
        }

        $response = [
            'status' => 'success',
            'url' => route('register',[$form_register->url]),
            'email' => $registant->email,
            'register_name' => $form_register->form_name,
            'register_detail' => route('register.info',[$form_register->url]),
            'register_download' => route('register.download.bukti',[$form_register->url]).'?email='.$registant->email.'&key='.bcrypt($registant->email)
        ];

        return response()->json($response);
    }
}

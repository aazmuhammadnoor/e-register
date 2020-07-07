<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\TempRegister;
use App\Models\TempRegisterFiles;
use App\Models\TempRegisterData;

use App\Models\Registant;
use App\Models\Register;
use App\Models\RegisterData;
use App\Models\RegisterFile;

use Mail;
use App\Jobs\SendRegisterJob;
use App\Jobs\AdminRegisterJob;

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
        $form_step = FormStep::where('form_register',$form_register->id)
                            ->orderBy('order_number','asc')
                            ->get();

    	return view('register',compact('title','form_register','form_step'));
    }

    /**
     * @method info
     * @param url
     * @return void
     */
    public function info($url)
    {
        $form_register = FormRegister::where('url',$url)
                                    ->where('is_active',1)
                                    ->first();
        if(!$form_register)
        {
            abort('404');
        }

        $title = $form_register->form_name;

        return view('register_info',compact('title','form_register'));
    }

    /**
     * @method submit
     * @param $url
     * @return JSON
     */
    public function submit(Request $r, $url)
    {
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

        $registant = $this->thisRegistant($r);
        $register = Register::where('registant',$registant->id)
                            ->where('form_register',$form_register->id)
                            ->first();
        if($register)
        {
            $response = [
                'status' => 'error',
                'title' => 'Oops',
                'message' => 'Email sudah terdaftar di '.$register->thisFormRegister->form_name
            ];
            return response()->json($response);
        }


        $register = new Register;
        $register->registant = $registant->id;
        $register->register_number = $this->newRegisterNumber($form_register);
        $register->form_register = $form_register->id;
        $register->save();

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

        //delete temp data
        TempRegisterFiles::where('temp_register',$temp_register->id)->delete();
        TempRegisterData::where('temp_register',$temp_register->id)->delete();
        TempRegister::where('id',$temp_register->id)->delete();

        $this->createBukti($register);

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

    /**
     * @method newRegistant
     * @param $r
     * @return object
     */
    protected function thisRegistant($r)
    {
        $email = $r->email;
        $registant = Registant::where('email',$r->email)->first();
        if(!$registant)
        {
            $registant = new Registant;
            $registant->email = $r->email;
            $registant->save();
        }
        return $registant;
    }

    /**
     * @method newRegisterNumber
     * @param $form_register
     * @return string
     */
    protected function newRegisterNumber($form_register)
    {
        $code = $form_register->register_code;

        //exists
        $this_register = Register::where('form_register',$form_register->id)
                                ->max('register_number');
        if(!$this_register)
        {

            return $code.'-'.sprintf('%08d',1);

        }else{

            $current_number = explode('-', $this_register);
            $current_number = end($current_number);
            $current_number = (int) $current_number;
            return $code.'-'.sprintf('%08d',$current_number+1);

        }

    }

    /**
     * @method downloadBukti
     * @param $url
     * @param $r Request
     * @return file
     */
    public function downloadBukti(Request $r, $url)
    {
        $form_register = FormRegister::where('url',$url)
                                    ->where('is_active',1)
                                    ->first();
        if(!$form_register)
        {
            abort('404');
        }

        $data = ['email','key'];
        if(!requireData($data,$r))
        {
            abort('404');
        }

        if(!Hash::check($r->email, $r->key)) {
            abort('404');
        }

        $registant = Registant::where('email',$r->email)
                                ->first();
        if(!$registant)
        {
            abort('404');
        }

        $register = Register::where('registant',$registant->id)
                            ->where('form_register',$form_register->id)
                            ->first();
        if(!$register)
        {
            abort('404');
        }

        $bukti_pendaftaran = $register->bukti_pendaftaran;
        if(!$bukti_pendaftaran)
        {
            $this->createBukti($register);
        }

        $pathfile = \Storage::path($register->bukti_pendaftaran);
        if(!file_exists($pathfile))
        {
            $this->createBukti($register);
        }

        $preview_name = str_slug($form_register->form_name.'-'.$register->register_number).'.pdf';
        return response()->file($pathfile,[
                'Content-Type' => 'application/pdf',
                'Content-Disposition'=>'inline;filename="'.$preview_name.'"'
               ]);
    }

    /**
     * @method createBukti
     * @param $register
     * @return object
     */
    protected function createBukti($register)
    {
        $form_register = $register->thisFormRegister;
        $template = \Storage::path($form_register->template_register);
        $identitas = \App\Models\Identitas::first();
        if(!file_exists($template))
        {
            $template = "uploads/".$identitas->bukti_pendaftaran;
        }
        $qrcode = generateQR($register);
        $qr_location = locationQR($register);

        $render = new \App\Workflow\TemplateProccessorCustom($template);
        $render->setValue('date_time', $register->updated_at->format('d F Y H:i'));
        $render->setValue('date', $register->updated_at->format('d F Y'));
        $render->setValue('email', $register->thisRegistant->email);
        $render->setValue('title', $form_register->form_name);
        $render->setValue('register_number', $register->register_number);
        $render->setValue('nama_aplikasi', $identitas->nama_aplikasi);
        $render->setValue('nama_instansi', $identitas->instansi);
        $render->setValue('alamat_instansi', $identitas->alamat_instansi);
        $render->setValue('telepon_instansi', $identitas->telepon_instansi);
        $render->setImg('qrcode',array('src' => $qrcode,'swh'=>'120'));

        //render meta data
        $register_data = $register->hasRegisterData;
        foreach ($register_data as $row) {
           $field = $row->thisFormStep->metadata;
           $field = json_decode($field);
           $data = $row->data;
           $data = json_decode($data);
           
           foreach($field as $key => $this_field)
           {
                $this_value = '';
                foreach ($data as $this_data) {
                    if($this_field->field_name == $this_data->field_name)
                    {
                        if($this_field->type == 'file')
                        {
                            $this_value = $this_data->path;
                        }else{
                            $this_value = $this_data->value;
                        }
                    }
                }
                if(!empty($this_value)){
                    switch ($this_field->type) {
                        case 'text':
                        case 'title':
                        case 'number':
                        case 'date':
                        case 'select':
                        case 'radio':
                        case 'textarea':
                            $value = htmlentities($this_value);
                            $render->setValue($this_field->field_name,$value);
                            break;
                        case 'checkbox':
                        case 'multitext':
                            $values = '';
                            foreach ($this_value as $d => $i) {
                                $values .= ($d+1)."). ".$i;
                            }
                            $value = htmlentities($value);
                            $render->setValue($this_field->field_name,$values);
                            break;
                        case 'file':
                            $ext = ['jpg','jpeg','png','bmp'];
                            $register_file = RegisterFile::where('register',$register->id)
                                                        ->where('id',$this_value)
                                                        ->first();
                            if($register_file != null)
                            {
                                if(in_array($register_file->ext,$ext))
                                {
                                    $path = \Storage::path($register_file->file);
                                    if(file_exists($path))
                                    {
                                        $render->setImg($this_field->field_name,array('src' => $path,'swh'=>'180'));
                                    }
                                }
                            }
                            break;
                        case 'address':
                        case 'address_autocomplete':
                            $value = end($this_value);
                            $value = htmlentities($value);
                            $render->setValue($this_field->field_name,$value);
                            break;
                        default:
                            break;
                    }
                }
           }

        }

        $path = 'bukti_pendaftaran/'.$form_register->url;
        createDIR($path);
        $filename = [
            'pdf'=> \Storage::path($path.'/'.str_slug($register->register_number).'.pdf'),
            'docx'=> \Storage::path($path.'/'.str_slug($register->register_number).'.docx')
        ];
        $render->saveAs($filename['docx']);
        $konversi = \App\Http\KonversiPdf::convertPDF($path, $filename);
        if($konversi)
        {
            $register->bukti_pendaftaran = $path.'/'.str_slug($register->register_number).'.pdf';
            $register->qrcode = $qr_location;
            $register->save();
        }
    }
}

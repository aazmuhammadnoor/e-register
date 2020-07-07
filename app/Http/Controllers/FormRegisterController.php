<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormRegister;
use App\Models\FormStep;
use Storage;

class FormRegisterController extends Controller
{

    /**
     * construct
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * global variables
     */
    public $active = [0 => 'Tidak', 1 => 'Ya'];
    public $default_email_register_confirm = 'Hi ${email}, Terimakasih telah mendaftar, untuk info selanjutnya akan kami hubungi via email atau kontak yang terdaftar pada form registrasi';

    /**
     * @method lists
     * @return void
     */
    public function lists(){
    	$title = "Form Register";
    	$form_register = FormRegister::paginate(15);
        $no = $form_register->firstItem();
    	return view('master_data.form_register.index',compact('title','form_register','no'));
    }

    /**
     * @method add
     * @return void
     */
    public function add(){
        $title = "Form Register Baru";
        $form_register = new FormRegister;
        $active = $this->active;
        if(!$form_register->register_email_confirm)
        {
            $register_email_confirm = $this->default_email_register_confirm;
        }else{
            $register_email_confirm = $form_register->register_email_confirm;
        }
        return view('master_data.form_register.form',compact('title','form_register','active','register_email_confirm'));
    }

    /**
     * @method randomString
     * @return string
     */
    protected function randomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 6;
        for($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    /**
     * @method url
     * @return string
     */
    protected function url($randomString=null)
    {
        if($randomString == null)
        {
            $randomString = $this->randomString();
        }

        $is_exist = FormRegister::where('url',$randomString)->count();
        if($is_exist > 0)
        {
            $this->url($randomString);
        }else{
            return $randomString;
        } 
    }

    /**
     * @method insert
     * @return void
     */
    public function insert(Request $r)
    {
        $this->validate($r, [
            'form_name'=>'required',
            'color'=>'required',
            'utama' => 'required'
        ]);

        $form_register = new FormRegister;

        $form_register->form_name = $r->form_name;
        $form_register->register_code = $r->register_code;
        $form_register->color = $r->color;
        $form_register->info = $r->info;
        $form_register->register_email_confirm = $r->register_email_confirm;
        $form_register->url = $this->url();
        $form_register->is_active = 0;
        $form_register->summary = $r->summary;
        $form_register->utama = $r->utama;

        if($r->utama == 1)
        {
            $all_register = FormRegister::update(['utama' => 0]);
        }

        if($r->hasFile('template_register')){
            $template = $r->file('template_register');
            $filename = $template->storeAs('template_register',str_slug($r->form_name).".docx");
            $form_register->template_register = $filename;
        }

        if($r->hasFile('background')){
            $background = $r->file('background');
            $filename = Storage::putFile('public/background',$background);
            $form_register->background = $filename;
        }

        $form_register->save();

        flash('Form Register Berhasil disimpan')->success();
        return redirect()->route('admin.form.register.show',[$form_register->id]);
    }

    /**
     * @method edit
     * @return void
     */
    public function edit(FormRegister $data){
        $title = "Edit Form Register";
        $form_register = $data;
        $active = $this->active;
        if(!$form_register->register_email_confirm)
        {
            $register_email_confirm = $this->default_email_register_confirm;
        }else{
            $register_email_confirm = $form_register->register_email_confirm;
        }
        return view('master_data.form_register.form',compact('title','form_register','active','register_email_confirm'));
    }

    /**
     * @method update
     * @return void
     */
    public function update(Request $r, FormRegister $data)
    {
        $this->validate($r, [
            'form_name'=>'required',
            'color'=>'required'
        ]);

        $form_register = $data;

        $form_register->form_name = $r->form_name;
        $form_register->register_code = $r->register_code;
        $form_register->color = $r->color;
        $form_register->info = $r->info;
        $form_register->register_email_confirm = $r->register_email_confirm;
        $form_register->summary = $r->summary;
        $form_register->utama = $r->utama;

        if($r->utama == 1)
        {
            $all_register = FormRegister::where('id','!=',$form_register->id)->update(['utama' => 0]);
        }
        if($r->hasFile('template_register')){
            if(file_exists(storage::path($form_register->template_register)))
            {
                Storage::delete($form_register->template_register);
            }
            $template = $r->file('template_register');
            $filename = $template->storeAs('template_register',str_slug($r->form_name).".docx");
            $form_register->template_register = $filename;
        }

        if($r->hasFile('background')){
            if(file_exists(storage::path($form_register->background)))
            {
                Storage::delete($form_register->background);
            }
            $background = $r->file('background');
            $filename = Storage::putFile('public/background',$background);
            $form_register->background = $filename;
        }

        $form_register->save();

        flash('Form Register Berhasil diubah')->success();
        return redirect()->route('admin.form.register.show',[$form_register->id]);
    }

    /**
     * @method delete
     * @return void
     */
    public function delete(Request $r, FormRegister $data)
    {
        $data->delete();
        flash('Form Register Berhasil dihapus')->success();
        return redirect()->route('admin.form.register');
    }

    /**
     * @method edit
     * @return show
     */
    public function show(FormRegister $data){
        $form_register = $data;

        $title = $data->form_name;
        $active = $this->active;
        return view('master_data.form_register.show',compact('title','form_register','active'));
    }

    /**
     * @method download
     * @return void
     */
    public function download(FormRegister $data)
    {
        $path = Storage::path($data->template_register);
        if (file_exists($path)){
            return response()->download($path);
        }
    }

    /**
     * @method up
     * @return void
     */
    public function up(FormRegister $data)
    {
        $form_register = $data;
        $form_register->is_active = 1;
        $form_register->save();

        flash('Form Register berhasil dipublish')->success();
        return redirect()->route('admin.form.register.show',[$data->id]);
    }

    /**
     * @method down
     * @return void
     */
    public function down(FormRegister $data)
    {
        $form_register = $data;
        $form_register->is_active = 0;
        $form_register->save();

        flash('Form Register tidak dipublish')->success();
        return redirect()->route('admin.form.register.show',[$data->id]);
    }

    /**
     * @method preview
     * @param url
     * @return void
     */
    public function preview($url)
    {
        $form_register = FormRegister::where('url',$url)
                                    ->first();
        if(!$form_register)
        {
            abort('404');
        }

        $title = $form_register->form_name;
        $form_step = FormStep::where('form_register',$form_register->id)
                            ->orderBy('order_number','asc')
                            ->get();

        return view('master_data.form_register.preview',compact('title','form_register','form_step'));
    }

    /**
     * @method variables
     * @param url
     * @return json
     */
    public function variables($url)
    {
        $form_register = FormRegister::where('url',$url)
                                    ->first();


        if(!$form_register)
        {
            $response = [
                'status' => 'error',
            ];
            return response()->json($response);
        }

        $variables = [
            [
                'name' => 'Judul Form',
                'variables' => 'title'
            ],
            [
                'name' => 'Tanggal Waktu Registrasi',
                'variables' => 'date_time'
            ],
            [
                'name' => 'Tanggal Registrasi',
                'variables' => 'date'
            ],
            [
                'name' => 'Alamat Email',
                'variables' => 'email'
            ],
            [
                'name' => 'Nomor Registrasi',
                'variables' => 'register_number'
            ],
            [
                'name' => 'Kode QR',
                'variables' => 'qrcode'
            ],
            [
                'name' => 'Nama Instansi',
                'variables' => 'nama_instansi'
            ],
            [
                'name' => 'Alamat Instansi',
                'variables' => 'alamat_instansi'
            ],
            [
                'name' => 'Telepon Instansi',
                'variables' => 'telepon_instansi'
            ],
            [
                'name' => 'Nama Aplikasi',
                'variables' => 'nama_aplikasi'
            ]
        ];
        if(count($form_register->hasStep) > 0)
        {
            foreach ($form_register->hasStep as $key => $value) {
                if(!empty($value->metadata))
                {
                    $metadata = json_decode($value->metadata);
                    foreach ($metadata as $d => $i) {
                        if($i->type != 'title')
                        {
                            $var = [
                                'name' => $i->label,
                                'variables' => $i->field_name
                            ];
                            array_push($variables, $var);
                        }
                    }
                }
            }
        }

        $response = [
            'status' => 'success',
            'data' => $variables
        ];

        return response()->json($response);
       
    }

}

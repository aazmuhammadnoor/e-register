<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormRegister;
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
        return view('master_data.form_register.form',compact('title','form_register','active'));
    }

    /**
     * @method randomString
     * @return string
     */
    protected function randomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
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
            'color'=>'required'
        ]);

        $form_register = new FormRegister;

        $form_register->form_name = $r->form_name;
        $form_register->color = $r->color;
        $form_register->url = $this->url();
        $form_register->is_active = 0;

        if($r->hasFile('template_register')){
            /*Storage::delete($ext_file);*/
            $template = $r->file('template_register');
            $filename = $template->storeAs('template_register',str_slug($r->form_name).".docx");
            $form_register->template_register = $filename;
        }

        $form_register->save();

        flash('Form Register Berhasil disimpan')->success();
        return redirect()->route('admin.form.register');
    }

    /**
     * @method edit
     * @return void
     */
    public function edit(FormRegister $data){
        $title = "Edit Form Register";
        $form_register = $data;
        $active = $this->active;
        return view('master_data.form_register.form',compact('title','form_register','active'));
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
        $form_register->color = $r->color;
        if($r->hasFile('template_register')){
            if(file_exists(storage::path($form_register->template_register)))
            {
                Storage::delete($form_register->template_register);
            }
            $template = $r->file('template_register');
            $filename = $template->storeAs('template_register',str_slug($r->form_name).".docx");
            $form_register->template_register = $filename;
        }

        $form_register->save();

        flash('Form Register Berhasil diubah')->success();
        return redirect()->route('admin.form.register');
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

        $title = 'Register - '.$data->form_name;
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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\Register;
use App\Models\RegisterFile;
use App\Models\RegisterData;

use PDF;

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
        $fields = [];
        foreach($register->thisFormRegister->hasStep as $step)
        {
            $metadata = json_decode($step->metadata);
            $meta_fields = [];
            foreach ($metadata as $key => $row) {
                if($row->type != 'file')
                {
                    $field_detail = [
                        'field_name' => $row->field_name,
                        'label' => $row->label
                    ];
                    array_push($meta_fields,$field_detail);
                }
            }
            $step_data = [
                'name' => $step->step_name,
                'fields' => $meta_fields
            ];
            array_push($fields,$step_data);
        }
        return view('admin.register.detail',compact('title','register','fields'));
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
        if($register->id != $register_file->register)
        {
            abort('404');
        }
        $path = \Storage::path($register_file->file);
        return response()->file($path);
    }

    /**
     * @method print
     * @param $r 
     * @param $form_register
     * @param $form_step 
     * @return JSON
     */
    public function print(Request $r,Register $register)
    {
        $print_field = $r->field_name;

        $print = [];
        $fields = [];
        foreach($register->thisFormRegister->hasStep as $step)
        {
            $metadata = json_decode($step->metadata);
            $meta_fields = [];
            foreach ($metadata as $key => $row) {
                if(in_array($row->field_name, $print_field))
                {
                    $field_detail = [
                        'field_name' => $row->field_name,
                        'label' => $row->label,
                        'value' => $this->valueMeta($register,$row)
                    ];
                    array_push($meta_fields,$field_detail);
                }
            }
            $step_data = [
                'name' => $step->step_name,
                'fields' => $meta_fields
            ];
            if(count($meta_fields) > 0)
            {
                array_push($fields,$step_data);
            }
        }
        $pdf = PDF::loadView('admin.register.print', compact('register','fields'));  
        return $pdf->download($register->register_number.'.pdf');
        //return view('admin.register.print',compact('register','fields'));
    }

    protected function valueMeta($register,$field)
    {
        foreach ($register->hasRegisterData as $register_data) {
            $data = $register_data->data;
            $data = json_decode($data);
            foreach($data as $row)
            {
                if($row->field_name == $field->field_name)
                {
                    switch ($field->type) {
                        case 'text':
                        case 'number':
                        case 'select':
                        case 'radio':
                        case 'textarea':
                            return $row->value;
                        break;
                        case 'date':
                            return \Carbon\Carbon::parse($row->value)->format('d F Y');
                        break;
                        case 'checkbox':
                        case 'multitext':
                            $text = '<ul>';
                            foreach($row->value as $var)
                            {
                                $text .= '<li>'.$var.'</li>';
                            }
                            $text .= '</ul>';
                            return $text;
                        break;
                        case 'address':
                        case 'address_autocomplete':
                            return $row->value[1];
                        break;
                        default:
                            # code...
                            break;
                    }
                }
            }
        }
    }
}

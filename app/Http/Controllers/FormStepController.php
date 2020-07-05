<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormStep;
use App\Models\FormRegister;

class FormStepController extends Controller
{
    /**
     * construct
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @method addStep
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function addStep(Request $r, FormRegister $formRegister){
        $this->validate($r, [
    		'step_name'=>'required|unique:form_step,step_name'
    	]);

    	/*number of this step*/
    	$exists_step = FormStep::where('form_register',$formRegister->id)->max('order_number');
    	if($exists_step)
    	{
    		$this_step = $exists_step+1;
    	}else{
    		$this_step = 1;
    	}

    	$form_step = new FormStep;
    	$form_step->step_name = $r->step_name;
    	$form_step->form_register = $formRegister->id;
    	$form_step->order_number = $this_step;

    	try {
    		$form_step->save();
    		$response = [
    			'status' => 'success'
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error'
    		];
    		return response()->json($response);
    	}
    }

    /**
     * @method editStep
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function editStep(Request $r, FormRegister $formRegister){
        $this->validate($r, [
    		'id'=>'required',
    		'step_name'=>'required|unique:form_step,step_name,'.$r->id
    	]);

    	/*validating form register and form step by id form register*/
    	$form_step = FormStep::where('id',$r->id)
    						->where('form_register',$formRegister->id)
    						->first();
    	if(!$form_step)
    	{
    		$response = [
    			'status' => 'error'
    		];
    		return response()->json($response); 
    	}

    	$form_step->step_name = $r->step_name;

    	try {
    		$form_step->save();
    		$response = [
    			'status' => 'success'
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error'
    		];
    		return response()->json($response);
    	}
    }

    /**
     * @method listsStep
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function listsStep(Request $r, FormRegister $formRegister){

    	$form_step = FormStep::where('form_register',$formRegister->id)
    							->select('id','step_name','order_number')
    							->orderBy('order_number')
    							->get();
    	return response()->json($form_step);
    }

    /**
     * @method detail
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function detail(Request $r, FormStep $formStep){
    	return response()->json($formStep);
    }

    /**
     * @method delete
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function delete(Request $r, FormStep $formStep){

    	try {
    		$formStep->delete();
    		$response = [
    			'status' => 'success'
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error'
    		];
    		return response()->json($response);
    	}
    }

    /**
     * @method updateMeta
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function updateMeta(Request $r, FormStep $formStep){
		
		$meta = [];
        if(count(array_unique($r->field_name))<count($r->field_name))
        {
           $response = [
                'status' => 'error',
                'message' => 'Tidak boleh ada nama kolom yang sama'
            ];
            return response()->json($response);
        }
		foreach($r->field_name as $key => $row)
		{
			$field = [
				'field_name' => (!$r->field_name[$key]) ? '' : str_slug($r->field_name[$key]),
                'label' => (!$r->field_name[$key]) ? '' : $r->field_name[$key],
				'type' => (!$r->type[$key]) ? '' : $r->type[$key],
				'column_length' => (!$r->column_length[$key]) ? '' : $r->column_length[$key],
				'options' => (!$r->options[$key]) ? '' : $r->options[$key],
				'required' => (!$r->required[$key]) ? '' : $r->required[$key]
			];
			array_push($meta, $field);
		}
		$meta = json_encode($meta);
		$formStep->metadata = $meta;

    	try {
    		$formStep->save();
    		$response = [
    			'status' => 'success'
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error'
    		];
    		return response()->json($response);
    	}
    }

    /**
     * @method orderStep
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function orderStep(Request $r, FormStep $formStep){
        
        $data = [
            'order'
        ];
        if(!requireData($data,$r))
        {
            $response = [
                'status' => 'error'
            ];
            return response()->json($response); 
        }

        $this_position = $formStep->order_number;
        $count_form_step = FormStep::where('form_register',$formStep->form_register)->count();

        
        if($r->order == 'down') //down order
        {

            if($this_position > 1)
            {
                $below = FormStep::where('order_number',$this_position-1)
                                    ->where('form_register',$formStep->form_register)
                                    ->first();
                $below->order_number = $this_position;
                $below->save();

                $formStep->order_number = $this_position-1;
                $formStep->save();
            }
        }else{ //up order

            if($this_position < $count_form_step)
            {
                $above = FormStep::where('order_number',$this_position+1)
                                    ->where('form_register',$formStep->form_register)
                                    ->first();
                $above->order_number = $this_position;
                $above->save();

                $formStep->order_number = $this_position+1;
                $formStep->save();
            }

        }
        $response = [
            'status' => 'success'
        ];
        return response()->json($response);
    }
}

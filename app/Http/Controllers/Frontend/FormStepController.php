<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FormStep;

class FormStepController extends Controller
{
    /**
     * @method detail
     * @param $data App\Models\FormRegister Id
     * @param $r Illuminate\Http\Request;
     * @return json
     */
    public function detail(Request $r,$formStep){

    	$form_step = FormStep::where("id",$formStep)
    							->select('id','step_name as name','metadata as fields')
    							->first();
    	if(!$form_step)
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'step not found'
    		];
    		return response()->json($response);
    	}
    	
    	return response()->json($form_step);
    }
}

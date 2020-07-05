<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FormStep;
use App\Models\FormRegister;

class FormStepController extends Controller
{
    /**
     * @method detail
     * @param $r Illuminate\Http\Request;
     * @param $formStep App\Models\FormStep Id
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

    /**
     * @method stepInformation
     * @param $r Illuminate\Http\Request;
     * @param $url
     * @return json
     */
    public function stepInformation(Request $r,$url){

        $form_register = FormRegister::where('url',$url)->first();
        if(!$form_step)
        {
            $response = [
                'status' => 'error',
                'message' => 'register not found'
            ];
            return response()->json($response);
        }
        return response()->json($form_register);
    }
}

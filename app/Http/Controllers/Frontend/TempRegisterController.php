<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\FormRegister;
use App\Models\FormStep;
use App\Models\TempRegister;
use App\Models\TempRegisterFiles;
use App\Models\TempRegisterData;

class TempRegisterController extends Controller
{
    /**
     * @method randomString
     * @return string
     */
    protected function randomString()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 11;
        for($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    /**
     * @method token
     * @return string
     */
    protected function token($randomString=null)
    {
        if($randomString == null)
        {
            $randomString = $this->randomString();
        }

        $is_exist = TempRegister::where('token',$randomString)->count();
        if($is_exist > 0)
        {
            $this->token($randomString);
        }else{
            return $randomString;
        } 
    }

    /**
     * temporary register
     * @method newTempRegister
     * @param $form_register
     * @return array
     */
    protected function newTempRegister($form_register)
    {
    	$temp_register = new TempRegister;
    	$temp_register->token = $this->token();
    	$temp_register->form_register = $form_register->id;
    	$temp_register->save();

    	return $temp_register;
    }

    /**
     * @method checkingTempRegister
     * @param $form_register
     * @param $r
     * @return object
     */
    protected function checkingTempRegister($form_register,$r)
    {
    	/* if has token */
    	if($r->has('token'))
    	{
    		$data = [
    			'token',
    			'key'
	    	];
	    	if(!requireData($data,$r))
	    	{
	    		$response = [
	    			'status' => 'error',
	    			'message' => 'paramater kurang!'
	    		];
	    		return (object) $response;
	    	}

	    	/*checking existing temporary register*/
	    	if (Hash::check($r->token, $r->key)) {
			    $response = [
	    			'status' => 'error',
	    			'message' => 'token mismatch'
	    		];
	    		return (object) $response;
			}
			$temp_register = TempRegister::where('token',$r->token)->first();
			if(!$temp_register)
			{
				$response = [
	    			'status' => 'error',
	    			'message' => 'token mismatch'
	    		];
	    		return (object) $response;
			}
			if($temp_register->form_register != $form_register->id)
			{
				$response = [
	    			'status' => 'error',
	    			'message' => 'token mismatch'
	    		];
	    		return (object) $response;
			}
			return $temp_register;
    	}else{
    		return $this->newTempRegister($form_register);
    	}
    }

    /**
     * @method uploadFile
     * @param $r
     * @param $form_register
     * @param $form_step
     * @return JSON
     */
    public function uploadFile(Request $r,$url, FormStep $form_step)
    {
    	$form_register = FormRegister::where('url',$url)
    								->where('is_active',1)
    								->first();
    	if(!$form_register)
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'form not found'
    		];
    		return response()->json($response);
    	}

    	if($form_register->id != $form_step->form_register)
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'form not found'
    		];
    		return response()->json($response);
    	}

    	dd($r->field_name);

    	/* --- new temp register -- */
    	$temp_register = $this->checkingTempRegister($form_register,$r);

    	$path = $r->file('file')->store($form_register->url);

    	$temp_upload = new TempRegisterFiles;
    	$temp_upload->temp_register = $temp_register->id;
    	$temp_upload->field = $r->field;
    	$temp_upload->file = $path;

    	try {
    		$temp_upload->save();
    		$response = [
    			'status' => 'success',
    			'token' => $temp_register->token,
    			'key' => bcrypt($temp_register->token),
    			'path' => \Storage::url($path)
    		];
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error',
    			'message' => 'failed uploading file'
    		];
    		return response()->json($response);
    	}

    }
}

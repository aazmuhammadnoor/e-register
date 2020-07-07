<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
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
	    		return $this->newTempRegister($form_register);
	    	}

	    	/*checking existing temporary register*/
	    	if (!Hash::check($r->token, $r->key)) {
			    return $this->newTempRegister($form_register);
			}

			$temp_register = TempRegister::where('token',$r->token)->first();

			//if temporary register not exists
			if(!$temp_register)
			{
				return $this->newTempRegister($form_register);
			}
			//if temporary register not match with register id
			if($temp_register->form_register != $form_register->id)
			{
				return $this->newTempRegister($form_register);
			}
			//if temporary register expired (must be in same date)
			if($temp_register->created_at->format('Y-m-d') != date('Y-m-d'))
			{
				return $this->newTempRegister($form_register);
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

    	/* --- new temp register -- */
    	$temp_register = $this->checkingTempRegister($form_register,$r);

    	/* -- check if exist file in this step this field and this register*/
    	$temp_register_file = TempRegisterFiles::where('temp_register',$temp_register->id) 
    											->where('form_step',$form_step->id)
    											->where('field_name',$r->field_name)
    											->first();
    	if($temp_register_file)
    	{
    		\Storage::delete($temp_register_file->file);
    	}else{
    		$temp_register_file = new TempRegisterFiles;
    	}

    	/* -- uploading and saving*/

    	$path = \Storage::putFile('upload_register/'.$form_register->url.'/'.$temp_register->token,$r->file('file'));
    	$temp_register_file->temp_register = $temp_register->id;
    	$temp_register_file->form_step = $form_step->id;
    	$temp_register_file->field_name = $r->field_name;
    	$temp_register_file->size = $r->file('file')->getClientSize();
    	$temp_register_file->filename = $r->file('file')->getClientOriginalName();
    	$temp_register_file->ext = $r->file('file')->getClientOriginalExtension();
    	$temp_register_file->file = $path;

    	try {
    		$temp_register_file->save();
    		$response = [
    			'status' => 'success',
    			'token' => $temp_register->token,
    			'key' => bcrypt($temp_register->token),
    			'path' => $temp_register_file->id,
    			'submited' => \Carbon\Carbon::now()->format('Y-m-d')
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error',
    			'message' => 'failed uploading file'
    		];
    		return response()->json($response);
    	}

    }

    /**
     * @method checkFile
     * @param $r
     * @param $form_register
     * @param $form_step
     * @return JSON
     */
    public function checkFile(Request $r,$url, FormStep $form_step)
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

    	$data = [
			'token',
			'key',
			'field_name'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'param error'
    		];
    		return response()->json($response);
    	}

    	/*checking existing temporary register*/
    	if (!Hash::check($r->token, $r->key)) {
		    $response = [
    			'status' => 'error',
    			'message' => 'token mismatch'
    		];
    		return response()->json($response);
		}

		$temp_register = TempRegister::where('token',$r->token)->first();
		if($temp_register)
		{
			$temp_register_file = TempRegisterFiles::where('temp_register',$temp_register->id)
										->where('form_step',$form_step->id)
										->where('field_name',$r->field_name)
										->first();
	    	if($temp_register_file)
	    	{
	    		$response = [
	    			'status' => 'success',
	    			'path' => $temp_register_file->id,
	    			'size' => $temp_register_file->size,
	    			'filename' => $temp_register_file->filename
	    		];
	    		return response()->json($response);
	    	}else{
	    		$response = [
	    			'status' => 'error',
	    			'message' => 'file not found'
	    		];
	    		return response()->json($response);
	    	}
		}else{
			$response = [
    			'status' => 'error',
    			'message' => 'file not found'
    		];
    		return response()->json($response);
		}
    }

    /**
     * @method previewFile
     * @param $r 
     * @param $form_register
     * @param $form_step 
     * @return JSON
     */
    public function previewFile(Request $r,$url, TempRegisterFiles $temp_file, $token)
    {
        $form_register = FormRegister::where('url',$url)
                                    ->where('is_active',1)
                                    ->first();
        if(!$form_register)
        {
           abort('404');
        }
        $temp_register = TempRegister::where('token',$token)
                                    ->where('form_register',$form_register->id)
                                    ->first();
        if(!$temp_register)
        {
            abort('404');
        }

        if($temp_file->temp_register != $temp_register->id)
        {
            abort('404');
        }

        $path = \Storage::path($temp_file->file);
        return response()->file($path);
    }

    /**
     * @method removeFile
     * @param $r
     * @param $form_register
     * @param $form_step
     * @return JSON
     */
    public function removeFile(Request $r,$url, FormStep $form_step)
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

    	$data = [
			'token',
			'key',
			'field_name'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'param error'
    		];
    		return response()->json($response);
    	}

    	/*checking existing temporary register*/
    	if (!Hash::check($r->token, $r->key)) {
		    $response = [
    			'status' => 'error',
    			'message' => 'token mismatch'
    		];
    		return response()->json($response);
		}

		$temp_register = TempRegister::where('token',$r->token)
									->where('form_register',$form_register->id)
									->first();
		if($temp_register)
		{
			$temp_register_file = TempRegisterFiles::where('temp_register',$temp_register->id)
										->where('form_step',$form_step->id)
										->where('field_name',$r->field_name)
										->first();
	    	if(!$temp_register_file)
	    	{
	    		$response = [
	    			'status' => 'error',
	    			'message' => 'file not found'
	    		];
	    		return response()->json($response);
	    	}
	    	\Storage::delete($temp_register_file->file);
	    	$temp_register_file->delete();

	    	$response = [
    			'status' => 'success'
    		];
    		return response()->json($response);
		}else{
			$response = [
    			'status' => 'error',
    			'message' => 'register not found'
    		];
    		return response()->json($response);
		}
    }

    /**
     * @method submit
     * @param $r
     * @param $form_register
     * @param $form_step
     * @return JSON
     */
    public function submit(Request $r,$url, FormStep $form_step)
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

    	/* --- new temp register -- */
    	$temp_register = $this->checkingTempRegister($form_register,$r);

    	/* -- check if exist file in this step this field and this register*/
    	$temp_register_data = TempRegisterData::where('form_step',$form_step->id)
    										->where('temp_register',$temp_register->id)
    										->first();
    	if(!$temp_register_data)
    	{
    		$temp_register_data = new TempRegisterData;
    	}

    	$data = [];
    	$input = Input::all();
    	foreach ($input as $key => $value) {
    		if($key != 'token' && $key != 'key')
    		{
    			$sub_data = [
    				'field_name' => $key,
    				'value' => $value,
    				'path' => $this->is_upload($temp_register->id,$form_step->id,$key)
    			];
    			array_push($data, $sub_data);
    		}
    	}
    	$data = json_encode($data);

    	/* -- saving --*/
		$temp_register_data->temp_register = $temp_register->id;
		$temp_register_data->form_step = $form_step->id;
		$temp_register_data->data = $data;

    	try {
    		$temp_register_data->save();
    		$response = [
    			'status' => 'success',
    			'token' => $temp_register->token,
    			'key' => bcrypt($temp_register->token),
    			'submited' => \Carbon\Carbon::now()->format('Y-m-d')
    		];
    		return response()->json($response);
    	} catch (Exception $e) {
    		$response = [
    			'status' => 'error',
    			'message' => 'failed uploading file'
    		];
    		return response()->json($response);
    	}
    }

    /**
     * checking this field is upload or not
     * @method is_upload
     * @param $temp_register_id
     * @param $form_step_id
     * @param $field_name
     * @return string
     */
    protected function is_upload($temp_register_id,$form_step_id,$field_name)
    {
    	$temp_register_file = TempRegisterFiles::where('temp_register',$temp_register_id)
    											->where('form_step',$form_step_id)
    											->where('field_name',$field_name)
    											->first();
    	if($temp_register_file)
    	{
    		return $temp_register_file->id;
    	}else{
    		return null;
    	}
    }

    /**
     * @method stepInfo
     * @param $r
     * @param $form_register
     * @param $form_step
     * @return JSON
     */
    public function stepInfo(Request $r,$url, FormStep $form_step)
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

    	$data = [
			'token',
			'key'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'success',
    			'data' => null
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
    			'data' => 'form not found'
    		];
    		return response()->json($response);
    	}


    	$temp_register_data = TempRegisterData::where('form_step',$form_step->id)
    										->where('temp_register',$temp_register->id)
    										->first();
    	if(!$temp_register_data)
    	{
    		$response = [
    			'status' => 'success',
    			'data' => null
    		];
    		return response()->json($response);
    	}

		$response = [
			'status' => 'success',
			'token' => $temp_register->token,
			'key' => bcrypt($temp_register->token),
			'data' => $temp_register_data->data,
			'submited' => \Carbon\Carbon::now()->format('Y-m-d')
		];
		return response()->json($response);
    }

    /**
     * @method review
     * @param $r
     * @param $url
     * @return JSON
     */
    public function review(Request $r,$url)
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

    	$data = [
			'token',
			'key'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'param error'
    		];
    		return response()->json($response);
    	}

    	/*checking existing temporary register*/
    	if (!Hash::check($r->token, $r->key)) {
		    $response = [
    			'status' => 'error',
    			'message' => 'token mismatch'
    		];
    		return response()->json($response);
		}

		$temp_register = TempRegister::where('token',$r->token)->first();
		if(!$temp_register)
		{
			$response = [
    			'status' => 'error',
    			'message' => 'register not found'
    		];
    		return response()->json($response);
		}

		//data
		$temp_register_data = TempRegisterData::where('temp_register',$temp_register->id)
												->get();
		$data = [];
		foreach ($temp_register_data as $key => $row) {
			$sub = [
				'form_step' => $row->thisFormStep->step_name,
				'data' => $row->data,
				'fields' => $row->thisFormStep->metadata
			];
			array_push($data, $sub);
		}
		$response = [
			'status' => 'success',
			'token' => $temp_register->token,
			'key' => bcrypt($temp_register->token),
			'data' => $data
		];
		return response()->json($response);
    }

    /**
     * @method cancel
     * @param $r
     * @param $form_register
     * @return JSON
     */
    public function cancel(Request $r,$url)
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

        $data = [
            'token',
            'key'
        ];
        if(!requireData($data,$r))
        {
            $response = [
                'status' => 'success',
                'data' => null
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
                'data' => 'form not found'
            ];
            return response()->json($response);
        }

        TempRegisterFiles::where('temp_register',$temp_register->id)->delete();
        TempRegisterData::where('temp_register',$temp_register->id)->delete();
        TempRegister::where('id',$temp_register->id)->delete();

        $response = [
            'status' => 'success'
        ];
        return response()->json($response);
    }

}

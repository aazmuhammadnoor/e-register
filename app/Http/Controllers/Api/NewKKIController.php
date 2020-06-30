<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api;

class NewKKIController extends Controller
{
    public $publicKey = "palembang";
	public $privateKey = "PLg91Ax";
	public $site = "http://registrasi.kki.go.id/index.php/api/";

	protected function getStrData($str,$token)
	{
		$endpoint = $this->site."webservice/str";
		$client = new \GuzzleHttp\Client();

		$postdata = array("nomor_str" => $str);

		$encoder  = new Ktki();
		$encoder->setKey($this->encrytionKey);
		$postdataEncrypted = $encoder->encode(json_encode($postdata));

		$response = $client->request(
						'POST', 
						$endpoint, 
						[
							"body" => $postdataEncrypted,
							"headers" => 
							[
								'Authorization' => 'Bearer '.$token,
								'Accept'        => 'application/json',
							]
						]
					);

		$statusCode = $response->getStatusCode();
		$content = $encoder->decode($response->getBody());

		return $content;
	}

	protected function getKey()
	{
		$publicKey = $this->publicKey;
		$privateKey = $this->privateKey;
		$endpoint = $this->site."token?username=$publicKey&password=$privateKey";
		$client = new \GuzzleHttp\Client();

		$response = $client->request(
						'GET', 
						$endpoint, 
						[
							/*'headers' => [
								'Authorization' => "Basic ".base64_encode($publicKey.":".$privateKey)
							]*/
						]
					);
		dd($response);

		$response = json_decode($response->getBody());

		return $response->token;
	}

	public function getData(Request $r,$str=null)
	{
		if(!$r->has('str')){
			if($str == null){
				return response()->json(false);
			}
		}else{
			if($str == null){
				$str = $r->str;
			}
		}

		$site = $this->site;
		$publicKey = $this->publicKey;
		$privateKey = $this->privateKey;

		/*parsing str*/
		$str = str_replace(' ','', $str);
		$str = str_replace('-','', $str);
		$str = str_replace('.','', $str);
		$str = str_replace(',','', $str);

		$token = $this->getKey();
		$result = $this->getStrData($str,$token);
		$result = json_decode($result);

		if($result){
			if($result->success == false && $result->message == "Token expired"){ // if expired

				$this->getData(null,$str);

			}else{

				return response()->json($result);

			}
		}else{
			
			return response()->json(false);
		}
	}

	protected function getStr($token,$str)
	{
		$encrytionKey = $this->encrytionKey;
		$site = $this->site;

		$encoder  = new Ktki();
		$encoder -> setKey($encrytionKey);

		$postdata = array("nomor_str" => $str);
		$postdataEncrypted = $encoder->encode(json_encode($postdata));
			

		$result = $this->doCurl($site."webservice/str", 
				array("method" => "POST", "post" => $postdataEncrypted),  
				array("Authorization: Bearer ".$token)
			);

		return $result["output"];
	}

	protected function getToken($site,$publicKey,$privateKey)
	{
		$result = $this->doCurl($site."webservice/auth/encryption_key", 
				array("method" => "POST"),  
				array("Authorization: Basic ".base64_encode($publicKey.":".$privateKey))
			);

		//$encode  = new Ktki();
		$result = json_decode($result['output']);
		if($result){
			if($result->success == 'true')
			{
				return $result->token;
			}else{
				return false;
			}
		}
	}
}

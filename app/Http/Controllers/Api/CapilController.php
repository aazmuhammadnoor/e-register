<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataDBPajak;
use App\Http\Ktki;

class CapilController extends Controller
{
	public $site = "http://172.16.160.43:8080/dukcapil/get_json/16-71/dpmptsp_1671/call_nik";
    public $userid = "729201910098ari";
    public $password = "admin123";
    public $ip_user = "103.213.118.114";

    function getnik($nik)
    {
	    $endpoint = $this->site;
		$client = new \GuzzleHttp\Client();

		$data = array(
            "nik"   => $nik,
            "user_id"   => $this->userid,
            "password"   => $this->password,
            "ip_user"   => $this->ip_user
        );

		$postdata = json_encode($data);

		$response = $client->request(
						'POST', 
						$endpoint, 
						[
							"body" => $postdata,
							"headers" => 
							[
								'Accept'        => 'application/json',
                                'Content-Type'  => 'application/json',
							],
                            "exceptions" => false,
						]
					);

		$statusCode = $response->getStatusCode();
		$content = $response->getBody();

        $data = json_decode($content,true);
        // dd($data);
        // if($statusCode == '200'){
            return $data;
            exit(0);
        // }else{
        //     return $data;
        //     exit(0);
        // }
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataDBPajak;
use App\Http\Ktki;

class DjpController extends Controller
{
	public $site = "https://ws.pajak.go.id/";

	function authgettoken()
	{
        $cek_data = DataDBPajak::all();
        foreach ($cek_data as $value) {
            $id = $value->user;
            $pass = $value->pass;
        }

        return $this->GetToken($id, $pass);
	}

    function refauthgettoken($npwp)
    {
        $cek_data = DataDBPajak::all();
        foreach ($cek_data as $value) {
            $id = $value->user;
            $pass = $value->pass;
        }

        $this->RefGetToken($id, $pass, $npwp);
    }

    function GetToken($id, $pass)
    {        
        $endpoint = $this->site."djp/token";
		$client = new \GuzzleHttp\Client();

		$data = array(
            'user'  => $id,
            'pwd'   => $pass
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
							],
                            "exceptions" => false,
						]
					);

		$statusCode = $response->getStatusCode();
		$content = $response->getBody();

		$data = json_decode($content,true);

        if($data['status'] == '200'){
            // echo "Token : ".$data['message'];
            DataDBPajak::where('id_akun_pajak', '1')
                ->update([
                    'token' => $data['message']
                ]);
            return $data;
            exit(0);
        }else if($data['status'] == '203'){
            return "Parameter Salah";
            exit(0);
        }else if($data['status'] == '400'){
            return "Token Tidak Valid";
            exit(0);
        }else if($data['status'] == '401'){
            return "Authhorization tidak ditemukan";
            exit(0);
        }else if($data['status'] == '403'){
            return "Username dan IP Address tidak cocok";
            exit(0);
        }else if($data['status'] == '405'){
            return "Method harus POST";
            exit(0);
        }else if($data['status'] == '406'){
            return "Token Kadalwarsa";
            exit(0);
        }else if($data['status'] == '411'){
            return "NPWP harus 15 digit angka. Kode izin tidak boleh kosong";
            exit(0);
        }

        // dd($data);
    }


    function RefGetToken($id, $pass, $npwp)
    {    
        $endpoint = $this->site."djp/token";
		$client = new \GuzzleHttp\Client();

		$data = array(
            'user'  => $id,
            'pwd'   => $pass
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
							],
                            "exceptions" => false,
						]
					);

		$statusCode = $response->getStatusCode();
		$content = $response->getBody();

		$data = json_decode($content,true);

        if($data['status'] == '200'){
            // echo "Token : ".$data['message'];
            DataDBPajak::where('id_akun_pajak', '1')
                ->update([
                    'token' => $data['message']
                ]);
                $this->GetNpwp($npwp);
        }else if($data['status'] == '203'){
            return "Parameter Salah";
            exit(0);
        }else if($data['status'] == '400'){
            return "Token Tidak Valid";
            exit(0);
        }else if($data['status'] == '401'){
            return "Authhorization tidak ditemukan";
            exit(0);
        }else if($data['status'] == '403'){
            return "Username dan IP Address tidak cocok";
            exit(0);
        }else if($data['status'] == '405'){
            return "Method harus POST";
            exit(0);
        }else if($data['status'] == '406'){
            return "Token Kadalwarsa";
            exit(0);
        }else if($data['status'] == '411'){
            return "NPWP harus 15 digit angka. Kode izin tidak boleh kosong";
            exit(0);
        }

        // dd($data);
    }

    function GetNpwp($npwp)
    {
        $cek_data = DataDBPajak::all();
        foreach ($cek_data as $value) {
            $token = $value->token;
        }

	    $endpoint = $this->site."djp/npwp";
		$client = new \GuzzleHttp\Client();

		$data = array(
            'npwp'  => $npwp
        );

		$postdata = json_encode($data);

        $headers = array(
            'Authorization:'.$token
        );

		$response = $client->request(
						'POST', 
						$endpoint, 
						[
							"body" => $postdata,
							"headers" => 
							[
								'Authorization' => $token,
								'Accept'        => 'application/json',
							],
                            "exceptions" => false,
						]
					);

		$statusCode = $response->getStatusCode();
		$content = $response->getBody();

        $data = json_decode($content,true);
        // dd($data);
        if($data['status'] == '406'){
            $this->refauthgettoken($npwp);
        }else{
            return $data;
            exit(0);
        }
    }
}

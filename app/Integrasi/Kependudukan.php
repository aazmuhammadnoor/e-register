<?php 

namespace App\Integrasi;

class Kependudukan
{
    use Konfigurasi;

    public $data_penduduk;
    public $json;
    protected $token;

    public function __construct($nik)
    {
        if(!is_null($nik) && !empty($nik)){
            $this->json = [
                'app' => $this->app_kependudukan,
                'module' => $this->module_kependudukan,
                'action' => $this->action_kependudukan,
                'json'=>json_encode(['nik'=>$nik])
            ];
            
            $this->RequestDataFromServer();
        }
    }


    protected function RequestTokenFromServer()
    {
        $post_data = [
            'app' => $this->app_kependudukan,
            'module' => $this->module_kependudukan,
            'action' => $this->action_kependudukan,
            'sign' => md5(microtime().mt_rand()),
        ];

        $post_data = $this->encrypt_kependudukan($post_data, $this->api_key_kependudukan);
        $post_data = [
          'username' => $this->username_kependudukan,
          'data' => $post_data
        ];

        $post_data = $this->encrypt_kependudukan($post_data, $this->iv_kependudukan);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $this->url_kependudukan, [
            'debug'       =>false,
            'headers'     => ['Accept-Encoding' => 'gzip'],
            'form_params' => [
                    'data' => $post_data,
                ]
        ]);
        $rs = $response->getBody();
        $data = json_decode($rs,1);
        
        if(isset($data['data'])){
            $this->token = json_decode($this->decrypt_kependudukan($data['data'], $this->api_key_kependudukan))->token;
        }else{
            $this->token = false;
        }
    }

    protected function RequestDataFromServer()
    {
        $this->RequestTokenFromServer();
        if($this->token){
            $post_data = $this->encrypt_kependudukan($this->json, $this->api_key_kependudukan);
            $post_data =[
                'token' => $this->token,
                'data' => $post_data,
            ];
            $post_data = $this->encrypt_kependudukan($post_data, $this->iv_kependudukan);

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $this->url_kependudukan, [
                'debug'       =>false,
                'headers'     => ['Accept-Encoding' => 'gzip'],
                'form_params' => [
                        'data' => $post_data,
                    ]
            ]);
            $rs = $response->getBody();
            $data = json_decode($rs,1);
            if(isset($data['data'])){
                $data_penduduk = $this->decrypt_kependudukan($data['data'], $this->api_key_kependudukan);
                $this->data_penduduk = json_decode($data_penduduk);
            }
        }else{
            dd('invalid token');
        }
    }
}
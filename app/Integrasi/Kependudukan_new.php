<?php 

namespace App\Integrasi;

class Kependudukan_new
{
    use Konfigurasi;
    public $data_penduduk;

    public function __construct($nik)
    {
        if(!is_null($nik) && !empty($nik)){
            $this->json =json_encode(['nik'=>$nik]);
            $this->RequestDataFromServer();
        }
    }

    function RequestDataFromServer()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $this->url_kependudukan_new.$this->json);
        $data = json_decode($res->getBody());
        $this->data_penduduk = $data;
    }
}
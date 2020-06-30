<?php 

namespace App\Integrasi;

class Sms
{
    use Konfigurasi;
    public $permohonan;
    public $jenis;
    public $response;
    public $request;

    function __construct($permohonan, $jenis='testing')
    {
        $this->permohonan = $permohonan;
        $this->jenis = $jenis;
        $this->KirimNotifikasiSMS();
    }

    public function KirimNotifikasiSMS()
    {
        $token = md5($this->sms_sender.$this->permohonan->no_telepon.$this->ComposerPesanSMS().$this->sms_key);
        $base  = base64_encode($this->sms_sender."::".$this->permohonan->no_telepon."::".$this->ComposerPesanSMS()."::".$token);
        $this->request = $this->sms_url.$base;

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $this->request);
        \Storage::put('sms_log.txt', $this->request);
        $this->response = $res->getBody();
    }

    protected function ComposerPesanSMS()
    {
        $txt = "Permohonan ".$this->permohonan->getIzin->name." No ".$this->permohonan->no_pendaftaran." Atas Nama ".$this->permohonan->nama_pemohon." ";
        switch($this->jenis)
        {
            default:
            case 'testing':
                $sms = "Hanya Tes Saja";
            break;
            case 'ditolak':
                $sms = $txt." Ditolak";
            break;
            case 'kurang_syarat':
                $sms = $txt." Kekurangan Syarat";
            break;
            case 'selesai':
                $sms = $txt." Telah Selesai";
            break;
        }

        return $sms;
    }
}
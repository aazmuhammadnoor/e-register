<?php 

namespace App\Integrasi;

trait Konfigurasi
{
    /** Kependudukan */
    private $app_kependudukan = 'kependudukan';
    private $module_kependudukan = 'getDW';
    private $action_kependudukan = 'read';
    private $url_kependudukan = 'http://apis.slemankab.go.id/';
    private $username_kependudukan = 'kependudukan';
    private $api_key_kependudukan = '8483d6ebfc66f56823446ee11d8e2e55';
    private $encrypt_method_kependudukan = 'AES-256-CBC';
    private $iv_kependudukan = 'ABCDEFGH12345678';
    private $url_kependudukan_new = 'https://kependudukan.slemankab.go.id/_i.php/getDW/4064cf43003710679df505303b711ec0/';
    

    /** SMS  */
    private $sms_key = "6740d1ecb48c5c9ca3b2a3cb1ca2f4b4d4487473";
    private $sms_url = "http://smsbroadcast.co.id/api/sendsms/?slm=";
    private $sms_sender = "IZINSLEMAN";

    

    private function use_iv()
    {
        $ver = explode('-', PHP_VERSION);
        $ver = explode('.', $ver[0]);
        if ((int) $ver[0] < 5 || ((int) $ver[0] == 5 && (int) $ver[1] < 3) || ((int) $ver[0] == 5 && (int) $ver[1] == 3 && (int) $ver[2] < 3)) {
            return false;
        } else {
           return true;
        }
    }

    private function encrypt_kependudukan($data, $key)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        if ($this->use_iv() == true) {
            $data = openssl_encrypt($data, $this->encrypt_method_kependudukan, $key, 0, $this->iv_kependudukan);
        } else {
            ini_set('display_errors', 0);
            $data = '[-]'.openssl_encrypt($data, $this->encrypt_method_kependudukan, $key, 0);
        }

        return $data;
    }

    private function decrypt_kependudukan($data, $key)
    {
        if (substr($data, 0, 3) == '[-]') {
            $data = substr_replace($data, '', 0, 3);
            $data = openssl_decrypt($data, $this->encrypt_method_kependudukan, $key, 0);
        } else {
            $data = openssl_decrypt($data, $this->encrypt_method_kependudukan, $key, 0, $this->iv_kependudukan);
        }

        return $data;
    }
}
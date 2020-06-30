<?php

namespace App\Workflow;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Bssn {

    protected $jsignpdf_path;
    protected $pkcs_path;
    protected $pkcs_file;
    protected $passphrase;

    public $source;
    public $output;
    public $option;
    public $result;
    public $error;
    public $info;
    public $is_success;

    public function __construct($source, $output, $pkcs, $passphrase, $option=null) {
        $this->jsignpdf_path = storage_path('jsignpdf/JSignPdf.jar');
        $this->sign = storage_path('pkcs/cap.png');
        $this->source = $source;
        $this->output = $output;
        $this->passphrase = $passphrase;
        $this->option = $option;
        $this->pkcs_file = $pkcs;
        $this->pkcs_path = storage_path('pkcs/'.$this->pkcs_file.'');
        $this->checkJSignPDF();
    }

    protected function checkJSignPDF() {
        if(!file_exists($this->jsignpdf_path)){
            $this->error = "File Executable JSignPDF tidak bisa ditemukan";
            $this->is_success = false;
        }else{
            if(!is_executable($this->jsignpdf_path)){
                $this->error = "File JSignPDF tidak dapat dijalankan";
                $this->is_success = false;
            }else{
                $this->checkPKCSFile();
            }
        }
    }

    protected function checkPKCSFile() {
        if(!file_exists($this->pkcs_path)){
            $this->error = "Sertifikat tidak bisa ditemukan";
            $this->is_success = false;
        }else{
            $this->readPKCSFile();
        }
    }

    protected function readPKCSFile() {
        if(!file_get_contents($this->pkcs_path)) {
            $this->error = "Sertifikat ditemukan, tetapi tidak bisa dibaca oleh sistem";
            $this->is_success = false;
        }else{
            $this->validatePassphrase();
        }
    }
    protected function validatePassphrase() {
        if(!function_exists('openssl_pkcs12_read')) {
            $this->error = "Extensi Open SSL tidak ditemukan";
            $this->is_success = false;
        }else{
            $certificate = file_get_contents($this->pkcs_path);
            if(!openssl_pkcs12_read($certificate, $this->info, $this->passphrase)){
                $this->error = "Passphrase salah";
                $this->is_success = false;
            }else{
                $this->generatedOptionCommand();
            }
        }
    }

    protected function generatedOptionCommand() {
        $command='java -jar '.$this->jsignpdf_path.' '.$this->source.' -kst PKCS12 -ksf '.$this->pkcs_path.' -ksp '.$this->passphrase.' -tsh SHA256 -ha SHA256 -d '.$this->output.' -os "_signed" -llx 8.383561 -lly 451.24298 -urx 602.41876 -ury 87.375984 -V --l4-text "" --l2-text " " -fs 5 --disable-copy --disable-fill --disable-modify-annotations --disable-modify-content -pe PASSWORD -opwd '.$this->passphrase.' -l Palembang -r "Dokumen ini dikeluarkan secara resmi oleh DMPPT Kota Palembang" -c "Pilar Cipta Solusi"';

        /*$command='java -jar '.$this->jsignpdf_path.' '.$this->source.' -kst PKCS12 -ksf '.$this->pkcs_path.' -ksp '.$this->passphrase.' -tsh SHA256 -ha SHA256 -d '.$this->output.' -os "_signed" -llx 291 -lly 194 -urx 826 -ury 8.3 --visible-signature --disable-copy --disable-modify-annotations --disable-modify-content -pe PASSWORD -opwd '.$this->passphrase.' --img-path "'.$this->sign.'" --render-mode GRAPHIC_AND_DESCRIPTION --l2-text "" --l4-text ""';*/

        $this->option = $command;
        $this->signPDFDocument();
    }

    public function signPDFDocument() {
        $process = new Process($this->option);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
            $this->is_success = false;
        }else{
            $this->is_success = true;
        }
    }
}

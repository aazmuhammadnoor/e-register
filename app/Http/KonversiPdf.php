<?php
namespace App\Http;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Signature\Signer;
use App\Workflow\Bssn;

class KonversiPdf{

  public static function Konversi($permohonan, $filename)
  {
    //dd(config('app.soffice'));
    $dokumen = $filename['docx'];
    $rs_path = dokumen_path($permohonan)."/";
    $process = new Process(config('app.soffice')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
    $process->run();
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }else{
        return $filename['pdf'];
    }
  }

  public static function KonversiPencabutan($pencabutan, $filename)
  {
    //dd(config('app.soffice'));
    $dokumen = $filename['docx'];
    $rs_path = dokumen_path_pencabutan($pencabutan)."/";
    $process = new Process(config('app.soffice')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
    $process->run();
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }else{
        return $filename['pdf'];
    }
  }

  public static function TandaTanganDigital($permohonan, $filename,$passphrase=""){
    $pkcs = "akhmad_mustain.p12";
    //$pkcs = "percobaan-bssn.p12";
    $rs_path = dokumen_path($permohonan)."/";
    $ttd_digital = new Bssn($filename['pdf'], $rs_path, $pkcs, $passphrase);
    return $ttd_digital->is_success;
  }

  public static function TandaTanganDigitalPencabutan($pencabutan, $filename,$passphrase=""){
    $pkcs = "akhmad_mustain.p12";
    //$pkcs = "percobaan-bssn.p12";
    $rs_path = dokumen_path_pencabutan($pencabutan)."/";
    $ttd_digital = new Bssn($filename['pdf'], $rs_path, $pkcs, $passphrase);
    return $ttd_digital->is_success;
  }

  public static function convertPDF($path, $filename)
  {
    $dokumen = $filename['docx'];
    $rs_path = \Storage::path($path)."/";
    $process = new Process(config('app.soffice')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
    $process->run();
    if (!$process->isSuccessful()) {
        throw new ProcessFailedException($process);
    }else{
        return $filename['pdf'];
    }
  }
}

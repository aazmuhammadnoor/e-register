<?php

namespace App\Listeners;

use App\Events\SelesaiCetakDokumen;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Signature\Signer;
use App\Workflow\Bssn;

class ConvertToPdfDanSignDokumen
{
    protected $permohonan;
    protected $files_permohonan;
    protected $tplId;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(SelesaiCetakDokumen $event){
        $this->permohonan = $event->permohonan;
        $dokumen = $event->files_permohonan['docx'];
        $rs_path = dokumen_path($this->permohonan)."/";
        $process = new Process(env('SOFFICE_PATH')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }else{
            //$pkcs = "percobaan-bssn.p12";
            //$passphrase = "qwe1234.";
            //$ttd_digital = new Bssn($event->files_permohonan['pdf'], $rs_path, $pkcs, $passphrase);
            //if($ttd_digital->is_success){
                //return $event->files_permohonan['sign'];
            //}
            return $event->files_permohonan['pdf'];
        }
    }

    /**
     * Handle the event.
     *
     * @param  SelesaiCetakDokumen  $event
     * @return void
     */
    public function handle_old(SelesaiCetakDokumen $event)
    {

        $this->permohonan = $event->permohonan;
        $dokumen = $event->files_permohonan['docx'];
        $rs_path = dokumen_path($this->permohonan)."/";
        //$process = new Process(env('SOFFICE_PATH')."soffice --headless --convert-to pdf $dokumen --outdir $rs_path");

        //Path untuk Linux : SOFFICE_PATH="/usr/bin/"
        /* beberapa OS tidak mengizinkan execute langsung tanpa tmp */
        //$process = new Process("export HOME=/tmp && ". env('SOFFICE_PATH')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
        $process = new Process(env('SOFFICE_PATH')."soffice --headless --convert-to pdf:writer_pdf_Export $dokumen --outdir $rs_path");
        $process->run();

		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}else{
            $sign = new Signer();
            $sign->setPDF($event->files_permohonan['pdf']);
            $sign->setPrivateKey('ca/key.pem', 'picsi9090');
            $sign->setX509Certificate('ca/cert.pem');
            $info = [
                'Name'=>'Perizinan Sleman',
                'Location'=>'Sleman',
                'Reason'=>'Tandatangan Digital Bukti Pendaftaran',
                'ContactInfo'=>'http://picsiapps.com'
            ];
            $img_sign = 'themes/img/cert.png';
            $sign->sign($event->files_permohonan['pdf'], $info, null);
            return $event->files_permohonan['pdf'];
		}
    }
}

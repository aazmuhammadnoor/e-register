<?php 

namespace App\Workflow;
use Carbon\Carbon;

class Estimasi
{
    use PerizinanTrait;

    public $tgl_estimasi;
    public $no_pendaftaran;

    public function __construct($permohonan)
    {
        $izin = \App\Models\Izin::findOrFail($permohonan->izin);
		$current = Carbon::now();
		$finish = $current->addDays($izin->lama_proses);
        $this->tgl_estimasi  = $finish->format('Y-m-d'); 
        $this->no_pendaftaran = $this->NomorPendaftaran(auth()->user()->name, $izin);
    }
}
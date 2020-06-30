<?php

namespace App\Workflow;

use App\Models\Workflow;
use App\Models\Task;
use App\Models\Permohonan;
use App\Models\Izin;
use App\Models\Verifikasi;
use App\Notifications\NotifikasiPerizinan;

class PencabutanWorkflow
{
    public $jenis_permohonan_izin = null;
    public $event = 'mulai';
    public $task  = 'pencabutan';
    public $executor;
    public $daftar_online = false;
    public $workflow_token;
    public $workflow_id;

    public function __construct($token)
    {
        $this->executor = auth()->user()->nama;
        $this->workflow_token = $token;
        $this->StartPencabutan();

    }

    protected function StartPencabutan()
    {
        $workflow = new Workflow;
        $workflow->event = $this->event;
        $workflow->task  = $this->task;
        $workflow->executor = $this->executor;
        $workflow->token = $this->workflow_token;
        $workflow->save();
        $this->workflow_id = $workflow->id;
    }

    static function ToPendaftaranFromPemohon($new_workflow)
    {
        Step::SetLoopTask($new_workflow->workflow_id, [
            'event'=>'selesai',
            'sub_task'=>'melengkapi.persyaratan',
            'next_task'=>'pemeriksaan.berkas',
            'executor'=>'Pemohon: '.auth()->user()->nama
        ]);

        Step::SetLoopTask($new_workflow->workflow_id, [
            'event'=>'mulai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'pemeriksaan.berkas',
            'executor'=>'Bagian Pengaduan'
        ]);
    }

    static function ToKasiFromPendaftaran($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'approval.pemeriksaan.berkas',
            'executor'=>'Bagian Pengaduan: '.auth()->user()->name
        ]);

        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.pemeriksaan.berkas.kasi',
            'next_task'=>'approval.pemeriksaan.berkas.kasi',
            'executor'=>'KASI'
        ]);

        $pencabutan->posisi = 'kasi';
        $pencabutan->pengaduan_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    static function ToKabidFromKasi($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'approval.pemeriksaan.berkas.kasi',
            'next_task'=>'approval.pemeriksaan.berkas.kabid',
            'executor'=>'KASI: '.auth()->user()->name
        ]);

        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.pemeriksaan.berkas.kadin',
            'next_task'=>'approval.pemeriksaan.berkas.kadin',
            'executor'=>'KABID'
        ]);

        $pencabutan->posisi = 'kabid';
        $pencabutan->kasi_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    static function ToKadinFromKabid($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'approval.pemeriksaan.berkas.kabid',
            'next_task'=>'tanda.tangan.sk.pencabutan',
            'executor'=>'KABID: '.auth()->user()->name
        ]);

        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'tanda.tangan.sk.pencabutan',
            'next_task'=>'tanda.tangan.sk.pencabutan',
            'executor'=>'KADIN'
        ]);

        $pencabutan->posisi = 'kadin';
        $pencabutan->kabid_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    static function ToPengambilanFromKadin($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'tanda.tangan.sk.pencabutan',
            'next_task'=>'pengambilan.berkas',
            'executor'=>'KADIN: '.auth()->user()->name
        ]);

        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pengambilan.berkas',
            'next_task'=>'pengambilan.berkas',
            'executor'=>'PENGAMBILAN'
        ]);

        $pencabutan->posisi = 'pengambilan';
        $pencabutan->kadin_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    static function ToArsipFromPengambilan($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pengambilan.berkas',
            'next_task'=>'pengarsipan',
            'executor'=>'PENGAMBILAN: '.auth()->user()->name
        ]);

        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pengarsipan',
            'next_task'=>'pengarsipan',
            'executor'=>'ARSIP'
        ]);

        $pencabutan->posisi = 'arsip';
        $pencabutan->pengambilan_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    static function ToSelesaiFromArsip($pencabutan)
    {
        Step::SetLoopTask($pencabutan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pengarsipan',
            'next_task'=>'pengarsipan',
            'executor'=>'ARSIP: '.auth()->user()->name
        ]);

        $pencabutan->posisi = 'selesai';
        $pencabutan->arsip_oleh = auth()->user()->id;
        $pencabutan->save();
    }

    /*static function ToPendaftaranFromPemohon($pencabutan)
    {
        $pencabutan->posisi = 'pendaftaran';
        $pencabutan->save();
    }

    static function ToKasiFromPendaftaran($pencabutan)
    {
        $pencabutan->posisi = 'kasi';
        $pencabutan->save();
    }

    static function ToKabidFromKasi($pencabutan)
    {
        $pencabutan->posisi = 'kabid';
        $pencabutan->save();
    }

    static function ToKadinFromKabid($pencabutan)
    {
        $pencabutan->posisi = 'kadin';
        $pencabutan->save();
    }

    static function ToPengambilanFromKadin($pencabutan)
    {
        $pencabutan->posisi = 'pengambilan';
        $pencabutan->save();
    }

    static function ToArsipFromPengambilan($pencabutan)
    {
        $pencabutan->posisi = 'arsip';
        $pencabutan->save();
    }*/

}
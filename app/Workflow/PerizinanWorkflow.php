<?php

namespace App\Workflow;

use App\Models\Workflow;
use App\Models\Task;
use App\Models\Permohonan;
use App\Models\Izin;
use App\Models\Verifikasi;
use App\Notifications\NotifikasiPerizinan;

class PerizinanWorkflow
{
    use PerizinanTrait;

    static function ToPemohonFromPendaftaran($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'melengkapi.persyaratan',
            'executor'=>'Bagian Pendaftaran: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'melengkapi.persyaratan',
            'next_task'=>'melengkapi.persyaratan',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_pendaftaran = 1;
        $permohonan->pendaftaran_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToPemohonForSPMFromPendaftaran($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'membayar',
            'executor'=>'Bagian Pendaftaran: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'membayar',
            'next_task'=>'membayar',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_pendaftaran = 1;
        $permohonan->pendaftaran_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToPendaftaranFromPemohon($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'melengkapi.persyaratan',
            'next_task'=>'pemeriksaan.berkas',
            'executor'=>'Pemohon: '.auth()->user()->nama
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'pemeriksaan.berkas',
            'executor'=>'Bagian Pendaftaran'
        ]);

        $permohonan->posisi = 'pendaftaran';
        $permohonan->save();
    }

    static function ToKasiFromPendaftaran($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pemeriksaan.berkas',
            'next_task'=>'approval.pemeriksaan.berkas',
            'executor'=>'Bagian Pendaftaran: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.pemeriksaan.berkas',
            'next_task'=>'approval.pemeriksaan.berkas',
            'executor'=>'KASI'
        ]);

        $permohonan->dari_pendaftaran = 1;
        $permohonan->pendaftaran_oleh = auth()->user()->id;
        $permohonan->posisi = 'kasi.approval.pemeriksaan.berkas';
        $permohonan->save();
    }

    static function ToKorlapFromKasi($permohonan, $api=false, $user=null)
    {
        $executor_name = (!$api) ? auth()->user()->name : $user->name;
        $executor_id = (!$api) ? auth()->user()->id : $user->id;

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'approval.pemeriksaan.berkas',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'KASI: '.$executor_name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'Korlap'
        ]);

        $permohonan->dari_kasi_apb = 1;
        $permohonan->kasi_apb_oleh = $executor_id;
        $permohonan->posisi = 'korlap';
        $permohonan->save();
    }

    static function ToTimTeknisFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'survey',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'survey',
            'next_task'=>'survey',
            'executor'=>'Tim Teknis'
        ]);

        $permohonan->dari_korlap = 1;
        $permohonan->korlap_oleh = auth()->user()->id;
        $permohonan->posisi = 'tim.teknis';
        $permohonan->save();
    }

    static function ToKorlapFromTimTeknis($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'survey',
            'next_task'=>'bap',
            'executor'=>'Tim Teknis: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'bap',
            'next_task'=>'bap',
            'executor'=>'Korlap'
        ]);

        $permohonan->dari_tim_teknis = 1;
        $permohonan->tim_teknis_oleh = auth()->user()->id;
        $permohonan->posisi = 'korlap.bap';
        $permohonan->save();
    }

    static function ToPemohonFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_korlap = 1;
        $permohonan->korlap_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToPemohonFromKorlapBAP($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_korlap_bap = 1;
        $permohonan->korlap_bap_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToPemohonFromKorlapFirst($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_korlap = 1;
        $permohonan->korlap_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToPemohonFromKasi($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Kasi: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'memperbaiki.berkas',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_kasi_apb = 1;
        $permohonan->kasi_apb_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }


    static function ToKasiFromPemohon($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'Pemohon: '.auth()->user()->nama
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'kasi.approval.pemeriksaan.berkas',
            'next_task'=>'kasi.approval.pemeriksaan.berkas',
            'executor'=>'Kasi'
        ]);

        $permohonan->posisi = 'kasi.approval.pemeriksaan.berkas';
        $permohonan->save();
    }

    static function ToKorlapFromPemohon($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'Pemohon: '.auth()->user()->nama
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'Korlap'
        ]);

        $permohonan->posisi = 'korlap';
        $permohonan->save();
    }

    static function ToKorlapBAPFromPemohon($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'memperbaiki.berkas',
            'next_task'=>'pembahasan.teknis',
            'executor'=>'Pemohon: '.auth()->user()->nama
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'bap',
            'next_task'=>'bap',
            'executor'=>'Korlap'
        ]);

        $permohonan->posisi = 'korlap.bap';
        $permohonan->save();
    }

    static function ToCetakSKFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'bap',
            'next_task'=>'cetak.sk',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'cetak.sk',
            'next_task'=>'cetak.sk',
            'executor'=>'Bo Cetak SK'
        ]);

        $permohonan->dari_korlap_bap = 1;
        $permohonan->korlap_bap_oleh = auth()->user()->id;
        $permohonan->posisi = 'bo.cetak.sk';
        $permohonan->save();
    }

    static function ToCetakSPMFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'cetak.spm',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'cetak.spm',
            'next_task'=>'cetak.spm',
            'executor'=>'Bo Cetak SPM'
        ]);

        $permohonan->dari_korlap_bap = 1;
        $permohonan->korlap_bap_oleh = auth()->user()->id;
        $permohonan->posisi = 'bo.cetak.spm';
        $permohonan->save();
    }

    static function ToSKRDFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pembahasan.teknis',
            'next_task'=>'skrd',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'skrd',
            'next_task'=>'skrd',
            'executor'=>'BO SKRD'
        ]);

        $permohonan->dari_korlap_bap = 1;
        $permohonan->korlap_bap_oleh = auth()->user()->id;
        $permohonan->posisi = 'bo.skrd';
        $permohonan->save();
    }

    static function ToPemohonFromCetakSPM($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'cetak.spm',
            'next_task'=>'membayar',
            'executor'=>'Bo Cetak SPM: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'membayar',
            'next_task'=>'membayar',
            'executor'=>'Pemohon'
        ]);

        $permohonan->dari_cetak_spm = 1;
        $permohonan->cetak_spm_oleh = auth()->user()->id;
        $permohonan->posisi = 'pemohon';
        $permohonan->save();
    }

    static function ToBendaharaFromPemohon($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'membayar',
            'next_task'=>'verifikasi.pembayaran',
            'executor'=>'Pemohon: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'verifikasi.pembayaran',
            'next_task'=>'verifikasi.pembayaran',
            'executor'=>'Bendahara'
        ]);

        $permohonan->posisi = 'bendahara';
        $permohonan->save();
    }

    static function ToSKRDFromBendahara($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'verifikasi.pembayaran',
            'next_task'=>'skrd',
            'executor'=>'Bendahara: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'skrd',
            'next_task'=>'skrd',
            'executor'=>'BO SKRD'
        ]);

        $permohonan->dari_bendahara = 1;
        $permohonan->bendahara_oleh = auth()->user()->id;
        $permohonan->posisi = 'bo.skrd';
        $permohonan->save();
    }

    static function ToKasiFromSKRD($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'skrd',
            'next_task'=>'approval.cetak.sk',
            'executor'=>'BO SKRD: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.cetak.sk',
            'next_task'=>'approval.cetak.sk',
            'executor'=>'KASI'
        ]);

        $permohonan->dari_skrd = 1;
        $permohonan->skrd_oleh = auth()->user()->id;
        $permohonan->posisi = 'kasi.approval.cetak.sk';
        $permohonan->save();
    }

    static function ToKasiFromBendahara($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'verifikasi.pembayaran',
            'next_task'=>'approval.pemeriksaan.berkas',
            'executor'=>'Bendahara: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.pemeriksaan.berkas',
            'next_task'=>'approval.pemeriksaan.berkas',
            'executor'=>'KASI'
        ]);

        $permohonan->dari_bendahara = 1;
        $permohonan->bendahara_oleh = auth()->user()->id;
        $permohonan->posisi = 'kasi.approval.pemeriksaan.berkas';
        $permohonan->save();
    }

    static function ToKasiFromCetakSK($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'cetak.sk',
            'next_task'=>'approval.cetak.sk',
            'executor'=>'Bo Cetak SK: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.cetak.sk',
            'next_task'=>'approval.cetak.sk',
            'executor'=>'KASI'
        ]);

        $permohonan->dari_cetak_sk = 1;
        $permohonan->cetak_sk_oleh = auth()->user()->id;
        $permohonan->posisi = 'kasi.approval.cetak.sk';
        $permohonan->save();
    }

    static function ToKabidFromKasi($permohonan, $api=false, $user=null)
    {
        $executor_name = (!$api) ? auth()->user()->name : $user->name;
        $executor_id = (!$api) ? auth()->user()->id : $user->id;

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'approval.cetak.sk',
            'next_task'=>'approval.draft',
            'executor'=>'KASI: '.$executor_name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'approval.draft',
            'next_task'=>'approval.draft',
            'executor'=>'KABID'
        ]);

        $permohonan->dari_kasi_acs = 1;
        $permohonan->kasi_acs_oleh = $executor_id;
        $permohonan->posisi = 'kabid';
        $permohonan->save();
    }

    static function ToKadinFromKabid($permohonan, $api=false, $user=null)
    {
        $executor_name = (!$api) ? auth()->user()->name : $user->name;
        $executor_id = (!$api) ? auth()->user()->id : $user->id;

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'approval.draft',
            'next_task'=>'sign.draft',
            'executor'=>'KABID: '.$executor_name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'sign.draft',
            'next_task'=>'sign.draft',
            'executor'=>'KADIN'
        ]);

        $permohonan->dari_kabid = 1;
        $permohonan->kabid_oleh = $executor_id;
        $permohonan->posisi = 'kadin';
        $permohonan->save();
    }

    static function ToPengambilanFromKadin($permohonan, $api=false, $user=null)
    {
      $executor_name = (!$api) ? auth()->user()->name : $user->name;
      $executor_id = (!$api) ? auth()->user()->id : $user->id;

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'sign.draft',
            'next_task'=>'pengambilan',
            'executor'=>'KADIN: '.$executor_name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pengambilan',
            'next_task'=>'pengambilan',
            'executor'=>'Pengambilan'
        ]);

        $permohonan->dari_kadin = 1;
        $permohonan->kadin_oleh = $executor_id;
        $permohonan->posisi = 'pengambilan';
        $permohonan->save();
    }

    static function ToArsipFromPengambilan($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pengambilan',
            'next_task'=>'arsip',
            'executor'=>'Pengambilan: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'arsip',
            'next_task'=>'arsip',
            'executor'=>'Bagian Arsip'
        ]);

        $permohonan->dari_pengambilan = 1;
        $permohonan->pengambilan_oleh = auth()->user()->id;
        $permohonan->posisi = 'arsip';
        $permohonan->save();
    }

    static function ToSelesaiFromArsip($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'arsip',
            'next_task'=>'arsip',
            'executor'=>'Bagian Arsip: '.auth()->user()->name
        ]);

        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'selesai',
            'next_task'=>'selesai',
            'executor'=>'Selesai'
        ]);

        $permohonan->dari_arsip = 1;
        $permohonan->arsip_oleh = auth()->user()->id;
        $permohonan->posisi = 'selesai';
        $permohonan->save();
    }

    static function ToTolakFromKorlap($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'tolak',
            'sub_task'=>'penolakan.korlap',
            'next_task'=>'penolakan.pemohon',
            'executor'=>'Korlap: '.auth()->user()->name
        ]);

        $permohonan->posisi = 'tolak';
        $permohonan->save();
    }

    static function ToTolakFromPendaftaran($permohonan)
    {
        Step::SetLoopTask($permohonan->workflow, [
            'event'=>'tolak',
            'sub_task'=>'penolakan.pendaftaran',
            'next_task'=>'penolakan.pemohon',
            'executor'=>'Pendaftaran: '.auth()->user()->name
        ]);

        $permohonan->posisi = 'tolak';
        $permohonan->save();
    }

}

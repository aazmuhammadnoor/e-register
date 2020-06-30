<?php

namespace App\Workflow;

use App\Models\Workflow;
use App\Models\Task;
use App\Models\Permohonan;
use App\Models\Izin;
use App\Models\Verifikasi;
use App\Notifications\NotifikasiPerizinan;

class Verifikasi_Permohonan
{
    use PerizinanTrait;

    public function Set_Masuk_Verifikasi($id_permohonan)
    {
        $success = false;
        if(is_array($id_permohonan))
        {
            $permohonan = Permohonan::whereIn('id', $id_permohonan)->get();
            foreach($permohonan as $val)
            {
                $step = Step::SetLoopTask($val->workflow, [
                    'event'=>'mulai',
                    'sub_task'=>'verifikasi.permohonan',
                    'next_task'=>'',
                    'flags'=>'new',
                    'executor'=>auth()->user()->name
                ]);
                $val->posisi = 'verifikasi';
                $val->save();
                $petugas = \App\Models\Role::where('id', 3)->first();
                $petugas->notify(new NotifikasiPerizinan($val,'verifikasi','Menunggu Proses Verifikasi'));
                if($step){
                    $success = true;
                }

            }
        }

        return $success;
    }

    function Set_Task_Verifikasi($id_permohonan, $status, $task='verifikasi.permohonan')
    {

        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>$task,
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);

        switch($status['is_approved'])
        {
            default:
            case '0':
                $this->Set_Kembalikan_Ke_Bagian_Pendaftaran($id_permohonan, $status);
            break;
            case '1':
            $this->Set_Ditolak($id_permohonan, $status);
            break;
            case '2':
                $this->Set_Proses_Tinjau($id_permohonan, $status);
            break;
            case '3':
            $this->Set_Proses_Draft($id_permohonan, $status);
            break;
            case '4':
                $this->Set_Proses_RapatKoordinasi($id_permohonan, $status);
            break;
            case '5':
                $this->Set_Proses_Pembayaran_Retribusi($id_permohonan, $status);
            break;
            case '6':
            $this->Set_Proses_Legalisasi($id_permohonan, $status);
            break;
            case '7':
                $this->Set_Proses_Selesai($id_permohonan, $status);
            break;
            case '8':
                $this->Set_Proses_Diambil($id_permohonan, $status);
            break;
            case '9':
                $this->Set_Proses_Dibatalkan($id_permohonan, $status);
            break;
        break;
        }
    }

    function Set_Kembalikan_Ke_Bagian_Pendaftaran($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'melengkapi.kekurangan',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);

        $id_permohonan->posisi = 'pendaftaran';
        $id_permohonan->save();
    }

    function Set_Ditolak($id_permohonan, $status)
    {
        Step::SetTask($id_permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'permohonan.ditolak',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);

        $id_permohonan->posisi = 'ditolak';
        $id_permohonan->save();
    }

    function Set_Proses_Tinjau($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'proses.tinjau',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'tinjau';
        $id_permohonan->save();
    }

    function Set_Proses_Draft($id_permohonan, $status)
    {
        Step::SetTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pengetikan.draft.keputusan',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'draft';
        $id_permohonan->save();
    }

    function Set_Proses_RapatKoordinasi($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'rapat.pasca.tinjau',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'rapat.pasca.tinjau';
        $id_permohonan->save();
    }

    function Set_Proses_Pembayaran_Retribusi($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pembayaran.retribusi',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'retribusi';
        $id_permohonan->save();
    }

    function Set_Proses_Legalisasi($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'legalisasi.permohonan',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'legalisasi';
        $id_permohonan->save();
    }

    function Set_Proses_Selesai($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'mulai',
            'sub_task'=>'pengambilan.berkas.perizinan',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'selesai';
        $id_permohonan->save();
    }

    function Set_Proses_Diambil($id_permohonan, $status)
    {
        $id_permohonan->posisi = 'diambil';
        $id_permohonan->save();
    }

    function Set_Proses_Dibatalkan($id_permohonan, $status)
    {
        Step::SetLoopTask($id_permohonan->workflow, [
            'event'=>'selesai',
            'sub_task'=>'pendaftaran.dibatalkan',
            'next_task'=>$status['keterangan'],
            'executor'=>auth()->user()->name
        ]);
        $id_permohonan->posisi = 'batal';
        $id_permohonan->save();
    }
}

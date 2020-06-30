<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Permohonan;

class Informasi extends Controller
{
    public function ListPerizinan()
    {
        $izin = Izin::all();
        if($izin)
        {
            $arr['status'] = true;
            foreach($izin as $rs)
            {
                $arr['data'][] = [
                    'id'=>$rs->id,
                    'kode'=>$rs->kode,
                    'bidang'=>$rs->getKategori->name,
                    'name'=>$rs->name,
                    'proses'=>$rs->lama_proses,
                    'retribusi'=>$rs->biaya_retribusi,
                    'dasar_hukum'=>$rs->dasar_hukum
                ];
            }

            return response()->json($arr);
        }else{
            return response()->json(['status'=>false]);
        }
    }

    public function DetailPerizinan(Izin $izin)
    {
        $arr = [
            'status'=>true,
            'data'=>[
                'id'=>$izin->id,
                'kode'=>$izin->kode,
                'bidang'=>$izin->getKategori->name,
                'name'=>$izin->name,
                'proses'=>$izin->lama_proses,
                'retribusi'=>$izin->biaya_retribusi,
                'syarat'=>$izin->syarat()->get()->pluck('name')->toArray(),
                'dasar_hukum'=>$izin->dasar_hukum
            ]
        ];

        return response()->json($arr);
    }

    public function StatusPermohonan(Request $r)
    {
        $per = \App\Models\Permohonan::where('no_pendaftaran', $r->no_pendaftaran)->first();
        if($per){
            $arr = [
                'status'=>true,
                'data'=>[
                    'id'=>$per->id,
                    'nama_pemohon'=>$per->nama_pemohon,
                    'no_telepon'=>$per->no_telepon,
                    'nik'=>$per->nik,
                    'badan_usaha'=>$per->badan_usaha."(".$per->ket_badan_usaha.")",
                    'lokasi'=>$per->lokasi_dukuh." ".$per->lokasi_kel." ".$per->lokasi_kec,
                    'permohonan'=>$per->getIzin->name,
                    'tgl_pendaftaran'=>date_day($per->tgl_pendaftaran),
                    'estimasi_selesai'=>date_day($per->estimasi_selesai),
                    'status'=>$per->getWorkflowStatus->getSubtask()->latest()->first()->sub_task,
                    'posisi'=>$per->posisi
                ]
            ];

            return response()->json($arr);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'Nomor Pendaftaran Tidak Ditemukan'
            ]);
        }
    }

    function statistik_all()
    {
        $statistik = \DB::table('permohonan')
                 ->select('posisi', \DB::raw('count(*) as total'))
                 ->groupBy('posisi')
                 ->get();
        return response()->json($statistik);
    }

    function StatistikByIzin(){
        $sts = \DB::table('daftar_izin')->select('name','kode','singkatan',\DB::raw('(select count(*) from permohonan where izin=daftar_izin.id) as total '))
            ->whereNotNull('kode')
            ->get();
        return response()->json($sts);
    }

    function wilayah($kec=null)
    {
        if(is_null($kec)){
            $wil = \App\Models\Kecamatan::select('id','name')->get();
        }else{
            $wil = \App\Models\Kelurahan::select('id','name')->where('kecamatan', $kec)->get();
        }

        return response()->json($wil);
    }

    function IzinByWilayah($kec, $kel=null)
    {
        if(!is_null($kel)){
            $izin = Permohonan::where('lokasi_kec', $kec)
                ->where('lokasi_kel', $kel)
                ->get();
        }else{
            $izin = Permohonan::where('lokasi_kec', $kec)->get();
        }

        if($izin->count() > 0){
            $res = [
                'status'=>true,
                'izin'=>$izin
            ];
        }else{
            $res = [
                'status'=>false
            ];
        }

        return response()->json($res);
    }

    function TimelineIzin($no_pendaftaran)
    {
        $id = Permohonan::where('no_pendaftaran', $no_pendaftaran)->first();
        if($id){
            $ijin['status'] = true;
            $ijin['timeline'] = [
                'no_pendaftaran'=>$id->no_pendaftaran,
                'nama_pemohon'=>$id->nama_pemohon,
                'alamat_pemohon'=>$id->alamat_pemohon,
                'telp_pemohon'=>$id->telp_pemohon,
                'nama_izin'=>$id->getIzin->name,
                'timeline'=>$id->getWorkflowStatus->getSubtaskTimeline()->get()
            ];
        }else{
            $ijin = ['status'=>false];
        }


        return response()->json($ijin);
    }

}

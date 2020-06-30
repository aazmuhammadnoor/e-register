<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\Pencabutan;
use App\Workflow\PencabutanWorkflow;

class PencabutanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:pendaftar');
    }

    function Home()
    {
        $title = "Permohonan Pencabutan Izin Dokter";
        $id_pendaftar = auth()->user()->id;      
        $rs = Pencabutan::where('id_pendaftar', $id_pendaftar)->orderBy('tgl_pendaftaran','desc')->paginate(10);
        $no = $rs->firstItem();
        return view('anggota.pencabutan.home',compact('title','rs','no'));
    }

    function AddPencabutan()
    {
        $title = "Permohonan Pencabutan Izin";
        $id_pendaftar = auth()->user()->id;      
        $rs = Permohonan::select("permohonan.*")
                ->join('m_jenis_permohonan_izin', 'permohonan.izin', '=', 'm_jenis_permohonan_izin.id')
                /*->join('m_jenis_izin', function ($join) {
                    $join->on('m_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                         ->where(function ($query) {
                                $query->where('m_jenis_izin.kode', '=', '02.11.00.00')
                                      ->orWhere('m_jenis_izin.kode', '=', '02.12.00.00');
                           });
                })*/
                ->where('id_pendaftar', $id_pendaftar)
                ->where(function($q) {
                    $q->where('posisi', 'pengambilan')
                      ->orWhere('posisi', 'arsip')
                      ->orWhere('posisi', 'diarsipkan')
                      ->orWhere('posisi', 'selesai');
                })
                ->whereNull('is_cabut')
                ->orderBy('tgl_pendaftaran', 'desc')
                ->paginate(10);
        $no = $rs->firstItem();
        return view('anggota.pencabutan.add',compact('title','rs','no'));
    }

    function ProsesPencabutan(Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        $title = 'Permohonan Pencabutan Izin';

        if($per->posisi != 'pengambilan' && $per->posisi != 'arsip' && $per->posisi != 'diarsipkan' && $per->posisi != 'selesai'){
            abort(404, 'Page not found');
        }

        //cekizinproses
        $cabut = Pencabutan::where("id_permohonan",$per->id)->count();
        if($cabut > 0){
            abort(404, 'Page not found');
        }

        $kat = $per->getIzin->jenisIzin->kategoriProfil;

        if ($kat->id == 1) {
            $permohonan_profile = 'admin.proses.partial.data_profesi';
        } else if ($kat->id == 2) {
            $permohonan_profile = 'admin.proses.partial.data_perusahaan';
        } else if ($kat->id == 3) {
            $permohonan_profile = 'admin.proses.partial.data_pembangunan';
        } else if ($kat->id == 4) {
            $permohonan_profile = 'admin.proses.partial.data_ketenagakerjaan';
        } else if ($kat->id == 5) {
            $permohonan_profile = 'admin.proses.partial.data_lingkungan';
        } else if ($kat->id == 6) {
            $permohonan_profile = 'admin.proses.partial.data_reklame';
        } else if ($kat->id == 7) {
            $permohonan_profile = 'admin.proses.partial.data_transportasi';
        }

        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        return view('anggota.pencabutan.proses', compact('title','per','meta','permohonan_profile'));
    }

    function SaveProsesPencabutan(Request $r, Permohonan $per)
    {
        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        //cekizinproses
        $cabut = Pencabutan::where("id_permohonan",$per->id)->count();
        if($cabut > 0){
            abort(404, 'Page not found');
        }

        $this->validate($r, [
            'catatan_pencabutan'=>'required',
            'upload_surat_keterangan'=>'required',
            'upload_sk_lama'=>'required',
            'upload_permohonan_pencabutan'=>'required'
        ]);

        if($per->posisi != 'pengambilan' && $per->posisi != 'arsip' && $per->posisi != 'diarsipkan' && $per->posisi != 'selesai'){
            abort(404, 'Page not found');
        }

        /**
         * buat nomor pendaftaran pencabutan
         */
        $bulan = date('Y-m');
        $cabut = Pencabutan::where("tgl_pendaftaran","like",$bulan."%");
        if($cabut->count() == 0){
            $no = 0;
        }else{
            $cabut = $cabut->orderBy('no_pendaftaran','DESC')
                            ->limit(1)
                            ->first();
            $no = explode('.', $cabut->no_pendaftaran);
            $no = $no[0];
            $no = (int) $no;
        }
        $new_no = sprintf('%04d', $no+1);
        $no_pendaftaran = $new_no.".".date('m.Y');

        if($r->hasFile('upload_surat_keterangan')) {
            $upload_surat_keterangan = $r->file('upload_surat_keterangan');
            $ext = explode(".", $r->file['name']);
            $file_upload_surat_keterangan = $upload_surat_keterangan->storeAs('pencabutan/'.$no_pendaftaran,"upload_surat_keterangan_".$no_pendaftaran.".".$upload_surat_keterangan->getClientOriginalExtension());
        }

        if($r->hasFile('upload_permohonan_pencabutan')) {
            $upload_permohonan_pencabutan = $r->file('upload_permohonan_pencabutan');
            $ext = explode(".", $r->file['name']);
            $file_upload_permohonan_pencabutan = $upload_permohonan_pencabutan->storeAs('pencabutan/'.$no_pendaftaran,"upload_permohonan_pencabutan_".$no_pendaftaran.".".$upload_permohonan_pencabutan->getClientOriginalExtension());
        }

        if($r->hasFile('upload_sk_lama')) {
            $upload_sk_lama = $r->file('upload_sk_lama');
            $ext = explode(".", $r->file['name']);
            $file_upload_sk_lama = $upload_sk_lama->storeAs('pencabutan/'.$no_pendaftaran,"upload_sk_lama_".$no_pendaftaran.".".$upload_sk_lama->getClientOriginalExtension());
        }
        $new_workflow =  new PencabutanWorkflow(uniqid());

        $pencabutan = new Pencabutan();
        $pencabutan->id_pendaftar = auth()->user()->id;
        $pencabutan->id_permohonan = $per->id;
        $pencabutan->workflow = $new_workflow->workflow_id;
        $pencabutan->tgl_pendaftaran = \Carbon\Carbon::now();
        $pencabutan->no_pencabutan = $no_pendaftaran;
        $pencabutan->catatan = $r->catatan_pencabutan;
        $pencabutan->upload_sk_lama = $file_upload_sk_lama;
        $pencabutan->upload_permohonan_pencabutan = $file_upload_permohonan_pencabutan;
        $pencabutan->upload_surat_keterangan = $file_upload_surat_keterangan;
        $pencabutan->posisi = "pengaduan";
        $pencabutan->save();

        $per->is_cabut = 1;
        $per->save();

        PencabutanWorkflow::ToPendaftaranFromPemohon($new_workflow);

        flash('Permohonan pencabutan berhasil disubmit ke Bagian Pendaftaran')->success();
        return redirect('pencabutan');        
    }

    function DetailPencabutan(Pencabutan $pencabutan)
    {
        $per = $pencabutan->getPermohonan;
        $title = 'Permohonan Pencabutan Izin';

        /*---auth---*/
        $auth = auth()->user()->id;
        $user = $per->getPendaftar->id;
        if($auth != $user){
            return abort('404');
        }
        /*---/auth---*/

        if($per->posisi != 'pengambilan' && $per->posisi != 'arsip' && $per->posisi != 'diarsipkan' && $per->posisi != 'selesai'){
            abort(404, 'Page not found');
        }

        $kat = $per->getIzin->jenisIzin->kategoriProfil;

        if ($kat->id == 1) {
            $permohonan_profile = 'admin.proses.partial.data_profesi';
        } else if ($kat->id == 2) {
            $permohonan_profile = 'admin.proses.partial.data_perusahaan';
        } else if ($kat->id == 3) {
            $permohonan_profile = 'admin.proses.partial.data_pembangunan';
        } else if ($kat->id == 4) {
            $permohonan_profile = 'admin.proses.partial.data_ketenagakerjaan';
        } else if ($kat->id == 5) {
            $permohonan_profile = 'admin.proses.partial.data_lingkungan';
        } else if ($kat->id == 6) {
            $permohonan_profile = 'admin.proses.partial.data_reklame';
        } else if ($kat->id == 7) {
            $permohonan_profile = 'admin.proses.partial.data_transportasi';
        }

        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        return view('anggota.pencabutan.detail', compact('title','per','meta','permohonan_profile','pencabutan'));
    }
      
}

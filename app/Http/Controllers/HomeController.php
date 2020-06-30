<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\KategoriProfil;
use App\Models\Tutorial;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {   
        return view('home');
    }

    function Lists($posisi) {
        if ($posisi == 'total') {
            $title = 'Daftar Permohonan Total';

            $rs = Permohonan::select("permohonan.*")
                    ->join('m_jenis_permohonan_izin', function ($join) use ($posisi) {
                          $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '!=', 'arsip');
                    })
                    ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                    ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                    ->orderBy('tgl_pendaftaran','desc')
                    ->paginate(20);

            $no = $rs->firstItem();

            return view('list',compact('title','rs','no', 'posisi'));
        } else if ($posisi == 'today') {
            $title = 'Daftar Permohonan Hari Ini`';

            $rs = Permohonan::select("permohonan.*")
                    ->join('m_jenis_permohonan_izin', function ($join) use ($posisi) {
                          $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.tgl_pendaftaran', '=', date('Y-m-d'));
                    })
                    ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                    ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                    ->orderBy('tgl_pendaftaran','desc')
                    ->paginate(20);

            $no = $rs->firstItem();

            return view('list',compact('title','rs','no', 'posisi'));            
        } else if ($posisi == 'pemohon') {
            $title = 'Daftar Permohonan Posisi Di Pemohon';
        } else if ($posisi == 'pendaftaran') {
            $title = 'Daftar Permohonan Posisi Di Pendaftaran: Pemeriksaan Berkas';
        } else if ($posisi == 'kasi.approval.pemeriksaan.berkas') {
            $title = 'Daftar Permohonan Posisi Di KASI: Pemeriksaan Berkas';
        } else if ($posisi == 'korlap') {
            $title = 'Daftar Permohonan Posisi Di KORLAP: Pembahasan Teknis';
        } else if ($posisi == 'tim.teknis') {
            $title = 'Daftar Permohonan Posisi Di Tim Teknis: Survey';
        } else if ($posisi == 'korlap.bap') {
            $title = 'Daftar Permohonan Posisi Di KORLAP: Rekomendasi Teknis';
        } else if ($posisi == 'bo.cetak.sk') {
            $title = 'Daftar Permohonan Posisi Di BO: Cetak SK';
        } else if ($posisi == 'bo.cetak.spm') {
            $title = 'Daftar Permohonan Posisi Di BO: Cetak SPM';
        } else if ($posisi == 'bo.skrd') {
            $title = 'Daftar Permohonan Posisi Di BO: SKRD';
        } else if ($posisi == 'bendahara') {
            $title = 'Daftar Permohonan Posisi Di Bendahara: Verifikasi Pembayaran';
        } else if ($posisi == 'kasi.approval.cetak.sk') {
            $title = 'Daftar Permohonan Posisi Di KASI: Persetujuan Draft SK';
        } else if ($posisi == 'kabid') {
            $title = 'Daftar Permohonan Posisi Di KABID: Persetujuan Draft SK';
        } else if ($posisi == 'kadin') {
            $title = 'Daftar Permohonan Posisi Di KADIN: Penandatanganan Draft SK';
        } else if ($posisi == 'pengambilan') {
            $title = 'Daftar Permohonan Posisi Di Pengambilan: Pengambilan SK';
        } else {
            $title = 'Daftar Permohonan';    
        }

        $rs = Permohonan::select("permohonan.*")
                ->join('m_jenis_permohonan_izin', function ($join) use ($posisi) {
                      $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', $posisi);
                })
                ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                ->orderBy('tgl_pendaftaran','desc')
                ->paginate(20);

        $no = $rs->firstItem();

        return view('list',compact('title','rs','no', 'posisi'));
    }

    function DoView(Permohonan $per)
    {
        //akses('view-detail-pendaftaran');

        $meta = (array)json_decode($per->metadata);
        unset($meta['_token']);

        $kat = $per->getIzin->jenisIzin->kategoriProfil;

        return view('view',compact('per','meta','kat'));
    }

    public function tutorial(){

        $title = "Tutorial";
        $tutorial = Tutorial::where("tampilkan","admin")->orderBy('judul_tutorial','asc')->paginate(15);
        $no = $tutorial->firstItem();

        return view('page.tutorial.view',compact('title','tutorial','no'));
    }

    function cariTutorial($keyword)
    {
        $title = "Tutorial";
        $tutorial = Tutorial::where(function ($query) use($keyword) {
                                    $query->where('judul_tutorial', 'like', '%'.$keyword.'%')
                                          ->orWhere('tipe_tutorial', 'like', '%'.$keyword.'%')
                                          ->orWhere('deskripsi_tutorial', 'like', '%'.$keyword.'%');
                                })
                                ->orderBy('judul_tutorial','asc')->paginate(15);
        $no = $tutorial->firstItem();
        return view('page.tutorial.view',compact('title','tutorial','no'));
    }


    public function detailTutorial(Tutorial $tutorial) {

        $title = "View Bantuan/Tutorial";
        return view('page.tutorial.detail',compact('title','tutorial'));
    }
}

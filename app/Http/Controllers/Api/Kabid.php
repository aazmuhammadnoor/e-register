<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Proses\TraitSurat;
use App\Models\Permohonan;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use App\Models\User;

class Kabid extends Controller{

  use TraitSurat;

  function Dashboard(User $user){
    $dinas_permohonan = null;
    $dinas_user =$user;
    $kategori_profil = KategoriProfil::all();
    $role = role_user($dinas_user->bidang_izin,$dinas_permohonan);
    check_role_per_dinas($role->status);

    $status_profil = \DB::table('permohonan')
                        ->leftJoin('m_jenis_permohonan_izin', function ($join) {
                            $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', 'kabid');
                        })
                        ->leftJoin('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                        ->leftJoin('m_kategori_dinas', 'm_jenis_izin.kategori_dinas_id', '=', 'm_kategori_dinas.id')
                        ->leftJoin('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                        ->select(\DB::raw('COUNT(permohonan.id) as total, m_kategori_profil.nama as nama, m_kategori_profil.id as id'))
                        ->where('m_kategori_dinas.bidang_izin_id',$dinas_user->bidang_izin)
                        ->groupBy('m_kategori_profil.nama')
                        ->orderBy('m_kategori_profil.id')
                        ->get();

    $count_status = 0;
    foreach($status_profil as $key=>$profils) {
        $count_status += $profils->total;
    }

    return response()->json([
      'count_status'=>$count_status,
      'status_profil'=>$status_profil
    ]);

  }

  function Listdata(User $user, KategoriProfil $kat){
    $dinas_permohonan = null;
    $dinas_user =$user;
    $kategori_profil = KategoriProfil::all();
    $role = role_user($dinas_user->bidang_izin,$dinas_permohonan);
    check_role_per_dinas($role->status);

    $title = "Daftar Permohonan Bidang ".$kat->nama."";

    $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin','getWorkflowStatus.getSubtask'=>function($q){
                $q->latest()->first();
            }])
            ->join('m_jenis_permohonan_izin', function ($join) {
                  $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', 'kabid');
            })
            ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
            ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
            ->join('m_kategori_dinas', 'm_jenis_izin.kategori_dinas_id', '=', 'm_kategori_dinas.id')
            ->where('m_kategori_profil.id', $kat->id)
            ->where('m_kategori_dinas.bidang_izin_id',$dinas_user->bidang_izin)
            ->orderBy('tgl_pendaftaran','desc')
            ->paginate(100);

    return response()->json([
      'status'=>true,
      'title'=>$title,
      'permohonan'=>$rs
    ]);
  }

  function ViewIjin($id){
    $per = Permohonan::where('id',$id)->with([
      'getPemohon',
      'getKetenagakerjaan',
      'getLingkungan',
      'getPembangunan',
      'getPerusahaan',
      'getProfesi.profesi',
      'getReklame',
      'getReklame',
      'getWorkflowStatus',
      'getPendaftar',
      'getSertifikat',
      'getFinal',
      'getVerifikasi.getSyarat',
      'getProfesi'
      ])->first();
    if($per){
      $meta = (array)json_decode($per->metadata);
      unset($meta['_token']);

      $kat = $per->getIzin->jenisIzin->kategoriProfil;

      return response()->json([
        'status'=>true,
        'meta'=>$meta,
        'kat'=>$kat,
        'permohonan'=>$per
      ]);
    }else{
      return response()->json([
         'status'=>false,
         'msg'=>'Data Not Found'
      ]);
    }
  }

  function ApprovalBerkasDoSubmit(Request $r, User $user, Permohonan $per){
    $dinas_permohonan = null;
    $dinas_user =$user;
    $kategori_profil = KategoriProfil::all();
    $role = role_user($dinas_user->bidang_izin,$dinas_permohonan);
    check_role_per_dinas($role->status);

    $this->validate($r, [
        'catatan_kabid_approval_draft'=>'required'
    ]);

    $per->catatan_kabid_approval_draft = $r->catatan_kabid_approval_draft;
    $per->save();
    \App\Workflow\PerizinanWorkflow::ToKadinFromKabid($per, true, $user);

    return response()->json([
       'status'=>true,
       'msg'=>'Permohonan berhasil disubmit ke Kadin'
    ]);
  }

  function arsip(User $user)
  {
    $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin'])
            ->join('m_jenis_permohonan_izin', function ($join) use($user){
                  $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')
                  ->where('permohonan.posisi', '=', 'diarsipkan')
                  ->where('kabid_oleh', $user->id);
            })
            ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
            ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
            ->orderBy('tgl_pendaftaran','desc')
            ->get();

    return response()->json([
      'status'=>true,
      'title'=>'Arsip Permohonan',
      'permohonan'=>$rs
    ]);
  }

}

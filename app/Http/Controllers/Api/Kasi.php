<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Proses\TraitSurat;
use App\Models\Permohonan;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use App\Models\User;

class Kasi extends Controller{

  use TraitSurat;

  //kasi.approval.pemeriksaan.berkas
  //kasi.approval.cetak.sk

  function Dashboard(User $user, $status)
  {
      if($user){
        $dinas_permohonan = null;
        $dinas_user = $user;
        $kategori_profil = KategoriProfil::all();
        $role = role_user($dinas_user->seksi_izin,$dinas_permohonan);
        check_role_per_dinas($role->status);

        $status = ($status == 'approval') ? "kasi.approval.pemeriksaan.berkas" : "kasi.approval.cetak.sk";

        $status_profil = \DB::table('permohonan')
                            ->leftJoin('m_jenis_permohonan_izin', function ($join) use($status) {
                                $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', $status);
                            })
                            ->leftJoin('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                            ->leftJoin('m_kategori_dinas', 'm_jenis_izin.kategori_dinas_id', '=', 'm_kategori_dinas.id')
                            ->leftJoin('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                            ->select(\DB::raw('COUNT(permohonan.id) as total, m_kategori_profil.nama as nama, m_kategori_profil.id as id'))
                            ->groupBy('m_kategori_profil.nama')
                            ->orderBy('m_kategori_profil.id')
                            ->where('m_kategori_dinas.seksi_izin_id',$dinas_user->seksi_izin)
                            ->get();

        $count_status = 0;
        foreach($status_profil as $key=>$profils) {
            $count_status += $profils->total;
        }

        return response()->json([
          'count_status'=>$count_status,
          'status_profil'=>$status_profil
        ]);

      }else{
        return response()->json([
           'status'=>false,
           'msg'=>'Un-Authorized'
        ]);
      }
  }

  function Listdata(User $user, KategoriProfil $kat, $status)
  {
    if($user){
      $dinas_permohonan = null;
      $dinas_user = $user;
      $kategori_profil = KategoriProfil::all();
      $role = role_user($dinas_user->seksi_izin,$dinas_permohonan);
      check_role_per_dinas($role->status);

      $title = "Daftar Permohonan Bidang ".$kat->nama."";

      $status = ($status == 'approval') ? "kasi.approval.pemeriksaan.berkas" : "kasi.approval.cetak.sk";

      $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin','getWorkflowStatus.getSubtask'=>function($q){
                  $q->latest()->first();
              }])
              ->join('m_jenis_permohonan_izin', function ($join) use($status){
                    $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', $status);
              })
              ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
              ->join('m_kategori_dinas', 'm_jenis_izin.kategori_dinas_id', '=', 'm_kategori_dinas.id')
              ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
              ->where('m_kategori_profil.id', $kat->id)
              ->orderBy('tgl_pendaftaran','desc')
              ->where('m_kategori_dinas.seksi_izin_id',$dinas_user->seksi_izin)
              ->paginate(100);

      return response()->json([
        'status'=>true,
        'title'=>$title,
        'permohonan'=>$rs
      ]);
    }else{
      return response()->json([
         'status'=>false,
         'msg'=>'Un-Authorized'
      ]);
    }
  }

  public function ViewIjin($id, $mode)
  {
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
        'mode'=>$mode,
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

  function ApprovalBerkasDoSubmit(Request $r, User $user, Permohonan $per)
  {
      $dinas_permohonan = null;
      $dinas_user = $user;
      $kategori_profil = KategoriProfil::all();
      $role = role_user($dinas_user->seksi_izin,$dinas_permohonan);
      check_role_per_dinas($role->status);

      $this->validate($r, [
          'catatan_kasi_approval_berkas'=>'required'
      ]);

      $per->catatan_kasi_approval_berkas = $r->catatan_kasi_approval_berkas;
      $per->save();

      \App\Workflow\PerizinanWorkflow::ToKorlapFromKasi($per, true, $user);

      return response()->json([
         'status'=>true,
         'msg'=>'Permohonan berhasil disubmit ke Korlap'
      ]);
  }

  function DraftDoSubmit(Request $r, User $user, Permohonan $per)
  {
      $dinas_permohonan = null;
      $dinas_user = $user;
      $kategori_profil = KategoriProfil::all();
      $role = role_user($dinas_user->seksi_izin,$dinas_permohonan);
      check_role_per_dinas($role->status);

      $this->validate($r, [
          'catatan_kasi_approval_draft'=>'required'
      ]);

      $per->catatan_kasi_approval_draft = $r->catatan_kasi_approval_draft;
      $per->save();

      \App\Workflow\PerizinanWorkflow::ToKabidFromKasi($per, true, $user);
      $this->generatePDF($per->id);

      return response()->json([
         'status'=>true,
         'msg'=>'Permohonan berhasil disubmit ke KABID'
      ]);
  }

  public function generatePDF($id)
  {

    $per = Permohonan::find($id);
    $izin = $per->getIzin;
    $sk = $per->getFinal;
    $identitas = \App\Models\Identitas::where('id', 1)->first();
    $nama_ttd = $identitas->kepala_dinas;
    $nip = $identitas->nip_kepala_dinas;

    $file = storage_path('app/'.$izin->template_surat.'');
    $render = new \App\Workflow\TemplateProccessorCustom($file);
    $filename = [
        'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
        'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
    ];

    $render->setValue('nama', $per->getPemohon->nama);
    $render->setValue('tempat_lahir', $per->getPemohon->tempat_lahir);
    $render->setValue('tanggal_lahir', $per->getPemohon->tanggal_lahir);
    $render->setValue('alamat', $per->getPemohon->alamat);
    $render->setValue('alamat_permohonan', $per->alamat_permohonan);

    $render->setValue('tgl_permohonan', $per->tgl_pendaftaran);

    $kat = $per->getIzin->jenisIzin->kategoriProfil;
    if ($kat->id == 1) {
        $render->setValue('nomer_str', $per->getProfesi->nomor_str);
        $render->setValue('berlaku_sampai', $per->getProfesi->berlaku_sampai);
    }

    $meta = json_decode($per->metadata, true);
    foreach($meta as $key=>$value){
      if(isset($meta[$key]) && !is_null($value) && !is_array($value)){
          $render->setValue(strtoupper($key), strtoupper($value));
          $render->setValue(strtolower($key), ucwords($value));
      }elseif(is_array($value)){
          $render->setValue(strtoupper($key), strtoupper($value[0]));
          $render->setValue(strtolower($key), ucwords($value[0]));
      }

    }

    $f ="SK_".strtoupper($izin->nama)."_".$per->no_pendaftaran.".docx";
    $this->SaveSurat($per->id, 'SK', 'SK Perizinan', $f);
    $render->saveAs($filename['docx']);
    \App\Http\KonversiPdf::Konversi($per, $filename);
  }

  function arsip(User $user)
  {
    $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin'])
            ->join('m_jenis_permohonan_izin', function ($join) use($user){
                  $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')
                  ->where('permohonan.posisi', '=', 'diarsipkan')
                  ->where('kasi_acs_oleh', $user->id);
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

<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Proses\TraitSurat;
use App\Models\Permohonan;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use App\Models\User;

class Ijin extends Controller{

    use TraitSurat;

    protected function isValidUser($id){
        $user = User::find($id);
        return ($user) ? true : false;
    }

    /*
    * List Kategori Izin
    */
   public function KategoriIzin(Request $r)
   {
     if($this->isValidUser($r->user_id)){
       $status_profil = \DB::table('permohonan')
                           ->join('m_jenis_permohonan_izin', function ($join) {
                               $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', 'kadin');
                           })
                           ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
                           ->rightJoin('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
                           ->select(\DB::raw('COUNT(permohonan.id) as total, m_kategori_profil.nama as nama, m_kategori_profil.id as id'))
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
     }else{
       return response()->json([
          'status'=>false,
          'msg'=>'Un-Authorized'
       ]);
     }
   }

   function ListIjin(Request $r)
   {
     if($this->isValidUser($r->user_id)){
       $kat = KategoriProfil::find($r->kategori);
       $title = "Daftar Permohonan Bidang ".$kat->nama."";
       $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin','getWorkflowStatus.getSubtask'])
               ->join('m_jenis_permohonan_izin', function ($join) {
                     $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', 'kadin');
               })
               ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
               ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
               ->where('m_kategori_profil.id', $kat->id)
               ->orderBy('tgl_pendaftaran','desc')
               ->paginate(20);

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

   function arsip(Request $r)
   {
     if($this->isValidUser($r->user_id)){
       $rs = Permohonan::select("permohonan.*")->with(['getPemohon','getIzin','getWorkflowStatus.getSubtask'])
               ->join('m_jenis_permohonan_izin', function ($join) {
                     $join->on('permohonan.izin', '=', 'm_jenis_permohonan_izin.id')->where('permohonan.posisi', '=', 'diarsipkan');
               })
               ->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id')
               ->join('m_kategori_profil', 'm_jenis_izin.kategori_profil_id', 'm_kategori_profil.id')
               ->orderBy('tgl_pendaftaran','desc')
               ->paginate(20);

       return response()->json([
         'status'=>true,
         'title'=>'Arsip Permohonan',
         'permohonan'=>$rs
       ]);

     }else{
       return response()->json([
          'status'=>false,
          'msg'=>'Un-Authorized'
       ]);
     }
   }

   function detailPermohonan(Request $r)
   {
     if($this->isValidUser($r->user_id)){

       $per = Permohonan::where('id',$r->permohonan_id)->with([
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
         $title = 'Tanda Tangan Draft SK';

         $meta = (array)json_decode($per->metadata);
         unset($meta['_token']);

         $kat = $per->getIzin->jenisIzin->kategoriProfil;

         return response()->json([
           'status'=>true,
           'title'=>$title,
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
     }else{
       return response()->json([
          'status'=>false,
          'msg'=>'Un-Authorized'
       ]);
     }
   }

   function DoSubmit(Request $r, Permohonan $per)
   {
       $this->validate($r, [
           'catatan_kadin_approval_draft'=>'required',
           '_passphare'=>'required'
       ]);

       $kat = $per->getIzin->jenisIzin->kategoriProfil;
       $per->catatan_kadin_approval_draft = $r->catatan_kadin_approval_draft;

       // Tanda Tangan Digital
       $izin = $per->getIzin;
       $filename = [
         'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
         'signed'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_signed.pdf"
       ];

       $user = User::where('username', $r->user)->first();

       if(file_exists($filename['pdf'])){
         $per->save();
         $ttdDigital = \App\Http\KonversiPdf::TandaTanganDigital($per, $filename, $r->_passphare);
         if($ttdDigital){
           \App\Workflow\PerizinanWorkflow::ToPengambilanFromKadin($per, true, $user);
           $f ="SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara)."_signed.pdf";
           $this->SaveSurat($per->id, 'SK(Signature)', 'Digital Signature', $f);
           return response()->json([
             'status'=>true,
             'msg'=>'SK berhasil ditandatangani Secara digital dan Permohonan berhasil disubmit ke Bagian Pengambilan'
           ]);
         }else{
           return response()->json([
             'status'=>false,
             'msg'=>'Passphrase sertifikat digital tidak valid'
           ]);
         }
       }else{
         return response()->json([
           'status'=>false,
           'msg'=>'SK belum pernah di cetak dan dikonversi ke PDF sebelumnya'
         ]);
       }
   }

   function CetakDraft(Permohonan $per)
   {
       $izin = $per->getIzin;
       $sk = $per->getFinal;
       $identitas = \App\Models\Identitas::where('id', 1)->first();
       if($izin->penanda_tangan_akhir == 'bupati'){
           $nama_ttd = $identitas->bupati;
           $nip="";
       }else{
           $nama_ttd = $identitas->kepala_dinas;
           $nip=$identitas->nip_kepala_dinas;
       }


       $file = storage_path('app/'.$izin->template_surat.'');

       if(file_exists($file)){
           $render = new \App\Workflow\TemplateProccessorCustom($file);
           $filename = [
             'docx'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".docx",
             'pdf'=>dokumen_path($per)."/SK_".str_slug($izin->nama)."_".str_slug($per->no_pendaftaran_sementara).".pdf",
           ];

           $sertifikat = $per->getSertifikat()->get()->first();

           //dd($sertifikat);

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
           if(file_exists($filename['docx'])){
             // Konversi Ke PDF
             // Jika sudah pernah di konversi sebelumnya
             if(file_exists($filename['pdf'])){
               return response()->file($filename['pdf'],[
                 'Content-Type' => 'application/pdf',
                 'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
               ]);
             }else{
               // Jika belum pernah di konversi sebelumnya
               $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
               return response()->file($konversi,[
                 'Content-Type' => 'application/pdf',
                 'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
               ]);
             }
           }else{
             return response()->json([
               'status'=>true,
               'msg'=>'Requested file does not exist on our server'
             ]);
           }
       }else{
         return response()->json([
           'status'=>true,
           'msg'=>'Template SK Perizinan Tidak Ditemukan'
         ]);
       }

   }

   function Dashboard()
   {
     $status = \DB::table('status_perizinan')
     ->select(\DB::raw('status, keterangan, icon,color,(select count(*) from permohonan where posisi=status_perizinan.status) as total'))
     ->get();
     $total_daftar = \App\Models\Permohonan::where('posisi','!=','arsip')->get();
     $total_daftar_hari_ini = \App\Models\Permohonan::where('tgl_pendaftaran','=',date('Y-m-d'))->get();

     return response()->json([
       'status'=>$status,
       'total_daftar'=>$total_daftar->count(),
       'total_daftar_hari_ini'=>$total_daftar_hari_ini->count()
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
     $konversi = \App\Http\KonversiPdf::Konversi($per, $filename);
     return response()->file($konversi,[
       'Content-Type' => 'application/pdf',
       'Content-Disposition'=>'inline;filename="SK_'.strtoupper($izin->nama).' '.$per->no_pendaftaran_sementara.'.pdf"'
     ]);
   }


}

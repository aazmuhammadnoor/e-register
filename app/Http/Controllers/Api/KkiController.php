<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use App\Models\User;

class KkiController extends Controller{

  public $key = '7b5ef3cfda4dec8740f8e554aa4602dd2257251685355d5835dd49132ca599bf';

  public function DokterList(Request $request)
  {
    if($request->headers->has('X-MPP-KEY'))
    {
      if($request->header('X-MPP-KEY') == $this->key && $request->has('dokter')){
        $data = [];

        $dokter = $request->dokter;

        $izin = Permohonan::with(['getPemohon','getIzin','getProfesi','getFinal'])
            ->whereHas('getIzin', function($q) use($dokter){
              // Dokter Dan Dokter Spesialis
              switch($dokter){
                case 'umum':
                  $q->where('jenis_izin_id',29);
                break;
                case 'spesialis':
                  $q->where('jenis_izin_id',35);
                break;
                default:
                case 'umum:spesialis':
                  $q->whereIn('jenis_izin_id',[29,35]);
                break;
              }
            });
        $izin = $izin ->whereIn('posisi',['pengambilan','diarsipkan']);

        // BY NOMOR IDENTITAS / KTP
        if($request->has('NO_KTP')){
          $nik = $request->NO_KTP;
          $izin = $izin->whereHas('getPemohon', function($p) use($nik) {
            $p->where('nik', $nik);
          });
        }

        // BY NOMOR STR
        if($request->has('NO_STR')){
          $nomor_str = $request->NO_STR;
          $izin = $izin->whereHas('getProfesi', function($p) use($nomor_str) {
            $p->where('nomor_str', $nomor_str);
          });
        }

        $izin = $izin->get();
        if(!is_null($izin) && $izin->count() > 0){
          foreach($izin as $rs){
              $faskes = (array) json_decode($rs->metadata);
              $nm_faskes = (isset($faskes['nama_tempat_kerja'])) ? $faskes['nama_tempat_kerja'] : null;
              $alamat = $rs->alamat_permohonan." RT/RW {$rs->lokasi_rt}/{$rs->lolasi_rw}";
              $data[] = [
                'NO_KTP'=>$rs->getPemohon['nik'],
                'NAMA'=>$rs->getPemohon['nama'],
                'NO_SIP'=>$rs->getFinal['nomor_sk'],
                'TGL_PENETAPAN'=>date_indo($rs->getFinal['tgl_penetapan']),
                'BERLAKU_SAMPAI'=>date_indo($rs->getFinal['berlaku_hingga']),
                'NO_STR'=>$rs->getProfesi['nomor_str'],
                'NAMA_FASKES'=>strtoupper($nm_faskes),
                'JENIS_FASKES'=>null,
                'ALAMAT_PRAKTEK'=>strtoupper($alamat),
                'ALAMAT_PRAKTEK_PROVINSI'=>'SUMATRA SELATAN',
                'ALAMAT_PRAKTEK_KABUPATEN'=>'KOTA PALEMBANG',
                'ALAMAT_PRAKTEK_KECAMATAN'=>strtoupper($rs->lokasi_kec),
                'ALAMAT_PRAKTEK_KELURAHAN'=>strtoupper($rs->lokasi_kel),
                'PRAKTEK_KE'=>null,
                'WAKTU_PRAKTEK'=>null,
                'KOORDINAT'=>$rs->koordinat
              ];
          }
          return response()->json([
            'status'=>true,
            'jumlah'=>$izin->count(),
            'data'=>$data
          ]);
        }else{
          return response()->json([
            'status'=>false,
            'jumlah'=>$izin->count(),
            'data'=>[]
          ]);
        }
      }else{
        return response()->json([
            'status'=>false,
            'msg'=>'Invalid Requests'
        ]);
      }
    }else{
      return response()->json([
          'status'=>'Un-Authorized'
      ],401);
    }
  }
}

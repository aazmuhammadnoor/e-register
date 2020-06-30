<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Verifikasi_berkas;
use App\Http\Ktki;

class BerkasController extends Controller
{
	public $site = "http://103.213.118.115/apps/api_pencarian.php?";

    function getsk($data)
    {
        $data_peri = $this->api_cek('no_sk='.str_replace("-=-", "/", $data));
        // dd($data['success']);
        if($data_peri['success'] == '1'){
            return $data_peri;
            exit(0);
        }else{
            return $this->data_mpp_sk(str_replace("-=-", "/", $data));
            exit(0);
        }
    }

    function getnama($data)
    {
        $data_peri = $this->api_cek('nama_pemohon='.$data);

        // dd($data['success']);
        if($data_peri['success'] == '1'){
            $datar = $this->data_mpp_nama_marge($data, $data_peri['data']);
            
            return $datar;
            exit(0);
        }else{
            return $this->data_mpp_nama($data);
            exit(0);
        }
    }

    function getall($data, $data2)
    {
        $data_peri = $this->api_cek('kondisi=all&sk='.str_replace("-=-", "/", $data).'&nama_pemohon='.$data2);
        // dd($data['success']);
        if($data_peri['success'] == '1'){
            return $data_peri;
            exit(0);
        }else{
            return $this->data_mpp(str_replace("-=-", "/", $data), $data2);
            exit(0);
        }
    }

    // function getskrd($data)
    // {
    //     $data_peri = $this->api_cek('no_skrd='.str_replace("-", "/", $data));
    //     // dd($data['success']);
    //     if($data_peri['success'] == '1'){
    //         return $data_peri;
    //         exit(0);
    //     }else{
    //         return $data_peri;
    //         exit(0);
    //     }
    // }

    // function getskm($data)
    // {
    //     $data_peri = $this->api_cek('no_skm='.str_replace("-", "/", $data));
    //     // dd($data['success']);
    //     if($data_peri['success'] == '1'){
    //         return $data_peri;
    //         exit(0);
    //     }else{
    //         return $data_peri;
    //         exit(0);
    //     }
    // }


    function api_cek($q){
        $endpoint = $this->site.$q;
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
                        'POST', 
                        $endpoint, 
                        [
                            // "body" => $postdata,
                            "headers" => 
                            [
                                'Accept'        => 'application/json',
                                'Content-Type'  => 'application/json',
                            ],
                            "exceptions" => false,
                        ]
                    );

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        $data = json_decode($content,true);
        return $data;
    }


    function data_mpp($q, $q2){
        $data_mpp = Verifikasi_berkas::select('m_jenis_izin.nama as NAMA_IZIN', 'm_jenis_permohonan_izin.nama as NAMA_IZIN_PERMOHONAN', 'm_pendaftar.nama as NAMA_PEMOHON', 'permohonan.badan_usaha as NAMA_PENDAFTARAN_USAHA', 'izin_final.tgl_tandatangan as TGL_TTD', 'izin_final.tgl_penetapan as TGL_DAFTAR', 'permohonan.alamat_permohonan as LOKASI', 'permohonan.lokasi_kec as KECAMATAN', 'permohonan.lokasi_kel as KELURAHAN', 'izin_final.no_sk_lengkap as NO_SK' )
            ->join('permohonan', 'permohonan.id', '=', 'izin_final.permohonan')
            ->join('m_pendaftar', 'm_pendaftar.id', '=', 'permohonan.id_pendaftar')
            ->join('m_jenis_permohonan_izin', 'm_jenis_permohonan_izin.id', '=', 'permohonan.izin')
            ->join('m_jenis_izin', 'm_jenis_izin.id', '=', 'm_jenis_permohonan_izin.jenis_izin_id')
            ->where('m_pendaftar.nama', 'like', '%'.$q.'%')
            ->where('izin_final.no_sk_lengkap', '=', str_replace("-=-", "/", $q2))

            ->get();

        if(count($data_mpp) > 0){
            $data = array( 
                'success' => 1, 
                'pencarian' => 'all',
                'data' => $data_mpp[0] );
        }else{
            $data = array( 
                'success' => 0, 
                'pencarian' => 'all',
                'data' => $data_mpp );
        }

        return $data;
        // return "-";
    }


    function data_mpp_nama($q){
        $data_mpp = Verifikasi_berkas::select('m_jenis_izin.nama as NAMA_IZIN', 'm_jenis_permohonan_izin.nama as NAMA_IZIN_PERMOHONAN', 'm_pendaftar.nama as NAMA_PEMOHON', 'permohonan.badan_usaha as NAMA_PENDAFTARAN_USAHA', 'izin_final.tgl_tandatangan as TGL_TTD', 'izin_final.tgl_penetapan as TGL_DAFTAR', 'permohonan.alamat_permohonan as LOKASI', 'permohonan.lokasi_kec as KECAMATAN', 'permohonan.lokasi_kel as KELURAHAN', 'izin_final.no_sk_lengkap as NO_SK' )
            ->join('permohonan', 'permohonan.id', '=', 'izin_final.permohonan')
            ->join('m_pendaftar', 'm_pendaftar.id', '=', 'permohonan.id_pendaftar')
            ->join('m_jenis_permohonan_izin', 'm_jenis_permohonan_izin.id', '=', 'permohonan.izin')
            ->join('m_jenis_izin', 'm_jenis_izin.id', '=', 'm_jenis_permohonan_izin.jenis_izin_id')
            ->where('m_pendaftar.nama', 'like', '%'.$q.'%')
            ->where('izin_final.no_sk_lengkap', '!=', null)

            ->get();

        if(count($data_mpp) > 0){
            $data = array( 
                'success' => 1, 
                'pencarian' => 'nama',
                'data' => $data_mpp );
        }else{
            $data = array( 
                'success' => 0, 
                'pencarian' => 'nama',
                'data' => $data_mpp );
        }

        return $data;
        // return "-";
    }

    function data_mpp_nama_marge($q, $array){
        $data_mpp_hasil = Verifikasi_berkas::select('m_jenis_izin.nama as NAMA_IZIN', 'm_jenis_permohonan_izin.nama as NAMA_IZIN_PERMOHONAN', 'm_pendaftar.nama as NAMA_PEMOHON', 'permohonan.badan_usaha as NAMA_PENDAFTARAN_USAHA', 'izin_final.tgl_tandatangan as TGL_TTD', 'izin_final.tgl_penetapan as TGL_DAFTAR', 'permohonan.alamat_permohonan as LOKASI', 'permohonan.lokasi_kec as KECAMATAN', 'permohonan.lokasi_kel as KELURAHAN', 'izin_final.no_sk_lengkap as NO_SK' )
            ->join('permohonan', 'permohonan.id', '=', 'izin_final.permohonan')
            ->join('m_pendaftar', 'm_pendaftar.id', '=', 'permohonan.id_pendaftar')
            ->join('m_jenis_permohonan_izin', 'm_jenis_permohonan_izin.id', '=', 'permohonan.izin')
            ->join('m_jenis_izin', 'm_jenis_izin.id', '=', 'm_jenis_permohonan_izin.jenis_izin_id')
            ->where('m_pendaftar.nama', 'like', '%'.$q.'%')
            ->where('izin_final.no_sk_lengkap', '!=', null)

            ->get()
            ->toArray();

        $data_mpp = array_merge($array, $data_mpp_hasil);

        if(count($data_mpp) > 0){
            $data = array( 
                'success' => 1, 
                'pencarian' => 'nama',
                'data' => $data_mpp );
        }else{
            $data = array( 
                'success' => 0, 
                'pencarian' => 'nama',
                'data' => $data_mpp );
        }

        return $data;
        // return "-";
    }


    function data_mpp_sk($q){
        $data_mpp = Verifikasi_berkas::select('m_jenis_izin.nama as NAMA_IZIN', 'm_jenis_permohonan_izin.nama as NAMA_IZIN_PERMOHONAN', 'm_pendaftar.nama as NAMA_PEMOHON', 'permohonan.badan_usaha as NAMA_PENDAFTARAN_USAHA', 'izin_final.tgl_tandatangan as TGL_TTD', 'izin_final.tgl_penetapan as TGL_DAFTAR', 'permohonan.alamat_permohonan as LOKASI', 'permohonan.lokasi_kec as KECAMATAN', 'permohonan.lokasi_kel as KELURAHAN', 'izin_final.no_sk_lengkap as NO_SK' )
            ->join('permohonan', 'permohonan.id', '=', 'izin_final.permohonan')
            ->join('m_pendaftar', 'm_pendaftar.id', '=', 'permohonan.id_pendaftar')
            ->join('m_jenis_permohonan_izin', 'm_jenis_permohonan_izin.id', '=', 'permohonan.izin')
            ->join('m_jenis_izin', 'm_jenis_izin.id', '=', 'm_jenis_permohonan_izin.jenis_izin_id')
            ->where('izin_final.no_sk_lengkap', '=', $q)

            ->get();

        if(count($data_mpp) > 0){
            $data = array( 
                'success' => 1, 
                'pencarian' => 'sk',
                'data' => $data_mpp[0] );
        }else{
            $data = array( 
                'success' => 0, 
                'pencarian' => 'sk',
                'data' => $data_mpp );
        }

        return $data;
        // return "-";
    }
}

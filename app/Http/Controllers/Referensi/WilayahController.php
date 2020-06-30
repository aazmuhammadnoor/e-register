<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class WilayahController extends Controller
{
    function getAjaxProvinsi(Provinsi $prov){
        return response()->json($prov);
    }
    function getAjaxKabupaten(Kabupaten $kab){
        return response()->json($kab);
    }
    function getAjaxKecamatan(Kecamatan $kec){
        return response()->json($kec);
    }
    function getAjaxKelurahan(Kelurahan $kel){
        return response()->json($kel);
    }

    function getByProvinsi($prov){
        $kab = Kabupaten::where("provinsi",$prov)->get();
        return response()->json($kab);
    }
    function getByKabupaten($kab){
        $kec = Kecamatan::where("kabupaten",$kab)->get();
        return response()->json($kec);
    }
    function getByKecamatan($kec){
        $kel = Kelurahan::where("kecamatan",$kec)->get();
        return response()->json($kel);
    }
}

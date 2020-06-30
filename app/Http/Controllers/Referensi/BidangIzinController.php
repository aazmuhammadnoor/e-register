<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BidangIzin;

class BidangIzinController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function Home()
    {
    	akses('manage-categori-izin');
        $title = "Bidang Perizinan";
    	$kat = BidangIzin::orderBy('name','asc')->paginate(10);
    	$no = $kat->firstItem();
    	return view('admin.referensi.bidangizin.index',compact('title','kat','no'));
    }

    function Pencarian($keyword=null)
    {
    	akses('manage-categori-izin');
        $title = "Pencarian Bidang Perizinan";
    	$kat = BidangIzin::where('name','like',"%$keyword%")->orderBy('name','asc')->paginate(10);
    	$no = $kat->firstItem();
    	return view('admin.referensi.bidangizin.index',compact('title','kat','no'));
    }


    function AddBidangIzin()
    {
    	akses('manage-categori-izin');
        $title = "Bidang Perizinan Baru";
    	return view('admin.referensi.bidangizin.add',compact('title'));
    }

    function SaveBidangIzin(Request $r)
    {
    	akses('manage-categori-izin');
        $this->validate($r, [
    		'name'=>'required|unique:bidang_izin',
            'singkatan_dinas'=>'required', 
            'alamat_dinas'=>'required', 
            'telp'=>'required', 
            'nama_kepala'=>'required', 
            'nip_kepala'=>'required', 
            'pangkat_kepala'=>'required', 
            'golongan_kepala'=>'required', 
            'bidang'=>'required'
    	]);

    	$rs = new BidangIzin;
    	$rs->name = $r->name;
        $rs->singkatan_dinas = $r->singkatan_dinas;
        $rs->alamat_dinas = $r->alamat_dinas;
        $rs->telp = $r->telp;
        $rs->nama_kepala = $r->nama_kepala;
        $rs->nip_kepala = $r->nip_kepala;
        $rs->pangkat_kepala = $r->pangkat_kepala;
        $rs->golongan_kepala = $r->golongan_kepala;
        $rs->bidang = $r->bidang;
    	$rs->save();
    	flash('Bidang Perizinan berhasil disimpan')->success();
    	return redirect('referensi/bidang-izin');
    }

    function EditBidangIzin(BidangIzin $kat)
    {
    	akses('manage-categori-izin');
        $title = "Edit Bidang Perizinan";
    	return view('admin.referensi.bidangizin.edit',compact('title','kat'));
    }

    function UpdateBidangIzin(Request $r, BidangIzin $kat)
    {
    	akses('manage-categori-izin');
        $kat->name = $r->name;
    	$kat->save();
    	flash('Perubahan Bidang Perizinan berhasil disimpan')->success();
    	return redirect('referensi/bidang-izin');
    }

    function DeleteBidangIzin(BidangIzin $kat)
    {
    	akses('manage-categori-izin');
        $kat->delete();
    	flash('Bidang Perizinan berhasil dihapus')->warning();
    	return redirect('referensi/bidang-izin');
    }

}

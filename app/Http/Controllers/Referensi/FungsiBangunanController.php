<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fungsi_Bangunan as Fungsi;
use App\Models\Guna_Bangunan as Guna;

class FungsiBangunanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function FungsiBangunan()
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Referensi Fungsi Bangunan";
    	$fn = Fungsi::orderBy('id','desc')->paginate(10);
    	$no = $fn->firstItem();
    	return view('page.fungsi_bangunan.index',compact('title','fn','no'));
    }

    function CariFungsiBangunan($keyword=null)
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Pencarian Fungsi Bangunan Dengan Keyword $keyword";
    	$fn = Fungsi::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $fn->firstItem();
    	return view('page.fungsi_bangunan.index',compact('title','fn','no'));
    }

    function AddFungsiBangunan()
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Fungsi Bangunan Baru";
    	return view('page.fungsi_bangunan.add',compact('title'));
    }

    function SaveFungsiBangunan(Request $r)
    {
    	akses('manage-fungsi-bangunan');
    	$this->validate($r, [
    		'name'=>'required|unique:fungsi_bangunan'
    	]);

    	$rs =  new Fungsi;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Fungsi bangunan baru berhasil disimpan')->success();
    	return redirect('referensi/fungsi-bangunan');
    }

    function EditFungsiBangunan(Fungsi $fn)
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Edit Fungsi Bangunan";
    	return view('page.fungsi_bangunan.edit',compact('title','fn'));
    }

    function UpdateFungsiBangunan(Request $r, Fungsi $fn)
    {
    	akses('manage-fungsi-bangunan');
    	$fn->name = $r->name;
    	$fn->save();
    	flash('Perubahan Fungsi bangunan berhasil disimpan')->success();
    	return redirect('referensi/fungsi-bangunan');
    }

    function DeleteFungsiBangunan(Fungsi $fn)
    {
    	$fn->delete();
    	flash('Fungsi bangunan berhasil dihapus')->warning();
    	return redirect('referensi/fungsi-bangunan');
    }

    function Kegunaan(Fungsi $fn)
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Penggunaan Bangunan Fungsi ".$fn->name."";
    	$gn = Guna::where('fungsi_bangunan', $fn->id)->get();
    	return view('page.fungsi_bangunan.kegunaan.index',compact('title','gn','fn'));
    }

    function AddKegunaan(Fungsi $fn)
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Penggunaan Bagunan ".$fn->name." Baru";
    	return view('page.fungsi_bangunan.kegunaan.add',compact('title','fn'));
    }

    function SaveKegunaan(Request $r, Fungsi $fn)
    {
    	$this->validate($r, [
    		'name'=>'required',
    		'fungsi_bangunan'=>'required'
    	]);

    	$rs = new Guna;
    	$rs->name = $r->name;
    	$rs->fungsi_bangunan = $r->fungsi_bangunan;
    	$rs->save();
    	flash('Penggunaan Fungsi bangunan '.$fn->name.' berhasil disimpan')->success();
    	return redirect('referensi/fungsi-bangunan/kegunaan/'.$fn->id);
    }

    function EditKegunaan(Fungsi $fn, Guna $gn)
    {
    	akses('manage-fungsi-bangunan');
    	$title = "Edit Penggunaan Bagunan ".$fn->name." &rang; ".$gn->name."";
    	return view('page.fungsi_bangunan.kegunaan.edit',compact('title','fn','gn'));
    }

    function UpdateKegunaan(Request $r, Fungsi $fn, Guna $gn)
    {
    	$gn->name = $r->name;
    	$gn->fungsi_bangunan = $r->fungsi_bangunan;
    	$gn->save();
    	flash('Penggunaan Fungsi bangunan '.$fn->name.' berhasil disimpan')->success();
    	return redirect('referensi/fungsi-bangunan/kegunaan/'.$fn->id);
    }

    function DeleteKegunaan(Fungsi $fn, Guna $gn)
    {
    	$gn->delete();
    	flash('Penggunaan Fungsi bangunan berhasil dihapus')->warning();
    	return redirect('referensi/fungsi-bangunan/kegunaan/'.$fn->id);
    }
}

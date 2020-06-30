<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Konstruksi;
use App\Models\Bahan;


class BahanKonstruksiController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function Konstruksi()
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Referensi Bahan Konstruksi";
    	$fn = Konstruksi::orderBy('id','desc')->paginate(10);
    	$no = $fn->firstItem();
    	return view('page.bahan_konstruksi.index',compact('title','fn','no'));
    }

    function CariKonstruksi($keyword=null)
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Pencarian Bahan Konstruksi Dengan Keyword $keyword";
    	$fn = Konstruksi::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $fn->firstItem();
    	return view('page.bahan_konstruksi.index',compact('title','fn','no'));
    }

    function AddKonstruksi()
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Bahan Konstruksi Baru";
    	return view('page.bahan_konstruksi.add',compact('title'));
    }

    function SaveKonstruksi(Request $r)
    {
    	akses('manage-bahan-konstruksi');
    	$this->validate($r, [
    		'name'=>'required|unique:konstruksi'
    	]);

    	$rs =  new Konstruksi;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Bahan Konstruksi baru berhasil disimpan')->success();
    	return redirect('referensi/bahan-konstruksi');
    }

    function EditKonstruksi(Konstruksi $fn)
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Edit Bahan Konstruksi";
    	return view('page.bahan_konstruksi.edit',compact('title','fn'));
    }

    function UpdateKonstruksi(Request $r, Konstruksi $fn)
    {
    	akses('manage-bahan-konstruksi');
    	$fn->name = $r->name;
    	$fn->save();
    	flash('Perubahan Bahan Konstruksi berhasil disimpan')->success();
    	return redirect('referensi/bahan-konstruksi');
    }

    function DeleteKonstruksi(Konstruksi $fn)
    {
    	$fn->delete();
    	flash('Bahan Konstruksi berhasil dihapus')->warning();
    	return redirect('referensi/bahan-konstruksi');
    }

    function BahanKonstruksi(Konstruksi $fn)
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Bahan Konstruksi ".$fn->name." Bangunan";
    	$gn = Bahan::where('konstruksi', $fn->id)->get();
    	return view('page.bahan_konstruksi.bahan.index',compact('title','gn','fn'));
    }

    function AddBahan(Konstruksi $fn)
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Bahan Konstruksi ".$fn->name." Baru";
    	return view('page.bahan_konstruksi.bahan.add',compact('title','fn'));
    }

    function SaveBahan(Request $r, Konstruksi $fn)
    {
    	$this->validate($r, [
    		'name'=>'required',
    		'konstruksi'=>'required'
    	]);

    	$rs = new Bahan;
    	$rs->name = $r->name;
    	$rs->konstruksi = $r->konstruksi;
    	$rs->save();
    	flash('Bahan Konstruksi '.$fn->name.' berhasil disimpan')->success();
    	return redirect('referensi/bahan-konstruksi/bahan/'.$fn->id);
    }

    function EditBahan(Konstruksi $fn, Bahan $gn)
    {
    	akses('manage-bahan-konstruksi');
    	$title = "Edit Bahan Konstruksi ".$fn->name." &rang; ".$gn->name."";
    	return view('page.bahan_konstruksi.bahan.edit',compact('title','fn','gn'));
    }

    function UpdateBahan(Request $r, Konstruksi $fn, Bahan $gn)
    {
    	$gn->name = $r->name;
    	$gn->konstruksi = $r->konstruksi;
    	$gn->save();
    	flash('Bahan Konstruksi '.$fn->name.' berhasil disimpan')->success();
    	return redirect('referensi/bahan-konstruksi/bahan/'.$fn->id);
    }

    function DeleteBahan(Konstruksi $fn, Bahan $gn)
    {
    	$gn->delete();
    	flash('Bahan Konstruksi berhasil dihapus')->warning();
    	return redirect('referensi/bahan-konstruksi/bahan/'.$fn->id);
    }
}

<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persyaratan;

class PersyaratanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function HomePersyaratan()
    {
    	akses('manage-persyaratan');
    	$title = "Referensi Data Persyaratan Perizinan";
    	$syarat = Persyaratan::orderBy('id','desc')->paginate(10);
    	$no = $syarat->firstItem();
    	return view('page.syarat.index',compact('title','syarat','no'));
    }

    function Pencarian($keyword=null)
    {
    	akses('manage-persyaratan');
    	$title = "Pencarian Referensi Data Persyaratan Perizinan";
    	$syarat = Persyaratan::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
	$no = $syarat->firstItem();
    	return view('page.syarat.index',compact('title','syarat','no'));
    }

    function AddSyarat()
    {
    	akses('manage-persyaratan');
    	$title = "Persyaratan Baru";
    	return view('page.syarat.add',compact('title'));
    }

    function SaveSyarat(Request $r)
    {
    	$this->validate($r, [
    		'name'=>'required|unique:persyaratan',
            'jenis'=>'required',
    		'aktif'=>'required'
    	]);

    	$rs = new Persyaratan;
    	$rs->name = $r->name;
        $rs->jenis = $r->jenis;
    	$rs->aktif = $r->aktif;
    	$rs->save();
    	flash('Persyaratan baru berhasil disimpan')->success();
    	return redirect('referensi/persyaratan');
    }

    function EditSyarat(Persyaratan $syarat)
    {
    	akses('manage-persyaratan');
    	$title = "Edit Persyaratan";
    	return view('page.syarat.edit',compact('title','syarat'));
    }

    function UpdateSyarat(Request $r, Persyaratan $syarat)
    {
    	$syarat->name = $r->name;
        $syarat->jenis = $r->jenis;
    	$syarat->aktif = $r->aktif;
    	$syarat->save();
    	flash('Perubahan Persyaratan berhasil disimpan')->success();
    	return redirect('referensi/persyaratan');
    }

    function DeleteSyarat(Persyaratan $syarat)
    {
    	$syarat->delete();
    	flash('Persyaratan berhasil dihapus')->warning();
    	return redirect('referensi/persyaratan');
    }

}

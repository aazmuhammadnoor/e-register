<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function Home(){
    	akses('pengumuman');
    	$title = "Pengumuman";
    	$rs = Pengumuman::orderBy('id','desc')->get();
    	return view('page.pengumuman.index',compact('title','rs'));
    }

    function AddNew(){
    	akses('pengumuman');
    	$title = "Pengumuman Baru";
    	return view('page.pengumuman.add',compact('title'));
    }

    function SaveNew(Request $r){
    	akses('pengumuman');
    	$this->validate($r, [
    		'judul'=>'required|max:190',
    		'isi'=>'required',
    		'publish'=>'required'
    	]);

    	$rs = new Pengumuman;
    	$rs->judul = $r->judul;
    	$rs->isi = $r->isi;
    	$rs->publish = $r->publish;

    	$rs->save();
    	flash('Pengumuman berhasil disimpan')->success();
    	return redirect('admin/pengumuman');
    }

    function Edit(Pengumuman $id){
    	akses('pengumuman');
    	$title = "Edit Pengumuman";
    	return view('page.pengumuman.edit',compact('title','id'));
    }

    function SaveEdit(Request $r, Pengumuman $id){
    	akses('pengumuman');
    	$this->validate($r, [
    		'judul'=>'required|max:190',
    		'isi'=>'required',
    		'publish'=>'required'
    	]);

    	$id->judul = $r->judul;
    	$id->isi = $r->isi;
    	$id->publish = $r->publish;

    	$id->save();
       	flash('Perubahan Pengumuman berhasil disimpan')->success();
    	return redirect('admin/pengumuman');
    }

    function Delete(Pengumuman $id){
    	$id->delete();
    	flash('Pengumuman berhasil dihapus')->success();
    	return redirect('admin/pengumuman');
    }
}

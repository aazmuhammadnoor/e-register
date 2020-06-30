<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KondisiTanah;

class KondisiTanahController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    public function Home(){
    	akses('manage-kondisi-tanah');
    	$title = "Daftar Kondisi Tanah";

    	$data = KondisiTanah::orderBy('id','desc')->paginate(10);

    	$no = $data->firstItem();

    	return view('page.kondisitanah.index',compact('title','data','no'));
    }

    public function Add(){
        akses('manage-kondisi-tanah');
    	$title = "Kondisi Tanah Baru";
    	return view('page.kondisitanah.add',compact('title'));
    }

    public function Save(Request $r){
        akses('manage-kondisi-tanah');

    	$this->validate($r, [
    		'name'=>'required|unique:tb_kondisi_tanah'
    	]);

    	$rs = new KondisiTanah;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Daftar kondisi tanah berhasil ditambahkan')->success();
    	return redirect('referensi/kondisi-tanah');
    }

    public function Search($keyword=null){
        akses('manage-kondisi-tanah');
    	$title = "Pencarian Daftar Kondisi Tanah Dengan Keyword $keyword";
    	$data = KondisiTanah::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $data->firstItem();
    	return view('page.kondisitanah.index',compact('title','data','no'));
    }

    public function Edit(KondisiTanah $data){
        akses('manage-kondisi-tanah');
    	$title = "Edit Kondisi Tanah";
    	return view('page.kondisitanah.edit',compact('title','data'));
    }

    public function Update(Request $r, KondisiTanah $data){  
        akses('manage-kondisi-tanah');
    	$data->name = $r->name;
    	$data->update();
    	flash('Perubahan Kondisi Tanah berhasil disimpan')->success();
    	return redirect('referensi/kondisi-tanah');
    }

    public function Delete(KondisiTanah $data){
        akses('manage-kondisi-tanah');
    	$data->delete();
    	flash('Kondisi Tanah berhasil dihapus')->warning();
    	return redirect('referensi/kondisi-tanah');
    }

}

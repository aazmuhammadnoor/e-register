<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisReklame;

class JenisReklameController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    public function Home(){
    	akses('manage-jenis-reklame');
    	$title = "Daftar Jenis Reklame";

    	$data = JenisReklame::orderBy('id','desc')->paginate(10);

    	$no = $data->firstItem();

    	return view('page.jenisreklame.index',compact('title','data','no'));
    }

    public function Add(){
        akses('manage-jenis-reklame'); 
    	$title = "Jenis Reklame Baru";
    	return view('page.jenisreklame.add',compact('title'));
    }

    public function Save(Request $r){
        akses('manage-jenis-reklame');

    	$this->validate($r, [
    		'name'=>'required|unique:tb_jenis_reklame'
    	]);

    	$rs = new JenisReklame;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Daftar jenis reklame berhasil ditambahkan')->success();
    	return redirect('referensi/jenis-reklame');
    }

    public function Search($keyword=null){
        akses('manage-jenis-reklame');
    	$title = "Pencarian Daftar Jenis Reklame Dengan Keyword $keyword";
    	$data = JenisReklame::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $data->firstItem();
    	return view('page.jenisreklame.index',compact('title','data','no'));
    }

    public function Edit(JenisReklame $data){
        akses('manage-jenis-reklame');
    	$title = "Edit Jenis Reklame";
    	return view('page.jenisreklame.edit',compact('title','data'));
    }

    public function Update(Request $r, JenisReklame $data){  
        akses('manage-jenis-reklame');
    	$data->name = $r->name;
    	$data->update();
    	flash('Perubahan Jenis Reklame berhasil disimpan')->success();
    	return redirect('referensi/jenis-reklame');
    }

    public function Delete(JenisReklame $data){
        akses('manage-jenis-reklame');
    	$data->delete();
    	flash('Jenis Reklame berhasil dihapus')->warning();
    	return redirect('referensi/jenis-reklame');
    }

}

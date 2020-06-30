<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusPenggunaan;

class StatusPenggunaanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    public function Home(){
    	akses('manage-status-penggunaan');
    	$title = "Daftar Status Penggunaan";

    	$data = StatusPenggunaan::orderBy('id','desc')->paginate(10);

    	$no = $data->firstItem();

    	return view('page.statuspenggunaan.index',compact('title','data','no'));
    }

    public function Add(){
        akses('manage-status-penggunaan');
    	$title = "Status Penggunaan Baru";
    	return view('page.statuspenggunaan.add',compact('title'));
    }

    public function Save(Request $r){
        akses('manage-status-penggunaan');

    	$this->validate($r, [
    		'status'=>'required|unique:tb_status_penggunaan'
    	]);

    	$rs = new StatusPenggunaan;
    	$rs->name = $r->name;
    	$rs->save();
    	flash('Daftar status penggunaan berhasil ditambahkan')->success();
    	return redirect('referensi/status-penggunaan');
    }

    public function Search($keyword=null){
        akses('manage-status-penggunaan');
    	$title = "Pencarian Daftar Status Penggunaan Dengan Keyword $keyword";
    	$data = StatusPenggunaan::where('name','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $data->firstItem();
    	return view('page.statuspenggunaan.index',compact('title','data','no'));
    }

    public function Edit(StatusPenggunaan $data){
        akses('manage-status-penggunaan');
    	$title = "Edit Status Penggunaan";
    	return view('page.statuspenggunaan.edit',compact('title','data'));
    }

    public function Update(Request $r, StatusPenggunaan $data){  
        akses('manage-status-penggunaan');
    	$data->name = $r->name;
    	$data->update();
    	flash('Perubahan Status Penggunaan berhasil disimpan')->success();
    	return redirect('referensi/status-penggunaan');
    }

    public function Delete(StatusPenggunaan $data){
        akses('manage-status-penggunaan');
    	$data->delete();
    	flash('Status Penggunaan berhasil dihapus')->warning();
    	return redirect('referensi/status-penggunaan');
    }

}

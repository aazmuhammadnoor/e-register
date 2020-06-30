<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agama;

class AgamaController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    public $status = ['0'=>'Tidak Aktif','1'=>'Aktif'];

    function index()
    {
    	akses('manage-agama');
    	$title = "Daftar Agama";
    	$agama = Agama::paginate(10);
    	$no = $agama->firstItem();
    	return view('page.agama.index',compact('title','agama','no'));
    }	

    function Pencarian($keyword=null)
    {
    	akses('manage-agama');
    	$title = "Pencarian Agama Dengan Keyword $keyword";
    	$agama = Agama::where('name','like',"%$keyword%")->paginate(10);
    	$no = $agama->firstItem();
    	return view('page.agama.index',compact('title','agama','no'));
    }

    function Add()
    {
        akses('manage-agama');
        $title = "Tambah Agama Baru";
        return view('page.agama.add',compact('title'));
    }

    function Save(Request $r)
    {
        akses('manage-agama');
        $this->validate($r, [
            'name'=>'required|unique:agama',
        ]);
        
        $agama = new Agama;
        $agama->name = $r->name;

        $agama->save();
        flash('Agama Baru berhasil disimpan')->success();
        return redirect('referensi/agama');
    }

    function Edit(Agama $agama)
    {
        akses('manage-agama');
        $title = "Edit Agama";
        return view('page.agama.edit',compact('title','agama'));
    }

    function Update(Request $r, Agama $agama)
    {
        akses('manage-agama');
        $this->validate($r, [
            'name'=>'required',
        ]);

        $agama->name = $r->name;

        $agama->save();
        flash('Perubahan Data Agama berhasil disimpan')->success();
        return redirect('referensi/agama');
    }

    function Delete(Agama $agama)
    {
        akses('manage-agama');
        $agama->delete();
        flash('Data Agama berhasil dihapus')->warning();
        return redirect('referensi/agama');
    }
}

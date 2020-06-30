<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriSaranaKesehatan;

class KategoriSaranaKesehatanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function index()
    {
    	akses('manage-kategori-sarana-kesehatan');
    	$title = "Daftar Kategori Sarana Kesehatan";
    	$kategori = KategoriSaranaKesehatan::paginate(10);
    	$no = $kategori->firstItem();
    	return view('page.kategori-sarana-kesehatan.index',compact('title','kategori','no'));
    }	

    function Pencarian($keyword=null)
    {
    	akses('manage-kategori-sarana-kesehatan');
    	$title = "Pencarian Kategori Sarana Kesehatan Dengan Keyword $keyword";
    	$kategori = KategoriSaranaKesehatan::where('nama_kategori','like',"%$keyword%")->paginate(10);
    	$no = $kategori->firstItem();
    	return view('page.kategori-sarana-kesehatan.index',compact('title','kategori','no'));
    }

    function Add()
    {
        akses('manage-kategori-sarana-kesehatan');
        $title = "Tambah Kategori Sarana Kesehatan Baru";
        return view('page.kategori-sarana-kesehatan.add',compact('title'));
    }

    function Save(Request $r)
    {
        akses('manage-kategori-sarana-kesehatan');
        $this->validate($r, [
            'nama_kategori'=>'required|unique:kategori_sarana_kesehatan'
        ]);
        
        $rs = new KategoriSaranaKesehatan;
        $rs->nama_kategori = $r->nama_kategori;

        $rs->save();
        flash('Kategori Sarana Kesehatan Baru berhasil disimpan')->success();
        return redirect('referensi/kategori-sarana-kesehatan');
    }

    function Edit(KategoriSaranaKesehatan $kategori)
    {
        akses('manage-kategori-sarana-kesehatan');
        $title = "Edit Kategori Sarana Kesehatan";
        return view('page.kategori-sarana-kesehatan.edit',compact('title','kategori'));
    }

    function Update(Request $r, KategoriSaranaKesehatan $kategori)
    {
        akses('manage-kategori-sarana-kesehatan');
        $kategori->nama_kategori = $r->nama_kategori;

        $kategori->save();
        flash('Perubahan Data Kategori Sarana Kesehatan berhasil disimpan')->success();
        return redirect('referensi/kategori-sarana-kesehatan');
    }

    function Delete(KategoriSaranaKesehatan $kategori)
    {
        akses('manage-kategori-sarana-kesehatan');
        $kategori->delete();
        flash('Data Kategori Sarana Kesehatan berhasil dihapus')->warning();
        return redirect('referensi/kategori-sarana-kesehatan');
    }
}

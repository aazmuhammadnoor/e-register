<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TypeSaranaKesehatan;

class TypeSaranaKesehatanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function index()
    {
    	akses('manage-type-sarana-kesehatan');
    	$title = "Daftar Type Sarana Kesehatan";
    	$type = TypeSaranaKesehatan::paginate(10);
    	$no = $type->firstItem();
    	return view('page.type-sarana-kesehatan.index',compact('title','type','no'));
    }	

    function Pencarian($keyword=null)
    {
    	akses('manage-type-sarana-kesehatan');
    	$title = "Pencarian Type Sarana Kesehatan Dengan Keyword $keyword";
    	$type = TypeSaranaKesehatan::where('nama_type','like',"%$keyword%")->paginate(10);
    	$no = $type->firstItem();
    	return view('page.type-sarana-kesehatan.index',compact('title','type','no'));
    }

    function Add()
    {
        akses('manage-type-sarana-kesehatan');
        $title = "Tambah Type Sarana Kesehatan Baru";
        return view('page.type-sarana-kesehatan.add',compact('title'));
    }

    function Save(Request $r)
    {
        akses('manage-type-sarana-kesehatan');
        $this->validate($r, [
            'nama_type'=>'required|unique:type_sarana_kesehatan'
        ]);
        
        $rs = new TypeSaranaKesehatan;
        $rs->nama_type = $r->nama_type;

        $rs->save();
        flash('Type Sarana Kesehatan Baru berhasil disimpan')->success();
        return redirect('referensi/type-sarana-kesehatan');
    }

    function Edit(TypeSaranaKesehatan $type)
    {
        akses('manage-type-sarana-kesehatan');
        $title = "Edit Type Sarana Kesehatan";
        return view('page.type-sarana-kesehatan.edit',compact('title','type'));
    }

    function Update(Request $r, TypeSaranaKesehatan $type)
    {
        akses('manage-type-sarana-kesehatan');
        $type->nama_type = $r->nama_type;

        $type->save();
        flash('Perubahan Data Type Sarana Kesehatan berhasil disimpan')->success();
        return redirect('referensi/type-sarana-kesehatan');
    }

    function Delete(TypeSaranaKesehatan $type)
    {
        akses('manage-type-sarana-kesehatan');
        $type->delete();
        flash('Data Type Sarana Kesehatan berhasil dihapus')->warning();
        return redirect('referensi/type-sarana-kesehatan');
    }
}

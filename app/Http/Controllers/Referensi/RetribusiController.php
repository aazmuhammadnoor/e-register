<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MRetribusi;

class RetribusiController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    /* parent */
    public function Home(){
        akses('manage-retribusi');
    	$title = "Daftar Retribusi";

    	$data = MRetribusi::whereNull('parent')->orderBy('id','desc')->paginate(10);

    	$no = $data->firstItem();

    	return view('page.retribusi.index',compact('title','data','no'));
    }

    public function Edit(MRetribusi $kategori){
        akses('manage-retribusi');    
    	$title = "Ubah Retribusi ".$kategori->item;
    	$kat = $kategori;
    	return view('page.retribusi.edit',compact('title','kat'));
    }

    public function Update (Request $r ,MRetribusi $kategori){ 
        akses('manage-retribusi');
        $rs = MRetribusi::where('id',$kategori->id);
        $arr_update = [];

        if($r->has('index')){
        	$arr_update['index'] = $r->index;
        }

        if($r->has('harga_satuan')){
        	$arr_update['harga_satuan'] = $r->harga_satuan;
        }

        $rs->update($arr_update);

        flash('Perubahan Data Retribusi '.$kategori->item.' Berhasil disimpan')->success();
        return redirect('referensi/retribusi');
    }

    function Search($keyword = null)
    {
        akses('manage-retribusi');
    	$title = "Pencarian Retribusi Dengan Keyword $keyword";
    	$data = MRetribusi::whereNull('parent')->where('item','like',"%$keyword%")->orderBy('id','desc')->paginate(10);
    	$no = $data->firstItem();
    	return view('page.retribusi.index',compact('title','data','no'));
    }


    /* child */
    public function HomeItem(MRetribusi $kategori){
        akses('manage-retribusi');
    	$title = "Daftar Retribusi ".$kategori->item;
    	$data = MRetribusi::where('parent',$kategori->id)->paginate(10);

    	$no = $data->firstItem();

    	return view('page.retribusi.indexItem',compact('title','data','no','kategori'));

    }

    public function EditItem(MRetribusi $kategori){
        akses('manage-retribusi');
    	$title = "Ubah Retribusi ".$kategori->getParent->item.' '.$kategori->item;
    	$kat = $kategori;
    	return view('page.retribusi.editItem',compact('title','kat'));
    }

    public function UpdateItem(Request $r, MRetribusi $kategori){ 
        akses('manage-retribusi'); 
        $rs = MRetribusi::where('id',$kategori->id);
        $arr_update = [];

        if($r->has('index')){
        	$arr_update['index'] = $r->index;
        }

        if($r->has('harga_satuan')){
        	$arr_update['harga_satuan'] = $r->harga_satuan;
        }

        $rs->update($arr_update);

        flash('Perubahan Data Retribusi '.$kategori->item.' Berhasil disimpan')->success();
        return redirect('referensi/retribusi-item/'.$kategori->getParent->id);
    }

    function SearchItem(MRetribusi $kategori,$keyword = null)
    {
        akses('manage-retribusi');
    	$title = "Pencarian Pada Retribusi ".$kategori->item." Dengan Keyword $keyword";
    	$data = MRetribusi::where('parent',$kategori->id)->where('item','like',"%$keyword%")->paginate(10);
    	$no = $data->firstItem();
    	return view('page.retribusi.indexItem',compact('title','data','no','kategori'));
    }

}

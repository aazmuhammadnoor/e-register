<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan as Kec;
use App\Models\Kelurahan as Kel;
use App\Models\Padukuhan as Pdkh;


class KecamatanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }


    function HomeKecamatan()
    {
    	akses('manage-kecamatan');
    	$title = "Daftar Kecamatan";
    	$kec = Kec::paginate(10);
    	$no = $kec->firstItem();
    	return view('page.kecamatan.index',compact('title','kec','no'));
    }	

    function PencarianKecamatan($keyword=null)
    {
    	akses('manage-kecamatan');
    	$title = "Pencarian Kecamatan Dengan Keyword $keyword";
    	$kec = Kec::where('name','like',"%$keyword%")->paginate(10);
    	$no = $kec->firstItem();
    	return view('page.kecamatan.index',compact('title','kec','no'));
    }

    function AddKecamatan()
    {
    	akses('manage-kecamatan');
    	$title = "Tambah Kecamatan Baru";
    	return view('page.kecamatan.add',compact('title'));
    }

    function SaveKecamatan(Request $r)
    {
    	akses('manage-kecamatan');
    	$this->validate($r, [
    		'name'=>'required|unique:kecamatan'
    	]);
        
        $rs = new Kec;
    	$rs->name = $r->name;
    	if($r->has('latitude'))
    		$rs->latitude = $r->latitude;
    	if($r->has('longitude'))
    		$rs->longitude = $r->longitude;        
        if($r->has('polygon'))
            $rs->polygon = $r->polygon;

    	$rs->save();
    	flash('Kecamatan Baru berhasil disimpan')->success();
    	return redirect('referensi/kecamatan');
    }

    function EditKecamatan(Kec $kec)
    {
    	akses('manage-kecamatan');
    	$title = "Edit Kecamatan";
    	return view('page.kecamatan.edit',compact('title','kec'));
    }

    function UpdateKecamatan(Request $r, Kec $kec)
    {
    	akses('manage-kecamatan');
    	$kec->name = $r->name;
    	if($r->has('latitude'))
    		$kec->latitude = $r->latitude;
    	if($r->has('longitude'))
    		$kec->longitude = $r->longitude;  
        if($r->has('polygon'))       
            $kec->polygon = $r->polygon;

    	$kec->save();
    	flash('Perubahan Data Kecamatan berhasil disimpan')->success();
    	return redirect('referensi/kecamatan');
    }

    function DeleteKecamatan(Kec $kec)
    {
    	akses('manage-kecamatan');
    	$kec->delete();
    	flash('Data Kecamatan berhasil dihapus')->warning();
    	return redirect('referensi/kecamatan');
    }

    function HomeKelurahan(Kec $kec)
    {
    	akses('manage-kecamatan');
    	$title = "Kelurahan Kecamatan ".$kec->name."";
    	$kel = Kel::where('kecamatan', $kec->id)->paginate(10);
    	$no = $kel->firstItem();
    	return view('page.kecamatan.kelurahan.index',compact('title','kec','kel','no'));
    }

    function AddKelurahan(Kec $kec)
    {
    	$title = "Tambah Kelurahan Kecamatan ".$kec->name."";
    	return view('page.kecamatan.kelurahan.add',compact('title','kec'));
    }

    function SaveKelurahan(Request $r, Kec $kec)
    {
    	$this->validate($r, [
    		'name'=>'required|unique:kelurahan',
    		'kecamatan'=>'required'
    	]);

    	$rs = new Kel;
    	$rs->name = $r->name;
    	$rs->kecamatan = $r->kecamatan;
    	if($r->has('latitude'))
    		$rs->latitude = $r->latitude;
    	if($r->has('longitude'))
    		$rs->longitude = $r->longitude;  
        if($r->has('polygon'))
            $rs->polygon = $r->polygon;

    	$rs->save();
    	flash('Kelurahan Kecamatan '.$kec->name.' berhasil disimpan')->success();
    	return redirect('referensi/kelurahan/'.$kec->id);
    }

    function EditKelurahan(Kec $kec, Kel $kel)
    {
    	$title = "Edit Kelurahan ".$kel->name." Kecamatan ".$kec->name."";
    	return view('page.kecamatan.kelurahan.edit',compact('title','kec','kel'));
    }

    function UpdateKelurahan(Request $r, Kec $kec, Kel $kel)
    {
    	$kel->name = $r->name;
    	$kel->kecamatan = $r->kecamatan;
    	if($r->has('latitude'))
    		$kel->latitude = $r->latitude;
    	if($r->has('longitude'))
    		$kel->longitude = $r->longitude;    
        if($r->has('polygon'))        
            $kel->polygon = $r->polygon;
        
    	$kel->save();
    	flash('Perubahan Kelurahan Kecamatan '.$kec->name.' berhasil disimpan')->success();
    	return redirect('referensi/kelurahan/'.$kec->id);
    }

    function DeleteKelurahan(Kec $kec, Kel $kel)
    {
    	$kel->delete();
    	flash('Kelurahan berhasil dihapus')->warning();
    	return redirect('referensi/kelurahan/'.$kec->id);
    }

    function HomePadukuhan(Kec $kec, Kel $kel){
        akses('manage-kecamatan');
        $title = "Padukuhan Kelurahan ".$kel->name." Kecamatan ".$kec->name."";
        $pdkh = Pdkh::where(['kecamatan'=>$kec->id,'kelurahan'=>$kel->id])->paginate(10);
        $no = $pdkh->firstItem();
        return view('page.kecamatan.kelurahan.padukuhan.index',compact('title','kec','kel','pdkh','no'));
    }

    function AddPadukuhan(Kec $kec, Kel $kel)
    {
        $title = "Tambah Padukuhan Kelurahan ".$kel->name." Kecamatan ".$kec->name."";
        return view('page.kecamatan.kelurahan.padukuhan.add',compact('title','kec','kel'));
    }

    function SavePadukuhan(Request $r, Kec $kec,Kel $kel)
    {
        $this->validate($r, [
            'name'=>'required|unique:padukuhan',
            'kecamatan'=>'required',
            'kelurahan'=>'required'
        ]);

        $rs = new Pdkh;
        $rs->name = $r->name;
        $rs->kecamatan = $r->kecamatan;
        $rs->kelurahan = $r->kelurahan;
        if($r->has('latitude'))
            $rs->latitude = $r->latitude;
        if($r->has('longitude'))
            $rs->longitude = $r->longitude;
        if($r->has('polygon'))
            $rs->polygon = $r->polygon;

        $rs->save();
        flash('Padukuhan Kelurahan '.$kel->name.' Kecamatan '.$kec->name.' berhasil disimpan')->success();
        return redirect('referensi/padukuhan/'.$kec->id.'/'.$kel->id);
    }

    function EditPadukuhan(Kec $kec, Kel $kel,Pdkh $pdkh)
    {
        $title = "Edit Padukuhan Kelurahan ".$kel->name." Kecamatan ".$kec->name."";
        return view('page.kecamatan.kelurahan.padukuhan.edit',compact('title','kec','kel','pdkh'));
    }

    function UpdatePadukuhan(Request $r, Kec $kec,Kel $kel,Pdkh $pdkh)
    {
        $pdkh->name = $r->name;
        $pdkh->kecamatan = $r->kecamatan;
        $pdkh->kelurahan = $r->kelurahan;
        if($r->has('latitude'))
            $pdkh->latitude = $r->latitude;
        if($r->has('longitude'))
            $pdkh->longitude = $r->longitude;  
        if($r->has('polygon'))
            $pdkh->polygon = $r->polygon;

        $pdkh->update();

        flash('Padukuhan Kelurahan '.$kel->name.' Kecamatan '.$kec->name.' berhasil disimpan')->success();
        return redirect('referensi/padukuhan/'.$kec->id.'/'.$kel->id);
    }

    function DeletePadukuhan(Kec $kec, Kel $kel,Pdkh $pdkh)
    {
        $pdkh->delete();
        flash('Padukuhan berhasil dihapus')->warning();
        return redirect('referensi/padukuhan/'.$kec->id.'/'.$kel->id);
    }

    function SearchPadukuhan(Kec $kec, Kel $kel, $keyword=null)
    {
        akses('manage-kecamatan');
        $title = "Pencarian Padukuhan $keyword Kelurahan {$kel->name} Kecamatan {$kec->name}";
        $pdkh = Pdkh::where(['kecamatan'=>$kec->id,'kelurahan'=>$kel->id])->where('name','like',"%$keyword%")->paginate(10);
        $no = $pdkh->firstItem();
        return view('page.kecamatan.kelurahan.padukuhan.index',compact('title','kec','kel','pdkh','no'));
    }

}

<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class DaerahAdministrasiController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    /*PROVINSI*/
    function HomeProvinsi()
    {
    	akses('manage-daerah-administrasi');
    	$title = "Daftar Provinsi";
    	$prov = Provinsi::paginate(10);
    	$no = $prov->firstItem();
    	return view('page.daerah-administrasi.provinsi.index',compact('title','prov','no'));
    }

    function PencarianProvinsi($keyword=null)
    {
    	akses('manage-daerah-administrasi');
    	$title = "Pencarian Provinsi Dengan Keyword $keyword";
    	$prov = Provinsi::where('name','like',"%$keyword%")->paginate(10);
    	$no = $prov->firstItem();
    	return view('page.daerah-administrasi.provinsi.index',compact('title','prov','no'));
    }

    function AddProvinsi()
    {
    	akses('manage-daerah-administrasi');
    	$title = "Tambah Provinsi Baru";
    	return view('page.daerah-administrasi.provinsi.add',compact('title'));
    }

    function SaveProvinsi(Request $r)
    {
    	akses('manage-daerah-administrasi');
    	$this->validate($r, [
    		'name'=>'required|unique:provinsi',
    		'kode_prov'=>'required|unique:provinsi'
    	]);
        
        $prov = new Provinsi;
    	$prov->name = $r->name;
    	$prov->kode_prov = $r->kode_prov;

    	$prov->save();
    	flash('Provinsi Baru berhasil disimpan')->success();
    	return redirect('referensi/provinsi');
    }

    function EditProvinsi(Provinsi $prov)
    {
    	akses('manage-daerah-administrasi');
    	$title = "Edit Provinsi";
    	return view('page.daerah-administrasi.provinsi.edit',compact('title','prov'));
    }

    function UpdateProvinsi(Request $r, Provinsi $prov)
    {
    	akses('manage-daerah-administrasi');
    	$this->validate($r, [
    		'name'=>'required',
    		'kode_prov'=>'required'
    	]);
        
    	$prov->name = $r->name;
    	$prov->kode_prov = $r->kode_prov;

    	$prov->save();
    	flash('Perubahan Data Provinsi berhasil disimpan')->success();
    	return redirect('referensi/provinsi');
    }

    function DeleteProvinsi(Provinsi $prov)
    {
    	akses('manage-daerah-administrasi');
    	$prov->delete();
    	flash('Data Provinsi berhasil dihapus')->warning();
    	return redirect('referensi/provinsi');
    }

    /*KABUPATEN*/
    function HomeKabupaten(Provinsi $prov)
    {
    	akses('manage-daerah-administrasi');
    	$title = "Kabupaten/Kota dari Provinsi ".$prov->name."";
    	$kab = Kabupaten::where('provinsi', $prov->id)->paginate(10);
    	$no = $kab->firstItem();
    	return view('page.daerah-administrasi.kabupaten.index',compact('title','prov','kab','no'));
    }

    function PencarianKabupaten(Provinsi $prov, $keyword=null)
    {
        akses('manage-daerah-administrasi');
        $title = "Pencarian Kabupaten/Kota Dengan Keyword $keyword di Provinsi ".$prov->name;
        $kab = Kabupaten::where('name','like',"%$keyword%")->paginate(10);
        $no = $kab->firstItem();
        return view('page.daerah-administrasi.kabupaten.index',compact('title','prov','kab','no'));
    }

    function AddKabupaten(Provinsi $prov)
    {
    	$title = "Tambah Kabupaten/Kota dari Provinsi ".$prov->name."";
    	return view('page.daerah-administrasi.kabupaten.add',compact('title','prov'));
    }

    function SaveKabupaten(Request $r, Provinsi $prov)
    {
    	$this->validate($r, [
    		'provinsi'=>'required',
    		'name'=>'required|unique:kabupaten',
    		'kode_kab'=>'required'
    	]);

    	$kab = new Kabupaten;
    	$kab->provinsi = $r->provinsi;
    	$kab->name = $r->name;
    	$kab->kode_kab = $r->kode_kab;

    	$kab->save();
    	flash('Kabupaten/Kota dari Provinsi '.$prov->name.' berhasil disimpan')->success();
    	return redirect('referensi/kabupaten/'.$prov->id);
    }

    function EditKabupaten(Provinsi $prov, Kabupaten $kab)
    {
    	$title = "Edit Kabupaten/Kota ".$kab->name." dari Provinsi ".$prov->name."";
    	return view('page.daerah-administrasi.kabupaten.edit',compact('title','prov','kab'));
    }

    function UpdateKabupaten(Request $r, Provinsi $prov, Kabupaten $kab)
    {
        $kab->provinsi = $r->provinsi;
    	$kab->name = $r->name;
    	$kab->kode_kab = $r->kode_kab;
        
    	$kab->save();
    	flash('Perubahan Kabupaten/Kota dari Provinsi '.$prov->name.' berhasil disimpan')->success();
    	return redirect('referensi/kabupaten/'.$prov->id);
    }

    function DeleteKabupaten(Provinsi $prov, Kabupaten $kab)
    {
    	$kab->delete();
    	flash('Kabupaten/Kota berhasil dihapus')->warning();
    	return redirect('referensi/kabupaten/'.$prov->id);
    }

    /*KECAMATAN*/
    function HomeKecamatan(Provinsi $prov, Kabupaten $kab)
    {
        akses('manage-daerah-administrasi');
        $title = "Kecamatan dari Kabupaten/Kota ".$kab->name." Provinsi ".$prov->name."";
        $kec = Kecamatan::where('kabupaten',$kab->id)->paginate(10);
        $no = $kec->firstItem();
        return view('page.daerah-administrasi.kecamatan.index',compact('title','prov','kab','kec','no'));
    }

    function PencarianKecamatan(Provinsi $prov, Kabupaten $kab, $keyword=null)
    {
        akses('manage-daerah-administrasi');
        $title = "Pencarian Kecamatan $keyword di Kabupaten {$kab->name} Provinsi {$prov->name}";
        $kec = Kecamatan::where('kabupaten',$kab->id)->where('name','like',"%$keyword%")->paginate(10);
        $no = $kec->firstItem();
        return view('page.daerah-administrasi.kecamatan.index',compact('title','prov','kab','kec','no'));
    }

    function AddKecamatan(Provinsi $prov, Kabupaten $kab)
    {
        $title = "Tambah Kecamatan dari Kabupaten ".$kab->name." Provinsi ".$prov->name."";
        return view('page.daerah-administrasi.kecamatan.add',compact('title','prov','kab'));
    }

    function SaveKecamatan(Request $r, Provinsi $prov, Kabupaten $kab)
    {
        $this->validate($r, [
            'kabupaten'=>'required',
            'name'=>'required|unique:kecamatan',
            'kode_kec'=>'required'
        ]);

        $kec = new Kecamatan;
        $kec->kabupaten = $r->kabupaten;
        $kec->name = $r->name;
        $kec->kode_kec = $r->kode_kec;

        $kec->save();
        flash('Kecamatan dari Kabupaten '.$kab->name.' Provinsi '.$prov->name.' berhasil disimpan')->success();
        return redirect('referensi/kecamatan/'.$prov->id.'/'.$kab->id);
    }

    function EditKecamatan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec)
    {
        $title = "Edit Kecamatan dari Kabupaten ".$kab->name." Provinsi ".$prov->name."";
        return view('page.daerah-administrasi.kecamatan.edit',compact('title','prov','kab','kec'));
    }

    function UpdateKecamatan(Request $r, Provinsi $prov, Kabupaten $kab, Kecamatan $kec)
    {
        $kec->kabupaten = $r->kabupaten;
        $kec->name = $r->name;
        $kec->kode_kec = $r->kode_kec;

        $kec->update();
        flash('Kecamatan dari Kabupaten '.$kab->name.' Provinsi '.$prov->name.' berhasil disimpan')->success();
        return redirect('referensi/kecamatan/'.$prov->id.'/'.$kab->id);
    }

    function DeleteKecamatan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec)
    {
        $kec->delete();
        flash('Kecamatan berhasil dihapus')->warning();
        return redirect('referensi/kecamatan/'.$prov->id.'/'.$kab->id);
    }

    /*KELURAHAN*/
    function HomeKelurahan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec, Kelurahan $kel)
    {
        akses('manage-daerah-administrasi');
        $title = "Kelurahan/Desa dari Kecamatan ".$kec->name." Kabupaten/Kota ".$kab->name." Provinsi ".$prov->name."";
        $kel = Kelurahan::where('kecamatan',$kec->id)->paginate(10);
        $no = $kel->firstItem();
        return view('page.daerah-administrasi.kelurahan.index',compact('title','prov','kab','kec','kel','no'));
    }

    function PencarianKelurahan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec, Kelurahan $kel, $keyword=null)
    {
        akses('manage-daerah-administrasi');
        $title = "Pencarian Kelurahan/Desa $keyword di Kecamatan ".$kec->name." Kabupaten {$kab->name} Provinsi {$prov->name}";
        $kel = Kelurahan::where('kecamatan',$kec->id)->where('name','like',"%$keyword%")->paginate(10);
        $no = $kel->firstItem();
        return view('page.daerah-administrasi.kelurahan.index',compact('title','prov','kab','kec','kel','no'));
    }

    function AddKelurahan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec)
    {
        $title = "Tambah Kelurahan/Desa dari Kecamatan ".$kec->name." Kabupaten ".$kab->name." Provinsi ".$prov->name."";
        return view('page.daerah-administrasi.kelurahan.add',compact('title','prov','kab','kec'));
    }

    function SaveKelurahan(Request $r, Provinsi $prov, Kabupaten $kab, Kecamatan $kec)
    {
        $this->validate($r, [
            'kecamatan'=>'required',
            'name'=>'required|unique:kelurahan',
            'kode_kel'=>'required'
        ]);

        $kel = new Kelurahan;
        $kel->kecamatan = $r->kecamatan;
        $kel->name = $r->name;
        $kel->kode_kel = $r->kode_kel;

        $kel->save();
        flash('Kelurahan/Desa dari Kecamatan '.$kec->name.' Kabupaten '.$kab->name.' Provinsi '.$prov->name.' berhasil disimpan')->success();
        return redirect('referensi/kelurahan/'.$prov->id.'/'.$kab->id.'/'.$kec->id);
    }

    function EditKelurahan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec, Kelurahan $kel)
    {
        $title = "Edit Kelurahan/Desa dari Kecamatan ".$kec->name." Kabupaten ".$kab->name." Provinsi ".$prov->name."";
        return view('page.daerah-administrasi.kelurahan.edit',compact('title','prov','kab','kec','kel'));
    }

    function UpdateKelurahan(Request $r, Provinsi $prov, Kabupaten $kab, Kecamatan $kec, Kelurahan $kel)
    {
        $kel->kecamatan = $r->kecamatan;
        $kel->name = $r->name;
        $kel->kode_kel = $r->kode_kel;

        $kel->update();
        flash('Kelurahan/Desa dari Kecamatan '.$kec->name.' Kabupaten '.$kab->name.' Provinsi '.$prov->name.' berhasil disimpan')->success();
        return redirect('referensi/kelurahan/'.$prov->id.'/'.$kab->id.'/'.$kec->id);
    }

    function DeleteKelurahan(Provinsi $prov, Kabupaten $kab, Kecamatan $kec, Kelurahan $kel)
    {
        $kel->delete();
        flash('Kelurahan/Desa berhasil dihapus')->warning();
        return redirect('referensi/kelurahan/'.$prov->id.'/'.$kab->id.'/'.$kec->id);
    }
}

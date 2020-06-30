<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaranaKesehatan;
use App\Models\KategoriSaranaKesehatan;
use App\Models\TypeSaranaKesehatan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class SaranaKesehatanController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    public $status = ['0'=>'Tidak Aktif','1'=>'Aktif'];

    function index()
    {
    	akses('manage-sarana-kesehatan');
    	$title = "Daftar Sarana Kesehatan";
    	$sarkes = SaranaKesehatan::paginate(10);
    	$no = $sarkes->firstItem();
    	return view('page.sarana-kesehatan.index',compact('title','sarkes','no'));
    }	

    function Pencarian($keyword=null)
    {
    	akses('manage-sarana-kesehatan');
    	$title = "Pencarian Sarana Kesehatan Dengan Keyword $keyword";
    	$sarkes = SaranaKesehatan::where('nama_sarana_kesehatan','like',"%$keyword%")->paginate(10);
    	$no = $sarkes->firstItem();
    	return view('page.sarana-kesehatan.index',compact('title','sarkes','no'));
    }

    function Add()
    {
        akses('manage-sarana-kesehatan');
        $title = "Tambah Sarana Kesehatan Baru";
        $kategori  = KategoriSaranaKesehatan::all()->pluck('nama_kategori','id');
        $type  = TypeSaranaKesehatan::all()->pluck('nama_type','id');
        $status = $this->status;
        $kecamatan = Kecamatan::where('kabupaten',112)->get()->pluck('name','id');
        return view('page.sarana-kesehatan.add',compact('title','kategori','type','status','kecamatan'));
    }

    function getKelurahan($kec)
    {
        $kel = Kelurahan::where('kecamatan', $kec)->get();
        $op = '';
        if($kel->count() > 0)
        {   foreach($kel as $qry){
                $op.='<option value="'.$qry->id.'">'.$qry->name.'</option>';
            }
        }

        echo $op;
    }

    function Save(Request $r)
    {
        akses('manage-sarana-kesehatan');
        $this->validate($r, [
            'kategori_sarana_kesehatan'=>'required',
            'type_sarana_kesehatan'=>'required',
            'nama_sarana_kesehatan'=>'required|unique:sarana_kesehatan',
            'nama_pemilik'=>'required',
            'jalan_lorong'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);
        
        $sarkes = new SaranaKesehatan;
        $sarkes->kategori_sarana_kesehatan = $r->kategori_sarana_kesehatan;
        $sarkes->type_sarana_kesehatan = $r->type_sarana_kesehatan;
        $sarkes->nama_sarana_kesehatan = $r->nama_sarana_kesehatan;
        $sarkes->nama_pemilik = $r->nama_pemilik;
        $sarkes->provinsi = 6;
        $sarkes->kabupaten = 112;
        $sarkes->kecamatan = $r->kecamatan;
        $sarkes->kelurahan = $r->kelurahan;
        $sarkes->rw = $r->rw;
        $sarkes->rt = $r->rt;
        $sarkes->jalan_lorong = $r->jalan_lorong;
        $sarkes->latitude = $r->latitude;
        $sarkes->longitude = $r->longitude;
        $sarkes->status = $r->status;

        $sarkes->save();
        flash('Sarana Kesehatan Baru berhasil disimpan')->success();
        return redirect('referensi/sarana-kesehatan');
    }

    function Edit(SaranaKesehatan $sarkes)
    {
        akses('manage-sarana-kesehatan');
        $title = "Edit Sarana Kesehatan";
        $kategori  = KategoriSaranaKesehatan::all()->pluck('nama_kategori','id');
        $type  = TypeSaranaKesehatan::all()->pluck('nama_type','id');
        $status = $this->status;
        $kecamatan = Kecamatan::where('kabupaten',112)->get()->pluck('name','id');
        return view('page.sarana-kesehatan.edit',compact('title','sarkes','kategori','type','status','kecamatan'));
    }

    function getKelurahanEdit($kec)
    {
        $opt="";
        $kel = Kelurahan::where('kecamatan', $kec)->get();
        if($kel->count() > 0){
            foreach($kel as $qry){
                $opt.="<option value='".$qry->id."'>".$qry->name."</option>";
            }
        }else{
            $opt.="";
        }

        return $opt;
    }

    function Update(Request $r, SaranaKesehatan $sarkes)
    {
        akses('manage-sarana-kesehatan');
        $this->validate($r, [
            'kategori_sarana_kesehatan'=>'required',
            'type_sarana_kesehatan'=>'required',
            'nama_sarana_kesehatan'=>'required',
            'nama_pemilik'=>'required',
            'jalan_lorong'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);

        $sarkes->kategori_sarana_kesehatan = $r->kategori_sarana_kesehatan;
        $sarkes->type_sarana_kesehatan = $r->type_sarana_kesehatan;
        $sarkes->nama_sarana_kesehatan = $r->nama_sarana_kesehatan;
        $sarkes->nama_pemilik = $r->nama_pemilik;
        $sarkes->provinsi = 6;
        $sarkes->kabupaten = 112;
        $sarkes->kecamatan = $r->kecamatan;
        $sarkes->kelurahan = $r->kelurahan;
        $sarkes->rw = $r->rw;
        $sarkes->rt = $r->rt;
        $sarkes->jalan_lorong = $r->jalan_lorong;
        $sarkes->latitude = $r->latitude;
        $sarkes->longitude = $r->longitude;
        $sarkes->status = $r->status;

        $sarkes->save();
        flash('Perubahan Data Sarana Kesehatan berhasil disimpan')->success();
        return redirect('referensi/sarana-kesehatan');
    }

    function Delete(SaranaKesehatan $sarkes)
    {
        akses('manage-sarana-kesehatan');
        $sarkes->delete();
        flash('Data Sarana Kesehatan berhasil dihapus')->warning();
        return redirect('referensi/sarana-kesehatan');
    }
}

<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisIzin;
use App\Models\Persyaratan;
use App\Models\BidangIzin;
use App\Models\KategoriIzin;
use App\Models\KategoriData;
use Storage;

class JenisIzinController extends Controller
{
	
    public $retribusi = ['Izin Dengan Retribusi dan Survey', 'Izin Tanpa Retribusi Namun Tetap Survey', 'Izin Tanpa Retribusi Tanpa Survey'];

    public function __construct() {
        $this->middleware('auth');
    }

    function Home()
    {
    	akses('manage-jenis-perizinan');
    	$title = "Daftar Perizinan";
    	$izin = JenisIzin::whereNull('parent')->orderBy('urutan','asc')
            ->paginate(10);
    	$no = $izin->firstItem();

    	return view('admin.referensi.jenisizin.index',compact('title','izin','no'));
    }

    function Pencarian($keyword=null)
    {
    	akses('manage-jenis-perizinan');
    	$title = "Pencarian Daftar Perizinan Dengan Keyword $keyword";
    	$izin = JenisIzin::where('name','like','%'.$keyword.'%')
            ->whereNull('is_parent')
            ->paginate(10);
    	$no = $izin->firstItem();

    	return view('admin.referensi.jenisizin.index',compact('title','izin','no'));
    }

    function AddJenisIzin()
    {
    	akses('manage-jenis-perizinan');
    	$title = "Perizinan Baru";
    	$syarat = Persyaratan::all();
    	$bidang = BidangIzin::all();
        $kategori = KategoriIzin::all();
        $data = KategoriData::all();

        $parent = JenisIzin::where('is_parent','=',1)->get(['name','id']);

    	return view('admin.referensi.jenisizin.add',compact('title','syarat','bidang','kategori','data','parent'));
    }

    function SaveJenisIzin(Request $r)
    {
    	akses('manage-jenis-perizinan');
    	$this->validate($r, [
    		'name'=>'required|unique:jenis_izin',
    		'bidang'=>'required',    		
            'lama_proses'=>'required|numeric',
            'kode'=>'required',
            'kategori'=>'required',
            'data'=>'required',
            'is_parent'=>'required'
    	]);

        if ($r->is_parent == 0) {
            $this->validate($r, [
                'syarat'=>'required',
                'template_surat'=>'required|mimes:docx',
                'template_pendaftaran'=>'required|mimes:pdf'
            ]);            
        }

        if($r->hasFile('template_surat'))
        {
            $template = $r->file('template_surat');
            $filename = $template->storeAs('template_perizinan',"sk_".str_slug($r->name).".docx");
        }else{
            $filename = '';
        }


        if($r->hasFile('template_pendaftaran'))
        {
            $template_formulir = $r->file('template_pendaftaran');
            $filename_formulir = $template_formulir->storeAs('formulir',"formulir_".str_slug($r->name).".pdf");
        }else{
            $filename_formulir = '';
        }


    	$rs = new JenisIzin;
    	$rs->name = $r->name;
    	$rs->bidang = $r->bidang;
        $rs->kategori = $r->kategori;
        $rs->data = $r->data;
        $rs->is_parent = $r->is_parent;
        $rs->penanda_tangan_akhir = $r->penanda_tangan_akhir;
        if($r->has('metadata'))
            $rs->metadata = json_encode($r->metadata);
        $rs->template_surat = $filename;
        $rs->template_pendaftaran = $filename_formulir;
        $rs->lama_proses = $r->lama_proses;
        $rs->kode = $r->kode;
        $rs->singkatan = $r->singkatan;
        $rs->masa_berlaku = $r->masa_berlaku;
        $rs->dasar_hukum = $r->dasar_hukum;
        $rs->parent = $r->parent;
    	$rs->save();
    	$rs->syarat()->sync($r->syarat);
    	flash('Daftar Perizinan berhasil ditambahkan')->success();
    	return redirect('referensi/jenis-izin');
    }

    function EditJenisIzin(JenisIzin $izin)
    {
    	akses('manage-jenis-perizinan');
    	$title = "Edit Perizinan";
    	$syarat = Persyaratan::all();
        $bidang = BidangIzin::all();
        $kategori = KategoriIzin::all();
        $data = KategoriData::all();
    	$exts = $izin->syarat()->get()->pluck('id')->toArray();
        if(!is_null($izin->metadata)){
            $metadata = json_decode($izin->metadata);
        }else{
            $metadata = false;
        }

        $sy_cek = [];
        foreach($syarat as $no=>$sy){
            if(in_array($sy->id, $exts)){
                $sy_cek[] = $sy;
                unset($syarat[$no]);
            }
        }

        $parent = JenisIzin::where('is_parent','=',1)->get(['name','id']);
    	return view('admin.referensi.jenisizin.edit',compact('title','syarat','bidang','kategori','data','izin','exts','metadata','retribusi','parent','sy_cek'));
    }

    function UpdateJenisIzin(Request $r, JenisIzin $izin)
    {
    	akses('manage-jenis-perizinan');

    	$this->validate($r, [
    		'name'=>'required',
    		'bidang'=>'required',
            'kategori'=>'required',
            'data'=>'required',
            'is_parent'=>'required',
            'lama_proses'=>'required|numeric',
            'kode'=>'required',
            'masa_berlaku'=>'required|numeric',
            'dasar_hukum'=>'required'
    	]);

        if ($r->is_parent == 0) {
            $this->validate($r, [
                'metadata'=>'required',
                'syarat'=>'required',
                'template_surat'=>'required|mimes:docx',
                'template_pendaftaran'=>'required|mimes:pdf'
            ]);            
        }


        $ext_file = $izin->template_surat;

    	$izin->name = $r->name;
        $izin->bidang = $r->bidang;
        $izin->kategori = $r->kategori;
        $izin->data = $r->data;
        $izin->is_parent = $r->is_parent;
        $izin->penanda_tangan_akhir = $r->penanda_tangan_akhir;
        if($r->has('metadata'))
            $izin->metadata = json_encode($r->metadata);
        if($r->has('biaya_retribusi'))
            $izin->biaya_retribusi = $r->biaya_retribusi;

        if($r->hasFile('file')){
            Storage::delete($ext_file);
            $template = $r->file('file');
            $filename = $template->storeAs('template_perizinan',"sk_".str_slug($r->name).".docx");
            $izin->template_surat = $filename;
        }

        if($r->hasFile('template_pendaftaran'))
        {
            $template_formulir = $r->file('template_pendaftaran');
            $filename_formulir = $template_formulir->storeAs('formulir',"formulir_".str_slug($r->name).".pdf");
            $izin->template_pendaftaran = $filename_formulir;
        }

        $izin->lama_proses = $r->lama_proses;
        $izin->kode = $r->kode;
        $izin->singkatan = $r->singkatan;
        $izin->masa_berlaku = $r->masa_berlaku;
        $izin->dasar_hukum = $r->dasar_hukum;
        $izin->parent = $r->parent;
    	$izin->save();
    	$izin->syarat()->sync($r->syarat);
    	flash('Perubahan Daftar Perizinan berhasil disimpan')->success();
    	return redirect('referensi/jenis-izin');
    }

    function DeleteJenisIzin(JenisIzin $izin)
    {
    	akses('manage-jenis-perizinan');
        $izin->delete();
    	flash('Daftar Perizinan berhasil dihapus')->warning();
    	return redirect('referensi/jenis-izin');
    }

    function PreviewForm(JenisIzin $izin)
    {
        akses('manage-jenis-perizinan');
        $title = "Preview Form Permohonan";
        return view('admin.referensi.jenisizin.preview',compact('title','izin'));
    }

    function CopyJenisIzin(JenisIzin $izin)
    {
        akses('manage-jenis-perizinan');
        $title = "Copy Perizinan";
        $syarat = Persyaratan::all();
        $kategori = BidangIzin::all();
        $exts = $izin->syarat()->get()->pluck('id')->toArray();
        if(!is_null($izin->metadata)){
            $metadata = json_decode($izin->metadata);
        }else{
            $metadata = false;
        }

        $sy_cek = [];
        foreach($syarat as $no=>$sy){
            if(in_array($sy->id, $exts)){
                $sy_cek[] = $sy;
                unset($syarat[$no]);
            }
        }

        $retribusi = $this->retribusi;
        $parent = JenisIzin::whereNull('parent')->get(['name','id']);
        return view('admin.referensi.jenisizin.copy',compact('title','syarat','kategori','izin','exts','metadata','retribusi','parent','sy_cek'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identitas;

class IdentitasController extends Controller
{
	protected $id;

	public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
        $this->id = 1;
    }

    function DefaultIdentitas($act = null)
    {
    	$rs = Identitas::find($this->id)->first();
    	$title = "Identitas Instansi Dan Aplikasi";
        $act = $act;

    	return view('page.identitas.index',compact('title','rs','act'));
    }

    function UpdateIdentitas(Request $r)
    {
    	$this->validate($r, [
    		'instansi'=>'required',
    		'singkatan_instansi'=>'required',
            'alamat_instansi'=>'required',
            'telepon_instansi'=>'required',
    		'footer'=>'required',
    		'nama_aplikasi'=>'required',
    		'logo_public'=>'sometimes|mimes:png,jpeg,jpg',
    		'logo_backend'=>'sometimes|mimes:png,jpeg,jpg',
    		'bg_login'=>'sometimes|mimes:png,jpeg,jpg',
    		'logo_login'=>'sometimes|mimes:png,jpeg,jpg',
            'ttd_elektronik'=>'sometimes|mimes:png,jpeg,jpg',
            'kop_surat'=>'sometimes|mimes:png,jpeg,jpg',
            'bukti_pendaftaran'=>'sometimes|mimes:doc,docx',
            'surat_pernyataan'=>'sometimes|mimes:doc,docx',
            'surat_pencabutan'=>'sometimes|mimes:doc,docx',
            'embed_widget'=>'sometimes'
    	]);

    	$rs = Identitas::where('id',$this->id);
        $destinationPath = 'uploads';

        $arr_update = [
            'instansi'=>$r->instansi,
            'singkatan_instansi'=>$r->singkatan_instansi,
            'footer'=>$r->footer,
            'nama_aplikasi'=>$r->nama_aplikasi,
            'embed_widget'=>$r->embed_widget,
            'alamat_instansi' => $r->alamat_instansi,
            'telepon_instansi' => $r->telepon_instansi
        ];

        if($r->hasFile('logo_public')){
            $logo_public = $r->file('logo_public');
            $filename = \Storage::putFile('public/images',$logo_public);
            $arr_update['logo_public'] = $filename;
        }

        if($r->hasFile('logo_backend')){
            $logo_backend = $r->file('logo_backend');
            $filename = \Storage::putFile('public/images',$logo_backend);
            $arr_update['logo_backend'] = $filename;
        }

        if($r->hasFile('bg_login')){
            $bg_login = $r->file('bg_login');
            $filename = \Storage::putFile('public/images',$bg_login);
            $arr_update['bg_login'] = $filename;
        }

        if($r->hasFile('bg_frontend')){
            $bg_frontend = $r->file('bg_frontend');
            $filename = \Storage::putFile('public/images',$bg_frontend);
            $arr_update['bg_frontend'] = $filename;
        }
    	
    	if($r->hasFile('logo_login')){
            $logo_login = $r->file('logo_login');
            $filename = \Storage::putFile('public/images',$logo_login);
            $arr_update['logo_login'] = $filename;
        }
        
        if($r->hasFile('bukti_pendaftaran')){
            $template = $r->file('bukti_pendaftaran');
            $filename = $template->storeAs('template',"bukti_pendaftaran.docx");
            $arr_update['bukti_pendaftaran'] = $filename;
        }    	
    	
    	$rs->update($arr_update);

    	flash('Perubahan Identitas Instansi dan Aplikasi Berhasil disimpan')->success();
    	return redirect('admin/config/identitas/1');
    }


    function UpdateTtdperizinan(Request $r){
        $this->validate($r, [
            'kepala_dinas'=>'required',
            'nip_kepala_dinas'=>'required',
            'jabatan_kadin'=>'required',
            'pangkat_kadin'=>'required',
            'atas_nama'=>'required'
        ]);

        $rs = Identitas::where('id',$this->id);

        $arr_update = [
            'kepala_dinas'=>$r->kepala_dinas,
            'nip_kepala_dinas'=>$r->nip_kepala_dinas,
            'kabid_pelayanan'=>$r->kabid_pelayanan,
            'nip_kabid_pelayanan'=>$r->nip_kabid_pelayanan,
            'kabid_penanaman_modal'=>$r->kabid_penanaman_modal,
            'nip_kabid_penanaman_modal'=>$r->nip_kabid_penanaman_modal,
            'sekda'=>$r->sekda,
            'bupati'=>$r->bupati,
            'kasubag_umum'=>$r->kasubag_umum,
            'nip_kasubag_umum'=>$r->nip_kasubag_umum,
            'petugas_teknis_imb'=>$r->petugas_teknis_imb,
            'nip_petugas_teknis_imb'=>$r->nip_petugas_teknis_imb,
            'kasie_imb'=>$r->kasie_imb,
            'nip_kasie_imb'=>$r->nip_kasie_imb,
            'nip_kasek_tinjau_lapangan'=>$r->nip_kasek_tinjau_lapangan,
            'kasek_tinjau_lapangan'=>$r->kasek_tinjau_lapangan,
            'jabatan_kadin'=>$r->jabatan_kadin,
            'pangkat_kadin'=>$r->pangkat_kadin,
            'atas_nama'=>$r->atas_nama
        ];


        $rs->update($arr_update);

        flash('Perubahan Penanda Tangan Akhir Perizinan Berhasil disimpan')->success();
        return redirect('config/identitas/2');

    }

    function UpdateStdnjop(Request $r){
        $this->validate($r, [
            'satuan_biaya_retribusi'=>'required',
            'njop'=>'required',
        ]);

        $rs = Identitas::where('id',$this->id);

        $arr_update = [
            'satuan_biaya_retribusi'=>$r->satuan_biaya_retribusi,
            'njop'=>$r->njop,
        ];


        $rs->update($arr_update);

        flash('Perubahan Satuan Biaya Distribusi dan NJOP Berhasil disimpan')->success();
        return redirect('config/identitas/3');
    }


}

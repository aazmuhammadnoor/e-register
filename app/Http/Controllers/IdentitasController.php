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
            $logo_public->move($destinationPath,$logo_public->getClientOriginalName());
            $arr_update['logo_public'] = $logo_public->getClientOriginalName();
        }

        if($r->hasFile('logo_backend')){
            $logo_backend = $r->file('logo_backend');
            $logo_backend->move($destinationPath,$logo_backend->getClientOriginalName());
            $arr_update['logo_backend'] = $logo_backend->getClientOriginalName();
        }

        if($r->hasFile('bg_login')){
            $bg_login = $r->file('bg_login');
            $bg_login->move($destinationPath,$bg_login->getClientOriginalName());
            $arr_update['bg_login'] = $bg_login->getClientOriginalName();
        }
    	
    	if($r->hasFile('logo_login')){
            $logo_login = $r->file('logo_login');
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['logo_login'] = $logo_login->getClientOriginalName();
        }
        
        if($r->hasFile('ttd_elektronik')){
            $logo_login = $r->file('ttd_elektronik');
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['ttd_elektronik'] = $logo_login->getClientOriginalName();
        }
        
        if($r->hasFile('kop_surat')){
            $logo_login = $r->file('kop_surat');
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['kop_surat'] = $logo_login->getClientOriginalName();
        }
        
        if($r->hasFile('bukti_pendaftaran')){
            $logo_login = $r->file('bukti_pendaftaran');
            /*if(file_exists($destinationPath."/".$logo_login->getClientOriginalName())){
                unlink($destinationPath."/".$logo_login->getClientOriginalName());
            }*/
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['bukti_pendaftaran'] = $logo_login->getClientOriginalName();
        }

        if($r->hasFile('surat_pernyataan')){
            $logo_login = $r->file('surat_pernyataan');
            /*if(file_exists($destinationPath."/".$logo_login->getClientOriginalName())){
                unlink($destinationPath."/".$logo_login->getClientOriginalName());
            }*/
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['surat_pernyataan'] = $logo_login->getClientOriginalName();
        }

        if($r->hasFile('surat_pencabutan')){
            $logo_login = $r->file('surat_pencabutan');
            /*if(file_exists($destinationPath."/".$logo_login->getClientOriginalName())){
                unlink($destinationPath."/".$logo_login->getClientOriginalName());
            }*/
            $logo_login->move($destinationPath,$logo_login->getClientOriginalName());
            $arr_update['surat_pencabutan'] = $logo_login->getClientOriginalName();
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

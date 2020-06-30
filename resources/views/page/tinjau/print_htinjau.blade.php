<!DOCTYPE html>
<html>
<head>
	<title>LEMBAR HASIL TINJAU LOKASI</title>
	<style type="text/css">
	@page { margin: 5px 15px; size: A4}
	body { margin: 5px 15px; }
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{font-family:Arial, sans-serif;font-size:11px;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{font-family:Arial, sans-serif;font-size:11px;font-weight:normal;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
	.tg .tg-yw4l{vertical-align:top}
	.tg .tg-9hbo{font-weight:bold;vertical-align:top}
	#content{
		background: #fff;
	}
	</style>
  @if(isset($ispdf) && $ispdf == 'html')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  	<link rel="stylesheet" type="text/css" href="{{ asset('css/paper.min.css') }}">
  @endif
</head>
<body class="A4">
<section class="sheet padding-10mm">
<div id="content">
<table class="tg" style="width: 100%">
<colgroup>
<col style="width: 121px">
<col style="width: 223px">
<col style="width: 21px">
<col style="width: 135px">
<col style="width: 21px">
<col style="width: 230px">
</colgroup>
  <tr>
    <th class="tg-amwm" colspan="6">LEMBAR HASIL TINJAU LOKASI</th>
  </tr>
  <tr>
    <td class="tg-yw4l">No.Berkas</td>
    <td class="tg-yw4l" colspan="2">: {{ $per->no_pendaftaran }}</td>
    <td class="tg-yw4l">No.Berkas Bidang</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Tgl.Masuk</td>
    <td class="tg-yw4l" colspan="2">: {{ date_id($per->tgl_pendaftaran) }}</td>
    <td class="tg-yw4l">Tgl.Masuk Bidang</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6">Bahwa pada hari telah dilakukan tinjau lokasi dengan hasil sebagai berikut :</td>
  </tr>
  <tr>
    <td class="tg-yw4l" rowspan="2">Nama Pemohon</td>
    <td class="tg-yw4l" colspan="5">{{ $per->nama_pemohon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="5">Atas Nama :  {{ $per->nama_pemohon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" rowspan="2">Alamat Pemohon</td>
    <td class="tg-yw4l" colspan="5">{{ $per->alamat_pemohon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="5">Telepon : {{ $per->no_telepon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Lokasi</td>
    <td class="tg-yw4l" colspan="5">{{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6">DATA HASIL TINJAU Koordinat : {{ $per->koordinat }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="3" rowspan="14"></td>
    <td class="tg-yw4l">Batas Utara</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Batas Selatan</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Batas Timur</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Batas Barat</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Peruntukan</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Lapis Bang.</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Luas Tanah</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Status Tanah</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sumur PAH</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sumur PAL</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sampah</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sempadan Jalan</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sempadan Irigasi</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Sempadan Sungai</td>
    <td class="tg-yw4l" colspan="2">:</td>
  </tr>
  <tr>
    <td class="tg-9hbo" colspan="6">Kondisi Saat Tinjau</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6">
    	<input type="checkbox"> Belum Terbangun &nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="checkbox"> Sedang Dibangun  &nbsp;&nbsp;&nbsp;&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="checkbox"> Sudah Terbangun  &nbsp;&nbsp;&nbsp;&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
  </tr>
  <tr>
    <td class="tg-9hbo" colspan="6">Hasil Kajian Petugas</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6" style="min-height: 200px">
    	<p>Bahwa setelah dilaksanakan tinjau lokasi maka,:<br/>Kondisi dilapangan sebagai berikut : <br/>
    	<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">1.</span>
    	<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">2.</span>
    	<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">3.</span>
    	<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">4.</span>
    	<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">5.</span>
    	</p>
    </td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6">
    	<table style="width:100%;border:none;border-style:none">
    		<tr>
    			<td width="25%" style="text-align:center;vertical-align: top;">
		    		Diperiksa,<br/>
		    		a.n. Kepala Seksi Peninjauan Lokasi
		    		<br/><br/><br/>
		    		Darus, S.Sos, ME.<br/>
		    		NIP.xxxxxxxxxxxxxxx
    			</td>
    			<td width="25%" style="vertical-align: top;">
		    		<span style="text-align:center;display:block;">Dibuat, Petugas</span>
    			</td>
    			<td width="25%" style="text-align:center;vertical-align: top;">
		    		Pemohon,<br/><br/><br/><br/>
		    		{{ $per->nama_pemohon }}
    			</td>
    		</tr>
    	</table>
    	</div>
    </td>
  </tr>
</table>
<table class="tg" style="width: 100%">
<colgroup>
<col style="width: 200px">
<col style="width: 300px">
<col style="width: 300px">
</colgroup>
  <tr>
    <th class="tg-s6z2" colspan="3">LEMBAR PEMBERITAHUAN KEKURANGAN SYARAT</th>
  </tr>
  <tr>
    <td class="tg-031e" colspan="3">Sesuai hasil penelitian berkas permohonan dan hasil tinjau lokasi, maka dengan ini diberitahukan kepada :</td>
  </tr>
  <tr>
    <td class="tg-031e">Nama Pemohon</td>
    <td class="tg-031e" colspan="2">{{ $per->nama_pemohon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Alamat Pemohon</td>
    <td class="tg-yw4l" colspan="2">{{ $per->alamat_pemohon }} Telp : {{ $per->no_telepon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Lokasi yang dimohonkan</td>
    <td class="tg-yw4l" colspan="2">{{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="3"><p>Bahwa terdapat persyaratan yang harus dilengkapi agar permohonan dapat diproses, yaitu :
		<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">1.</span>
		<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">2.</span>
		<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">3.</span>
		<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">4.</span>
		<span style="display: block;margin-bottom: 5px;border-bottom: 1px dashed #4e4e4e;margin-right: 25px;margin-left:25px;">5.</span>
    </p></td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="3">syaratnya</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Diberitahukan Pada :</td>
    <td class="tg-baqh" style="text-align:center;">Petugas,</td>
    <td class="tg-baqh" style="text-align:center;">Pemohon</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Hari       : </td>
    <td class="tg-yw4l" rowspan="2"></td>
    <td class="tg-baqh" rowspan="2" style="text-align:center;">{{ $per->nama_pemohon }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Tanggal : </td>
  </tr>
</table>
</div>
</section>
</body>
</html>
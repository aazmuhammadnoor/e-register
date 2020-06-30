<!DOCTYPE html>
<html>
<head>
	<title>REKAPITULASI JENIS IZIN</title>
	<style type="text/css">
	*{
		font-family: "verdana";
		font-weight: normal;
		margin:5px;
		padding:0px;
	}
	@page {size: A4 landscape,margin:10px;}
	.tg  {border-collapse:collapse;border-spacing:0;width: 100%}
	.tg td{font-family:Arial, sans-serif;font-size:10px;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
	.tg .tg-yw4l{vertical-align:top}
	.tg .tg-9hbo{font-weight:bold;vertical-align:top}
	h5{
		font-size: 10px;
	}
	</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paper.min.css') }}">
</head>
<body class="A4 landscape">
	<section style="width:980px;background-color:#fff;padding:10mm;margin-right:auto;margin-left:auto;">
		<h5 style="text-align: center;display: block;">Rekapitulasi Permohonan {{ $rs_izin->name }} </h5>
		<h5 style="text-align: center;display: block;">Di Kabupaten Sleman Per Bulan {{ $nm_bulan }} Tahun {{ $tahun}}</h5>
		<br/>
		<table class="tg">
			<thead>
				<tr>
					<th style="text-align: center;" width="24">NO</th>
					<th>TGL.PENDAFTARAN</th>
					<th>NO.PENDAFTARAN</th>
					<th>NAMA PEMOHON</th>
					<th>ALAMAT PEMOHON</th>
					<th>LOKASI PERMOHONAN</th>
					<th>TGL.TERBIT</th>
					<th>NOMOR SK</th>
					<th>BADAN USAHA</th>
					<th>STATUS</th>
				</tr>
			</thead>
			<tbody>
				@if(count($result) > 0)
					@php $no=1 @endphp
					@foreach($result as $key=>$val)
						<tr>
							<td style="text-align: center">{{ $no }}</td>
							<td>{{ $val['tgl_pendaftaran'] }}</td>
							<td>{{ $val['no_pendaftaran'] }}</td>
							<td>{{ $val['nama_pemohon'] }}</td>
							<td>{{ $val['alamat_pemohon'] }}</td>
							<td>{{ $val['lokasi_permohonan'] }}</td>
							<td>{{ $val['tgl_terbit'] }}</td>
							<td>{{ $val['nomor_sk'] }}</td>
							<td>{{ $val['badan_usaha'] }}</td>
							<td>{{ $val['posisi'] }}</td>
						</tr>
						@php $no++ @endphp
					@endforeach

				@else
				<tr><td colspan="10">Tidak ada Data</td></tr>
				@endif
			</tbody>
		</table>
		<div style="float:right;width: 300px;display: block;margin-top:15px;">
			<p style="font-size:11px;">
				Sleman, {{ date_id(date('Y-m-d')) }}<br/><br/>
				Kepala Seksi Data dan Informasi<br/>
				Bidang Pendaftaran, Informasi dan Pengaduan
			</p>
			<p style="font-size: 11px;margin-top:45px;">Agus Puguh Santoso<br/>
			NIP 19641224 198602 1 004</p>
		</div>
		<div style="clear:both;"></div>
	</section>
</body>
</html>

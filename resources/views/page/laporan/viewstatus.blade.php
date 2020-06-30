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
		<h5 style="text-align: center;display: block;">{{ strtoupper($title) }}</h5>
        <h5 style="text-align: center;display: block;">{{ strtoupper($stitle) }}</h5>
        <h5 style="text-align: center;display: block;">STATUS : <strong>{{ strtoupper($status) }}</strong></h5>
        <hr/>
		<table class="tg">
			<thead>
				<tr>
					<th style="text-align: center;" width="24">NO</th>
					<th width="80">TGL.PENDAFTARAN</th>
					<th width="24">NO.PENDAFTARAN</th>
					<th width="200">JENIS IZIN</th>
					<th width="200">NAMA PEMOHON</th>
					<th>ALAMAT PEMOHON</th>
					<th>LOKASI PERMOHONAN</th>
				</tr>
			</thead>
			<tbody>
				@if(count($data->count()) > 0)
					@php $no=1 @endphp
					@foreach($data as $val)
						<tr>
							<td style="text-align: center">{{ $no }}</td>
							<td>{{ date_id($val->tgl_pendaftaran) }}</td>
							<td>{{ $val->no_pendaftaran }}</td>
							<td>{{ (!is_null($val->getIzin)) ? $val->getIzin->name : "N/A"}}</td>
							<td>{{ $val->nama_pemohon }}</td>
							<td>{{ $val->alamat_pemohon }}</td>
							<td>{{ $val->lokasi_dukuh }} {{ $val->lokasi_kel }} {{ $val->lokasi_kec }} Kabupaten Sleman</td>
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

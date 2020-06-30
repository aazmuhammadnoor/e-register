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
	@page {size: A3 landscape}
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
<body class="A3 landscape">
	<section class="sheet padding-10mm">
		<h5 style="text-align: center;display: block;">BERDASARKAN TAHUN PERMOHONAN</h5>
		<h5 style="text-align: center;display: block;">KEADAAN : {{ date_month($bulan) }} TAHUN {{ $tahun }}</h5>
		<br/>
		<table class="tg">
			<thead>
				<tr>
					<th rowspan="2" valign="middle" style="text-align: center;" width="24">NO</th>
					<th rowspan="2" valign="middle" width="250">JENIS IZIN</th>
					<th rowspan="2" valign="middle" width="60">SISA PERMOHONAN IZIN {{ date_month($bulan-1) }} TAHUN {{ $tahun }}</th>
					<th rowspan="2" valign="middle" width="60">JUMLAH PERMOHONAN MASUK {{ date_month($bulan) }} {{ $tahun }}</th>
					<th colspan="4">JUMLAH IZIN YANG DIKELUARKAN {{ date_month($bulan) }} {{ $tahun }}<br/>BERDASARKAN TAHUN PERMOHONAN</th>
					<th colspan="4">JUMLAH PENOLAKAN YANG DIKELUARKAN {{ date_month($bulan) }} {{ $tahun }}<br/>BERDASARKAN TAHUN PERMOHONAN</th>
					<th rowspan="2" width="60">JUMLAH BERKAS KURANG SYARAT {{ date_month($bulan) }} {{ $tahun }}</th>
					<th rowspan="2" width="60">JUMLAH BERKAS DICABUT {{ date_month($bulan) }} {{ $tahun }}</th>
					<th rowspan="2" width="60">SISA PERMOHONAN IZIN S/D {{ date_month($bulan) }} {{ $tahun }}</th>
				</tr>
				<tr>
					<th style="text-align:center;" width="40">{{ $tahun_c }}</th>
					<th style="text-align:center;" width="40">{{ $tahun_d }}</th>
					<th style="text-align:center;" width="40">{{ $tahun_e }}</th>
					<th style="text-align:center;" width="40">JML</th>
					<th style="text-align:center;" width="40">{{ $tahun_c }}</th>
					<th style="text-align:center;" width="40">{{ $tahun_d }}</th>
					<th style="text-align:center;" width="40">{{ $tahun_e }}</th>
					<th style="text-align:center;" width="40">JML</th>
				</tr>
			</thead>
			<tbody>
				@php $no=1 @endphp
				@php $tsisa = 0 @endphp
				@foreach($result as $key=>$val)
					<tr>
						<td style="text-align: center;">{{ $no }}</td>
						<td>{{ $val['NamaIzin'] }}</td>
						<td style="text-align: center;">{{ $val['SisaDiTahun'] }}</td>
						<td style="text-align: center;">{{ $val['jmlPermohonanMasukBulan'] }}</td>
						<td style="text-align: center;">{{ $val['out_thnc'] }}</td>
						<td style="text-align: center;">{{ $val['out_thnd'] }}</td>
						<td style="text-align: center;">{{ $val['out_thne'] }}</td>
						<td style="text-align: center;">{{ $val['out_jumlah'] }}</td>
						<td style="text-align: center;">{{ $val['tolak_thnc'] }}</td>
						<td style="text-align: center;">{{ $val['tolak_thnd'] }}</td>
						<td style="text-align: center;">{{ $val['tolak_thne'] }}</td>
						<td style="text-align: center;">{{ $val['tolak_jumlah'] }}</td>
						<td style="text-align: center;">{{ $val['jmlKurangSyarat'] }}</td>
						<td style="text-align: center;">{{ $val['jmlCabut'] }}</td>
						<td style="text-align: center;">{{ $val['Sisa'] }}</td>
					</tr>
					@php $tsisa += $val['SisaDiTahun'] @endphp
					@php $no++ @endphp
				@endforeach
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
	</section>
</body>
</html>
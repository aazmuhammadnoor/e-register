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
		<h5 style="text-align: center;display: block;">REKAPITULASI JENIS IZIN YANG DITERBITKAN TAHUN {{ $tahun[0] }}</h5>
		<h5 style="text-align: center;display: block;">BADAN PENANAMAN MODAL DAN PELAYANAN PERIZINAN TERPADU KABUPATEN SLEMAN DIY</h5>
		<h5 style="text-align: center;display: block;">KEADAAN : {{ strtoupper(date_id($tanggal)) }}</h5>
		<br/>
		<table class="tg">
			<thead>
				<tr>
					<th rowspan="2" style="text-align: center;vertical-align: middle;" width="24">NO</th>
					<th rowspan="2" style="text-align: center;vertical-align: middle;" width="450px;">JENIS IJIN</th>
					<th colspan="13" style="text-align: center;vertical-align: middle;">JUMLAH PERMOHONAN IZIN MASUK TAHUN {{ $tahun[0] }}</th>
					<th colspan="13" style="text-align: center;vertical-align: middle;">JUMLAH IZIN YANG DITERBITKAN TAHUN {{ $tahun[0] }}</th>
					<th colspan="13" style="text-align: center;vertical-align: middle;">JUMLAH PENOLAKAN YANG DITERBITKAN TAHUN  {{ $tahun[0] }}</th>
					<th rowspan="2" style="text-align: center;vertical-align: middle;">JML</th>
				</tr>
				<tr>
					<th style="text-align: center">JAN</th>
					<th style="text-align: center">FEB</th>
					<th style="text-align: center">MAR</th>
					<th style="text-align: center">APR</th>
					<th style="text-align: center">MEI</th>
					<th style="text-align: center">JUN</th>
					<th style="text-align: center">JUL</th>
					<th style="text-align: center">AGU</th>
					<th style="text-align: center">SEP</th>
					<th style="text-align: center">OKT</th>
					<th style="text-align: center">NOV</th>
					<th style="text-align: center">DES</th>
					<th style="text-align: center">JML</th>
					<th style="text-align: center">JAN</th>
					<th style="text-align: center">FEB</th>
					<th style="text-align: center">MAR</th>
					<th style="text-align: center">APR</th>
					<th style="text-align: center">MEI</th>
					<th style="text-align: center">JUN</th>
					<th style="text-align: center">JUL</th>
					<th style="text-align: center">AGU</th>
					<th style="text-align: center">SEP</th>
					<th style="text-align: center">OKT</th>
					<th style="text-align: center">NOV</th>
					<th style="text-align: center">DES</th>
					<th style="text-align: center">JML</th>
					<th style="text-align: center">JAN</th>
					<th style="text-align: center">FEB</th>
					<th style="text-align: center">MAR</th>
					<th style="text-align: center">APR</th>
					<th style="text-align: center">MEI</th>
					<th style="text-align: center">JUN</th>
					<th style="text-align: center">JUL</th>
					<th style="text-align: center">AGU</th>
					<th style="text-align: center">SEP</th>
					<th style="text-align: center">OKT</th>
					<th style="text-align: center">NOV</th>
					<th style="text-align: center">DES</th>
					<th style="text-align: center">JML</th>
				</tr>
			</thead>
			<tbody>
				@php $no=1 @endphp
				@foreach($result as $key=>$arr)
					<tr>
						<td style="text-align: center">{{ $no }}</td>
						<td style="text-align: left">{{ $arr['NamaIzin'] }}</td>
						<td style="text-align: center">{{ $arr['jan_a'] }}</td>
						<td style="text-align: center">{{ $arr['feb_a'] }}</td>
						<td style="text-align: center">{{ $arr['mar_a'] }}</td>
						<td style="text-align: center">{{ $arr['apr_a'] }}</td>
						<td style="text-align: center">{{ $arr['mei_a'] }}</td>
						<td style="text-align: center">{{ $arr['jun_a'] }}</td>
						<td style="text-align: center">{{ $arr['jul_a'] }}</td>
						<td style="text-align: center">{{ $arr['agu_a'] }}</td>
						<td style="text-align: center">{{ $arr['sep_a'] }}</td>
						<td style="text-align: center">{{ $arr['okt_a'] }}</td>
						<td style="text-align: center">{{ $arr['nov_a'] }}</td>
						<td style="text-align: center">{{ $arr['des_a'] }}</td>
						<td style="text-align: center">{{ $arr['total_a'] }}</td>
						<td style="text-align: center">{{ $arr['jan_b'] }}</td>
						<td style="text-align: center">{{ $arr['feb_b'] }}</td>
						<td style="text-align: center">{{ $arr['mar_b'] }}</td>
						<td style="text-align: center">{{ $arr['apr_b'] }}</td>
						<td style="text-align: center">{{ $arr['mei_b'] }}</td>
						<td style="text-align: center">{{ $arr['jun_b'] }}</td>
						<td style="text-align: center">{{ $arr['jul_b'] }}</td>
						<td style="text-align: center">{{ $arr['agu_b'] }}</td>
						<td style="text-align: center">{{ $arr['sep_b'] }}</td>
						<td style="text-align: center">{{ $arr['okt_b'] }}</td>
						<td style="text-align: center">{{ $arr['nov_b'] }}</td>
						<td style="text-align: center">{{ $arr['des_b'] }}</td>
						<td style="text-align: center">{{ $arr['total_b'] }}</td>
						<td style="text-align: center">{{ $arr['jan_c'] }}</td>
						<td style="text-align: center">{{ $arr['feb_c'] }}</td>
						<td style="text-align: center">{{ $arr['mar_c'] }}</td>
						<td style="text-align: center">{{ $arr['apr_c'] }}</td>
						<td style="text-align: center">{{ $arr['mei_c'] }}</td>
						<td style="text-align: center">{{ $arr['jun_c'] }}</td>
						<td style="text-align: center">{{ $arr['jul_c'] }}</td>
						<td style="text-align: center">{{ $arr['agu_c'] }}</td>
						<td style="text-align: center">{{ $arr['sep_c'] }}</td>
						<td style="text-align: center">{{ $arr['okt_c'] }}</td>
						<td style="text-align: center">{{ $arr['nov_c'] }}</td>
						<td style="text-align: center">{{ $arr['des_c'] }}</td>
						<td style="text-align: center">{{ $arr['total_c'] }}</td>
						<td style="text-align: center">{{ ($arr['total_a'] + $arr['total_b'] + $arr['total_c']) }}</td>
					</tr>
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
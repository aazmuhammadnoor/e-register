<!DOCTYPE html>
<html>
<head>
	<title>REKAPITULASI JENIS IZIN</title>
</head>
<body class="A4 landscape">
	<section style="width:100%;background-color:#fff;padding:10mm;margin-right:auto;margin-left:auto;">
		<table class="tg">
			<thead>
				<tr>
					<th colspan="{{ (sizeof($meta->fields) + 10) }}">
						Rekapitulasi Permohonan {{ $rs_izin->name }} Di Kabupaten Sleman Per Bulan {{ $nm_bulan }} Tahun {{ $tahun}}
					</th>
				</tr>
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
					@foreach($meta->fields as $no=>$rsm)
						<th>{{ strtoupper(strtolower(str_replace("_"," ",$rsm))) }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@if(count($result) > 0)
					@php $nox=1 @endphp
					@foreach($result as $key=>$val)
						@php $mm = (!is_null($val['meta'])) ? json_decode($val['meta']) : false @endphp
						<tr>
							<td style="text-align: center">{{ $nox }}</td>
							<td>{{ $val['tgl_pendaftaran'] }}</td>
							<td>{{ $val['no_pendaftaran'] }}</td>
							<td>{{ $val['nama_pemohon'] }}</td>
							<td>{{ $val['alamat_pemohon'] }}</td>
							<td>{{ $val['lokasi_permohonan'] }}<br/>{{ $val['alamat_permohonan'] }}</td>
							<td>{{ $val['tgl_terbit'] }}</td>
							<td>{{ $val['nomor_sk'] }}</td>
							<td>{{ $val['badan_usaha'] }}</td>
							<td>{{ $val['posisi'] }}</td>
							@foreach($meta->fields as $no=>$rsm)
								<td>
								@if(isset($mm->{$rsm}))
									{{ $mm->{$rsm} }}
								@else
								 - 
								@endif
								</td>
							@endforeach
						</tr>
						@php $nox++ @endphp
					@endforeach

				@else
				<tr><td colspan="10">Tidak ada Data</td></tr>
				@endif
			</tbody>
		</table>
	</section>
</body>
</html>

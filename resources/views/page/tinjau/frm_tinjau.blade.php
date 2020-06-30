@if($hasil_tinjau)
<div class="divider">HASIL TINJAU LAPANGAN</div>
<table class="table table-striped table-bordered" id="table-small">
	<tr>
		<td width="200">No Berkas Bidang</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['no_bidang'] }}</td>
	</tr>
	<tr>
		<td>Tgl Masuk Bidang</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ date_day($hasil_tinjau['tgl_bidang']) }}</td>
	</tr>
	<tr>
		<td>Hari/Tgl Tinjau Lapangan</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ date_day($hasil_tinjau['tgl_tinjau']) }}</td>
	</tr>
	<tr>
		<td>Hasil Tinjau</td>
		<td class="text-center" width="32"> : </td>
		<td>{!!  $hasil_tinjau['hasil_tinjau'] !!}</td>
	</tr>
	<tr>
		<td>Batas - Batas </td>
		<td class="text-center" width="32"> : </td>
		<td>
			<ol>
				<li>Sebelah Utara Berbatasan Dengan {{ $hasil_tinjau['bu'] }}</li>
				<li>Sebelah Selatan Berbatasan Dengan {{ $hasil_tinjau['bs'] }}</li>
				<li>Sebelah Barat Berbatasan Dengan {{ $hasil_tinjau['bb'] }}</li>
				<li>Sebelah Timur Berbatasan Dengan {{ $hasil_tinjau['bt'] }}</li>
			</ol>
		</td>
	</tr>
	<tr>
		<td>Petuntukan</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['peruntukan'] }}</td>
	</tr>
	<tr>
		<td>Lapis Bang</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['lapis_bang'] }}</td>
	</tr>
	<tr>
		<td>Luas Tanah / Status </td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['luas_tanah'] }} m<sup>2</sup> / {{ $hasil_tinjau['status_tanah'] }}</td>
	</tr>
	<tr>
		<td>Sumur PAH/PAL</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['sumur_pah'] }} / {{ $hasil_tinjau['sumur_pal'] }}</td>
	</tr>
	<tr>
		<td>Sampah</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['sampah'] }}</td>
	</tr>
	<tr>
		<td>Sampedan Jalan/Irigasi/Sungai</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['sempadan_jalan'] }} / {{ $hasil_tinjau['sempadan_irigasi'] }} / {{ $hasil_tinjau['sempadan_sungai'] }}</td>
	</tr>
	<tr>
		<td>Kondisi</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['kondisi'] }} {{ $hasil_tinjau['persen_bangun'] }} % </td>
	</tr>
	<tr>
		<td>Hasil Kajian Petugas</td>
		<td class="text-center" width="32"> : </td>
		<td>
			{!!  $hasil_tinjau['hasil_kajian'] !!}
		</td>
	</tr>
	<tr>
		<td>Petugas</td>
		<td class="text-center" width="32"> : </td>
		<td>{{ $hasil_tinjau['petugas'] }}</td>
	</tr>
</table>
@endif
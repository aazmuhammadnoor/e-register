<div class="divider text-primary">DATA PROFESI</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Profesi</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->profesi->nama : '' }}</td>
		<td width="200">Nomor STR</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->nomor_str : '' }}</td>
	</tr>
	<tr>
		<td width="200">Penerbit</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->penerbit : '' }}</td>
	</tr>
	<tr>
		<td width="200">Berlaku Mulai</td>
		<td>: {{ $per->getProfesi ? is_date($per->getProfesi->berlaku_mulai) : '' }}</td>
		<td width="200">Berlaku Sampai</td>
		<td>: {{ $per->getProfesi ? is_date($per->getProfesi->berlaku_sampai) : '' }}</td>
	</tr>
	<tr>
		<td width="200">Kota Terbit</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->kota_terbit : '' }}</td>
		<td width="200">Jenis Cetakan STR</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->jenis_cetakan_str : '' }}</td>
	</tr>
	<tr>
		<td width="200">Jenis PT</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->jenis_pt : '' }}</td>
		<td width="200">Nama PT</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->nama_pt : '' }}</td>
	</tr>
	<tr>
		<td width="200">Kota PT</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->kota_pt : '' }}</td>
		<td width="200">Kompetensi</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->kompetensi : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nomor Sertifikat Kompetensi</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->nomor_sertifikat_kompetensi : '' }}</td>
		<td width="200">Tahun Lulus</td>
		<td>: {{ $per->getProfesi ? $per->getProfesi->tahun_lulus : '' }}</td>
	</tr>
</table>
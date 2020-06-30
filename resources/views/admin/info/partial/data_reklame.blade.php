<div class="divider text-primary">DATA REKLAME</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Jenis Advertising</td>
		<td>: {{ $per->getReklame ? $per->getReklame->jenis_advertising : '' }}</td>
		<td width="200">Nama Perusahaan</td>
		<td>: {{ $per->getReklame ? $per->getReklame->nama_perusahaan : '' }}</td>
	</tr>
	<tr>
		<td width="200">NPWP</td>
		<td>: {{ $per->getReklame ? $per->getReklame->npwp : '' }}</td>
		<td width="200">NPWP DAERAH</td>
		<td>: {{ $per->getReklame ? $per->getReklame->npwp_d : '' }}</td>
	</tr>
	<tr>
		<td width="200">Provinsi</td>
		<td>: {{ $per->getReklame ? $per->getReklame->getProvinsi->name : '' }}</td>
		<td width="200">Kabupaten</td>
		<td>: {{ $per->getReklame ? $per->getReklame->getKabupaten->name : '' }}</td></td>
	</tr>
	<tr>
		<td width="200">Kecamatan</td>
		<td>: {{ $per->getReklame ? $per->getReklame->getKecamatan->name : '' }}</td></td>
		<td width="200">Kelurahan</td>
		<td>: {{ $per->getReklame ? $per->getReklame->getKelurahan->name : '' }}</td></td>
	</tr>
	<tr>
		<td width="200">RT</td>
		<td>: {{ $per->getReklame ? $per->getReklame->rt : '' }}</td>
		<td width="200">RW</td>
		<td>: {{ $per->getReklame ? $per->getReklame->rw : '' }}</td>
	</tr>
	<tr>
		<td width="200">Alamat Lengkap</td>
		<td>: {{ $per->getReklame ? $per->getReklame->alamat : '' }}</td>
	</tr>
</table>
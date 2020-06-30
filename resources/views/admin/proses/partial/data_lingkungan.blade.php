<div class="divider text-primary">DATA LINGKUNGAN</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Jenis Kegiatan</td>
		<td>: {{ $per->getLingkungan ? $per->getLingkungan->jenis_kegiatan : '' }}</td>
		<td width="200">Oleh</td>
		<td>: {{ $per->getLingkungan ? $per->getLingkungan->oleh : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nama Perusahaan/Pribadi</td>
		<td>: {{ $per->getLingkungan ? $per->getLingkungan->nama_perusahaan : '' }}</td>
		<td width="200">Alamat Perusahaan</td>
		<td>: {{ $per->getLingkungan ? $per->getLingkungan->alamat_perusahaan : '' }}</td>
	</tr>
</table>
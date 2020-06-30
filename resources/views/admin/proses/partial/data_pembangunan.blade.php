<div class="divider text-primary">DATA PEMBANGUNAN</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Nomor Sertifikat</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->nomor_sertifikat : '' }}</td>
		<td width="200">Jenis Sertifikat</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->jenis_sertifikat : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nama Pada Sertifikat</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->nama_pada_sertifikat : '' }}</td>
		<td width="200"></td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Tanggal Sertifikat</td>
		<td>: {{ $per->getPembangunan ? date('d-m-Y', strtotime($per->getPembangunan->tanggal_sertifikat)) : '' }}</td>
		<td width="200">Luas Tanah</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->luas_tanah : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nomor Akte Jual Beli</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->nomor_akte_jual_beli : '' }}</td>
		<td width="200">Tanggal Akte Jual Beli</td>
		<td>: {{ $per->getPembangunan ? date('d-m-Y', strtotime($per->getPembangunan->tanggal_akte_jual_beli)) : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nama Notaris</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->nama_notaris : '' }}</td>
		<td width="200">Nama Ahli Waris</td>
		<td>: {{ $per->getPembangunan ? $per->getPembangunan->nama_ahli_waris : '' }}</td>
	</tr>
</table>
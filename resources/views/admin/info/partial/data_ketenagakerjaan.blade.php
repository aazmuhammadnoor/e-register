<div class="divider text-primary">DATA KETENAGAKERJAAN</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Nama Perusahaan</td>
		<td>: {{ $per->getKetenagakerjaan ? $per->getKetenagakerjaan->nama_perusahaan : '' }}</td>
	</tr>
	<tr>
		<td width="200">WNI Pria</td>
		<td>: {{ $per->getKetenagakerjaan ? $per->getKetenagakerjaan->wni_pria : '' }}</td>
		<td width="200">WNI Wanita</td>
		<td>: {{ $per->getKetenagakerjaan ? $per->getKetenagakerjaan->wni_wanita : '' }}</td>
	</tr>
	<tr>
		<td width="200">WNA Pria</td>
		<td>: {{ $per->getKetenagakerjaan ? $per->getKetenagakerjaan->wna_pria : '' }}</td>
		<td width="200">WNA Wanita</td>
		<td>: {{ $per->getKetenagakerjaan ? $per->getKetenagakerjaan->wna_wanita : '' }}</td>
	</tr>
</table>
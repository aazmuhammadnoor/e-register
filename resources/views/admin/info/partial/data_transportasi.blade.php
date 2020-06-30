<div class="divider text-primary">DATA TRANSPORTASI</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Nomor Kendaraan</td>
		<td>: {{ $per->getTransportasi ? $per->getTransportasi->nomor_kendaraan : '' }}</td>
		<td width="200">Nomor Rangka</td>
		<td>: {{ $per->getTransportasi ? $per->getTransportasi->nomor_rangka : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nomor Mesin</td>
		<td>: {{ $per->getTransportasi ? $per->getTransportasi->nomor_mesin : '' }}</td>
		<td width="200">Nama pada STNK</td>
		<td>: {{ $per->getTransportasi ? $per->getTransportasi->nama_pada_stnk : '' }}</td>
	</tr>
	<tr>
		<td width="200">Tahun Pembuatan</td>
		<td>: {{ $per->getTransportasi ? $per->getTransportasi->tahun_pembuatan : '' }}</td>
	</tr>
</table>
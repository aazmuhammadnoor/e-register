<div class="divider text-primary">DATA PERUSAHAAN</div>
<table class="table-dot table-sm">
	<tr>
		<td width="200">Nama Perusahaan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->nama_perusahaan : '' }}</td>
		<td>Alamat Perusahaan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->alamat_perusahaan : '' }}</td>
	</tr>
	<tr>
		<td width="200">Jenis Perusahaan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->jenis_perusahaan : '' }}</td>
		<td>Status Jabatan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->status_jabatan : '' }}</td>
	</tr>
	<tr>
		<td width="200">Kegiatan Utama</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->kegiatan_utama : '' }}</td>
		<td width="200">Nomor Akte Pendirian</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->nomor_akte_pendirian : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nama Notaris Akta Pendirian</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->nama_notaris_pendirian : '' }}</td>
		<td>Tanggal Akte Pendirian</td>
		<td>: {{ $per->getPerusahaan ? date_id($per->getPerusahaan->tanggal_akte_pendirian)  : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nomor Notaris Pendirian</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->nama_notaris_pendirian : '' }}</td>
		<td>Modal Dasar Pendirian</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->modal_dasar_pendirian : '' }}</td>
	</tr>
	<tr>
		<td width="200">Modal ditempatkan Pendirian</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->modal_ditempatkan_pendirian : '' }}</td>
	</tr>
	<tr>
		<td width="200">Nomor Akte Perubahan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->nomor_akte_perubahan : '' }}</td>
		<td>Tanggal Akte Perubahan</td>
		<td>: {{ $per->getPerusahaan ? date_id($per->getPerusahaan->tanggal_akte_perubahan) : '' }}</td>
	</tr>
	<tr>
		<td width="200">Modal Dasar Perubahan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->modal_dasar_perubahan : '' }}</td>
		<td>Modal ditempatkan Perubahan</td>
		<td>: {{ $per->getPerusahaan ? $per->getPerusahaan->modal_ditempatkan_perubahan : '' }}</td>
	</tr>
    <tr>
        <td>JENIS PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->jenis_perusahaan }}</td>
        <td>KEDUDUKAN PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->kedudukan_perusahaan }}</td>
    </tr>
    <tr>
        <td>Status Perusahaan</td>
        <td>: {{ $per->getPerusahaan->status_perusahaan }}</td>
        <td>NOMOR AHU</td>
        <td>: {{ $per->getPerusahaan->no_ahu }}</td>
    </tr>
    <tr>
        <td>DIREKTUR</td>
        <td>: {{ $per->getPerusahaan->direktur }}</td>
        <td>SAHAM DIREKTUR</td>
        <td>: {{ $per->getPerusahaan->saham_direktur }}</td>
    </tr>
    <tr>
        <td>KOMISARIS UTAMA</td>
        <td>: {{ $per->getPerusahaan->komisaris_utama }}</td>
        <td>SAHAM KOMISARIS UTAMA</td>
        <td>: {{ $per->getPerusahaan->saham_komisaris_utama }}</td>
    </tr>
    <tr>
        <td>KOMISARIS</td>
        <td>: {{ $per->getPerusahaan->komisaris }}</td>
        <td>SAHAM KOMISARIS</td>
        <td>: {{ $per->getPerusahaan->saham_komisaris }}</td>
    </tr>
</table>
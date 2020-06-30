<table class="table-dot table-sm">
	<tr>
		<td width="200">N I K</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->nik : '' }}</td>
		<td width="200"></td>
		<td rowspan="10" clas="text-center">
			<img src="{{ url('storage', [$per->getPendaftar->pas_foto]) }}" class="img-thumbnail mx-auto text-center" style="width: 151px !important">
		</td>
	</tr>
	<tr>
		<td width="200">Nama Lengkap</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->nama : '' }}</td>
		<td width="200"></td>
	</tr>
	<tr>
		<td width="200">Gelar Depan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->gelar_depan : '' }}</td>
		<td width="200"></td>
	</tr>
	<tr>
		<td width="200">Gelar Belakang</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->gelar_belakang : '' }}</td>
		<td width="200"></td>
	</tr>
	<tr>
		<td width="200">Tempat Lahir</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->tempat_lahir : '' }}</td>
		<td width="200"></td>
	</tr>
	<tr>
		<td width="200">Tanggal Lahir</td>
		<td>: {{ $per->getPemohon ? date_id($per->getPemohon->tanggal_lahir) : '' }}</td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Jenis Kelamin</td>
		<td>: {{ $per->getPemohon ? jenis_kelamin($per->getPemohon->jenis_kelamin) : '' }}</td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Agama</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->getAgama->name : '' }}</td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Status Perkawinan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->status_perkawinan : '' }}</td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Pekerjaan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->pekerjaan : '' }}</td>
		<td></td>
	</tr>
	<tr>
		<td width="200">Email</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->email : '' }}</td>
		<td width="200">Nomor Telepon</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->no_telp : '' }}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->alamat : '' }}</td>
		<td>Kelurahan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->getKelurahan->name : '' }} RT {{ $per->getPemohon ? $per->getPemohon->rt : '' }} RW {{ $per->getPemohon ? $per->getPemohon->rw : '' }}</td>

	</tr>
	<tr>
		<td>Kecamatan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->getKecamatan->name : '' }}</td>
		<td>Kabupaten / Kota</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->getKabupaten->name : '' }}</td>
	</tr>
	<tr>
		<td>Provinsi</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->getProvinsi->name : '' }}</td>
		<td>Kode Pos</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->kode_pos : '' }}</td>
	</tr>
	<tr>
		<td width="200">Kewarganegaraan</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->kewarganegaraan : '' }}</td>
		<td width="200">Nomor Passpor</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->nomor_passpor : '' }}</td>
	</tr>
	<tr>
		<td width="200">Tempat Terbit Passpor</td>
		<td>: {{ $per->getPemohon ? $per->getPemohon->tempat_terbit_passpor : '' }}</td>
		<td width="200"></td>
		<td></td>
	</tr>
</table>
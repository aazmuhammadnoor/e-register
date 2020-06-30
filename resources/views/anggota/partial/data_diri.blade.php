<table class="table">
    <tr>
        <td width="40%">NIK</td>
        <td>: {{ $pendaftar != null ? $pendaftar->nik : '' }}</td>
    </tr>
    <tr>
        <td>NAMA LENGKAP</td>
        <td>: {{ $pendaftar != null ? $pendaftar->nama : '' }}</td>
    </tr>
    <tr>
        <td>GELAR DEPAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}</td>
    </tr>
    <tr>
        <td>GELAR BELAKANG</td>
        <td>: {{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}</td>
    </tr>
    <tr>
        <td>JENIS KELAMIN</td>
        <td>: {{ $pendaftar->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'}}</td>
    </tr>
    <tr>
        <td>AGAMA</td>
        <td>: {{ $pendaftar != null ? $pendaftar->getAgama ? $pendaftar->getAgama->name : '' : '' }}</td>
    </tr>
    <tr>
        <td>STATUS PERKAWINAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->status_perkawinan : '' }}</td>
    </tr>
    <tr>
        <td>PEKERJAAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}</td>
    </tr>
    <tr>
        <td>TEMPAT TANGGAL LAHIR</td>
        <td>: {{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}, {{ $pendaftar != null ? $pendaftar->tanggal_lahir : '' }}</td>
    </tr>
    <tr>
        <td>PROVINSI</td>
        <td>: {{ $pendaftar != null ? $pendaftar->getProvinsi->name : '' }}</td>
    </tr>
    <tr>
        <td>KABUPATEN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->getKabupaten->name : '' }}</td>
    </tr>
    <tr>
        <td>KECAMATAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->getKecamatan->name : '' }}</td>
    </tr>
    <tr>
        <td>KELURAHAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->getKelurahan->name : '' }}</td>
    </tr>
    <tr>
        <td>RT</td>
        <td>: {{ $pendaftar != null ? $pendaftar->rt : '' }}</td>
    </tr>
    <tr>
        <td>RW</td>
        <td>: {{ $pendaftar != null ? $pendaftar->rw : '' }}</td>
    </tr>
    <tr>
        <td>KODEPOS</td>
        <td>: {{ $pendaftar != null ? $pendaftar->kode_pos : '' }}</td>
    </tr>
    <tr>
        <td>ALAMAT</td>
        <td>: {{ $pendaftar != null ? $pendaftar->alamat : '' }}</td>
    </tr>
    <tr>
        <td>TELEPON</td>
        <td>: {{ $pendaftar != null ? $pendaftar->no_telp : '' }}</td>
    </tr>
    <tr>
        <td>KEWARNEGARAAN</td>
        <td>: {{ $pendaftar != null ? $pendaftar->kewarganegaraan : '' }}</td>
    </tr>
    <tr>
        <td>NOMOR PASSPOR</td>
        <td>: {{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}</td>
    </tr>
    <tr>
        <td>TEMPAT TERBIT PASSPOR</td>
        <td>: {{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}</td>
    </tr>
</table>
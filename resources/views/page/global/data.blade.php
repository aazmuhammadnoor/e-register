<table class="table table table-bordered">
    <tr class="bg-info">
        <td width="200">Perizinan</td>
        <td>{{ $per->getIzin->name }}</td>
    </tr>
    <tr class="bg-info">
        <td>Nomor Registrasi Berkas</td>
        <td>{{ $per->no_pendaftaran }}</td>
    </tr>
    <tr class="bg-info">
        <td>Tanggal Registrasi</td>
        <td>{{ date_day($per->tgl_pendaftaran) }}</td>
    </tr>
    <tr class="bg-gray">
        <td>Fungsi Bangunan</td>
        <td> {{ (isset($meta->fungsi_bangunan)) ? $meta->fungsi_bangunan  : $meta->fungsi_bangunan_gedung }}</td>
    </tr>
    <tr class="bg-gray">
        <td width="200">Nama Pemohon</td>
        <td> {{ $per->nama_pemohon }}</td>
    </tr>
    <tr class="bg-gray">
        <td>N I K</td>
        <td>{{ $per->nik }}</td>
    </tr>
    <tr class="bg-gray">
        <td>Nomor Telepon</td>
        <td>{{ $per->no_telepon }}</td>
    </tr>
    <tr class="bg-gray">
        <td>Alamat Pemohon</td>
        <td>{{ $per->alamat_pemohon }}</td>
    </tr>
</table>
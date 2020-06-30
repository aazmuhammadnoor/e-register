<div class='col-md-12'>
    <div class='divider'>DATA REKLAME</div>
</div>
<table class="table">
    <tr>
        <td width="30%">JENIS PERUSAHAAN</td>
        <td>: {{ $per->getReklame->jenis_advertising }}</td>
    </tr>
    <tr>
        <td>NAMA PERUSAHAAN</td>
        <td>: {{ $per->getReklame->nama_perusahaan }}</td>
    </tr>
    <tr>
        <td>NPWP</td>
        <td>: {{ $per->getReklame->npwp }}</td>
    </tr>
    <tr>
        <td>NPWP DAERAH</td>
        <td>: {{ $per->getReklame->npwp_d }}</td>
    </tr>
    <tr>
        <td>PROVINSI</td>
        <td>: {{ $per->getReklame->getProvinsi->name }}</td>
    </tr>
    <tr>
        <td>KABUPATEN</td>
        <td>: {{ $per->getReklame->getKabupaten->name }}</td>
    </tr>
    <tr>
        <td>KECAMATAN</td>
        <td>: {{ $per->getReklame->getKecamatan->name }}</td>
    </tr>
    <tr>
        <td>KELURAHAN</td>
        <td>: {{ $per->getReklame->getKelurahan->name }}</td>
    </tr>
    <tr>
        <td>ALAMAT</td>
        <td>: {{ $per->getReklame->alamat }}</td>
    </tr>
    <tr>
        <td>KODE POS</td>
        <td>: {{ $per->getReklame->kode_pos }}</td>
    </tr>
    <tr>
        <td>RT</td>
        <td>: {{ $per->getReklame->rt }}</td>
    </tr>
    <tr>
        <td>RW</td>
        <td>: {{ $per->getReklame->rw }}</td>
    </tr>
</table>
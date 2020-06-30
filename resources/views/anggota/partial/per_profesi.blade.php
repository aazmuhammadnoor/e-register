<div class='col-md-12'>
    <div class='divider'>DATA PROFESI</div>
</div>
<table class="table">
    <tr>
        <td width="30%">PROFESI</td>
        <td>: {{ $per->getProfesi->profesi->nama }}</td>
    </tr>
    <tr>
        <td>NOMOR STR</td>
        <td>: {{ $per->getProfesi->nomor_str }}</td>
    </tr>
    <tr>
        <td>PENERBIT STR</td>
        <td>: {{ $per->getProfesi->penerbit }}</td>
    </tr>
    <tr>
        <td>BERLAKU MULAI</td>
        <td>: {{ $per->getProfesi->berlaku_mulai }}</td>
    </tr>
    <tr>
        <td>BERLAKU SAMPAI</td>
        <td>: {{ $per->getProfesi->berlaku_sampai }}</td>
    </tr>
    <tr>
        <td>KOTA TERBIT STR</td>
        <td>: {{ $per->getProfesi->kota_terbit }}</td>
    </tr>
    <tr>
        <td>JENIS CETAKAN STR</td>
        <td>: {{ $per->getProfesi->jenis_cetakan_str }}</td>
    </tr>
    <tr>
        <td>STATUS PERGURUAN TINGGI</td>
        <td>: {{ $per->getProfesi->status_pt }}</td>
    </tr>
    <tr>
        <td>JENIS PERGURUAN TINGGI</td>
        <td>: {{ $per->getProfesi->jenis_pt }}</td>
    </tr>
    <tr>
        <td>NAMA PERGURUAN TINGGI</td>
        <td>: {{ $per->getProfesi->nama_pt }}</td>
    </tr>
    <tr>
        <td>KOTA PERGURUAN TINGGI</td>
        <td>: {{ $per->getProfesi->kota_pt }}</td>
    </tr>
    <tr>
        <td>KOMPETENSI</td>
        <td>: {{ $per->getProfesi->kompetensi }}</td>
    </tr>
    <tr>
        <td>NOMOR SERTIFIKAT KOMPETENSI</td>
        <td>: {{ $per->getProfesi->nomor_sertifikat_kompetensi }}</td>
    </tr>
    <tr>
        <td>TAHUN LULUS</td>
        <td>: {{ $per->getProfesi->tahun_lulus }}</td>
    </tr>
</table>
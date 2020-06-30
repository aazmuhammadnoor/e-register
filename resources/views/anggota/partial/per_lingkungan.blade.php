<div class='col-md-12'>
    <div class='divider'>DATA LINGKUNGAN</div>
</div>
<table class="table">
    <tr>
        <td width="30%">JENIS KEGIATAN</td>
        <td>: {{ $per->getLingkungan->jenis_kegiatan }}</td>
    </tr>
    <tr>
        <td>OLEH</td>
        <td>: {{ $per->getLingkungan->oleh }}</td>
    </tr>
    <tr>
        <td>NAMA PERUSAHAAN</td>
        <td>: {{ $per->getLingkungan->nama_perusahaan }}</td>
    </tr>
    <tr>
        <td>ALAMAT PERUSAHAAN</td>
        <td>: {{ $per->getLingkungan->alamat_perusahaan }}</td>
    </tr>
</table>
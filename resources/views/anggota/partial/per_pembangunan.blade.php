<div class='col-md-12'>
    <div class='divider'>DATA PEMBANGUNAN</div>
</div>
<table class="table">
    <tr>
        <td width="30%">NOMOR SERTIFIKAT</td>
        <td>: {{ $per->getPembangunan->nomor_sertifikat }}</td>
    </tr>
    <tr>
        <td>NAMA PADA SERTIFIKAT</td>
        <td>: {{ $per->getPembangunan->nama_pada_sertifikat }}</td>
    </tr>
    <tr>
        <td>JENIS SERTIFIKAT</td>
        <td>: {{ $per->getPembangunan->jenis_sertifikat }}</td>
    </tr>
    <tr>
        <td>TANGGAL SERTIFIKAT</td>
        <td>: {{ date_id($per->getPembangunan->tanggal_sertifikat) }}</td>
    </tr>
    <tr>
        <td>LUAS TANAH</td>
        <td>: {{ $per->getPembangunan->luas_tanah }}</td>
    </tr>
    <tr>
        <td>NOMOR AKTA JUAL BELI</td>
        <td>: {{ $per->getPembangunan->nomor_akte_jual_beli }}</td>
    </tr>
    <tr>
        <td>TANGGAL AKTA JUAL BELI</td>
        <td>: {{ date_id($per->getPembangunan->tanggal_akte_jual_beli) }}</td>
    </tr>
    <tr>
        <td>NAMA NOTARIS</td>
        <td>: {{ $per->getPembangunan->nama_notaris }}</td>
    </tr>
    <tr>
        <td>NAMA AHLI WARIS</td>
        <td>: {{ $per->getPembangunan->nama_ahli_waris }}</td>
    </tr>
    <tr>
        <td>NOMOR GS</td>
        <td>: {{ $per->getPembangunan->nomor_gs }}</td>
    </tr>
    <tr>
        <td>TAHUN GS</td>
        <td>: {{ $per->getPembangunan->tahun_gs }}</td>
    </tr>
</table>
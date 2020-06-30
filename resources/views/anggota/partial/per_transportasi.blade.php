<div class='col-md-12'>
    <div class='divider'>DATA TRANSPORTASI</div>
</div>
<table class="table">
    <tr>
        <td width="30%">NOMOR KENDARAAN</td>
        <td>: {{ $per->getTransportasi->nomor_kendaraan }}</td>
    </tr>
    <tr>
        <td>NOMOR RANGKA</td>
        <td>: {{ $per->getTransportasi->nomor_rangka }}</td>
    </tr>
    <tr>
        <td>TAHUN PEMBUATAN</td>
        <td>: {{ $per->getTransportasi->tahun_pembuatan }}</td>
    </tr>
    <tr>
        <td>NAMA PADA STNK</td>
        <td>: {{ $per->getTransportasi->nama_pada_stnk }}</td>
    </tr>
    <tr>
        <td>NOMOR MESIN</td>
        <td>: {{ $per->getTransportasi->nomor_mesin }}</td>
    </tr>
</table>
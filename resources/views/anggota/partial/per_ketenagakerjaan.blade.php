<div class='col-md-12'>
    <div class='divider'>DATA KETENAGAKERJAAN</div>
</div>
<table class="table">
    <tr>
        <td width="30%">NAMA PERUSAHAAN</td>
        <td>: {{ $per->getKetenagakerjaan->nama_perusahaan }}</td>
    </tr>
    <tr>
        <td>WNI PRIA</td>
        <td>: {{ $per->getKetenagakerjaan->wni_pria }}</td>
    </tr>
    <tr>
        <td>WNI WANITA</td>
        <td>: {{ $per->getKetenagakerjaan->wni_wanita }}</td>
    </tr>
    <tr>
        <td>WNA PRIA</td>
        <td>: {{ $per->getKetenagakerjaan->wna_pria }}</td>
    </tr>
    <tr>
        <td>WNA WANITA</td>
        <td>: {{ $per->getKetenagakerjaan->wna_wanita }}</td>
    </tr>
</table>
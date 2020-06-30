<div class='col-md-12'>
    <div class='divider'>DATA PERUSAHAAN</div>
</div>
<table class="table">
    <tr>
        <td width="30%">NOMOR AKTA PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->nomor_akte_pendirian }}</td>
    </tr>
    <tr>
        <td>JENIS PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->jenis_perusahaan }}</td>
    </tr>
    <tr>
        <td>STATUS PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->status_perusahaan }}</td>
    </tr>
    <tr>
        <td>NAMA PERUSAHAAN</td>
        <td>: {{ $per->getPerusahaan->nama_perusahaan }}</td>
    </tr>
    <tr>
        <td>STATUS JABATAN</td>
        <td>: {{ $per->getPerusahaan->status_jabatan }}</td>
    </tr>
    <tr>
        <td>ALAMAT PERUSANAAN</td>
        <td>: {{ $per->getPerusahaan->alamat_perusahaan }}</td>
    </tr>
    <tr>
        <td>KEDUDUKAN PERUSANAAN</td>
        <td>: {{ $per->getPerusahaan->kedudukan_perusahaan }}</td>
    </tr>
    <tr>
        <td>TANGGAL AKTA PENDIRIAN</td>
        <td>: {{ date_id($per->getPerusahaan->tanggal_akte_pendirian) }}</td>
    </tr>
    <tr>
        <td>NAMA NOTARIS PENDIRIAN</td>
        <td>: {{ $per->getPerusahaan->nama_notaris_pendirian }}</td>
    </tr>
    <tr>
        <td>MODAL DASAR PENDIRIAN</td>
        <td>: {{ $per->getPerusahaan->modal_dasar_pendirian }}</td>
    </tr>
    <tr>
        <td>MODAL DITEMPATKAN PENDIRIAN</td>
        <td>: {{ $per->getPerusahaan->modal_ditempatkan_pendirian }}</td>
    </tr>
    <tr>
        <td>NOMOR AKTE PERUBAHAN</td>
        <td>: {{ $per->getPerusahaan->nomor_akte_perubahan }}</td>
    </tr>
    <tr>
        <td>TANGGAL AKTA PERUBAHAN</td>
        <td>: {{ date_id($per->getPerusahaan->tanggal_akte_perubahan) }}</td>
    </tr>
    <tr>
        <td>NAMA NOTARIS PERUBAHAN</td>
        <td>: {{ $per->getPerusahaan->nama_notaris_perubahan }}</td>
    </tr>
    <tr>
        <td>MODAL DASAR PERUBAHAN</td>
        <td>: {{ $per->getPerusahaan->modal_dasar_perubahan }}</td>
    </tr>
    <tr>
        <td>MODAL DITEMPATKAN PERUBAHAN</td>
        <td>: {{ $per->getPerusahaan->modal_ditempatkan_perubahan }}</td>
    </tr>
    <tr>
        <td>KEGIATAN UTAMA</td>
        <td>: {{ $per->getPerusahaan->kegiatan_utama }}</td>
    </tr>
    <tr>
        <td>NOMOR AHU</td>
        <td>: {{ $per->getPerusahaan->no_ahu }}</td>
    </tr>
    <tr>
        <td>DIREKTUR</td>
        <td>: {{ $per->getPerusahaan->direktur }}</td>
    </tr>
    <tr>
        <td>KOMISARIS UTAMA</td>
        <td>: {{ $per->getPerusahaan->komisaris_utama }}</td>
    </tr>
    <tr>
        <td>KOMISARIS</td>
        <td>: {{ $per->getPerusahaan->komisaris }}</td>
    </tr>
    <tr>
        <td>SAHAM DIREKTUR</td>
        <td>: {{ $per->getPerusahaan->saham_direktur }}</td>
    </tr>
    <tr>
        <td>SAHAM KOMISARIS UTAMA</td>
        <td>: {{ $per->getPerusahaan->saham_komisaris_utama }}</td>
    </tr>
    <tr>
        <td>SAHAM KOMISARIS</td>
        <td>: {{ $per->getPerusahaan->saham_komisaris }}</td>
    </tr>
</table>
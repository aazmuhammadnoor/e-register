<table class="table-striped table-bordered table-small" style="width:100%">
    <tr>
        <td width="300" class="p-1">Luas Total Bangunan</td>
        <td class="p-1">{{ $retri->luas_total }} m<sup>2</sup></td>
    </tr>
    <tr>
        <td class="p-1">Retribusi Banguan Gedung</td>
        <td class="p-1 text-right">Rp. {{ number_format($retri->jumlah_retribusi_gedung) }}</td>
    </tr>
    <tr>
        <td class="p-1">Retribusi Prasarana Banguan Gedung</td>
        <td class="p-1 text-right">Rp. {{ number_format($retri->retribusi_prasarana_gedung) }}</td>
    </tr>
    <tr>
        <td class="p-1">Sanksi Administrasi</td>
        <td class="p-1 text-right">Rp. {{ number_format($retri->sanksi_administrasi) }}</td>
    </tr>
    <tr class="bg-info">
        <td class="p-1">Jumlah Yang Harus Dibayarkan</td>
        <td class="p-1 text-right">Rp. {{ number_format($retri->harus_dibayarkan) }}</td>
    </tr>
</table>
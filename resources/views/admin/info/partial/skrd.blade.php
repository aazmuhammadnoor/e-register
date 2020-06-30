@if($per->izin == 137 || $per->izin == 138 || $per->izin == 227)
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center" width="32">No</th>
      <th>Nomor Pendaftaran</th>
      <th>Jenis Permohonan Izin</th>
      <th class="text-center" width="180">Kode Rekening</th>
      <th class="text-right" width="180">Jumlah Retribusi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td valign="top" class="text-center">1</td>
        <td valign="top">{{ $per->no_pendaftaran_sementara }}</td>
        <td valign="top">
          RETRIBUSI IMB<br/>
          PAPAN PROYEK<br/>
          PLAT IMB<br/>
          DENDA
        </td>
        <td class="text-center">
            {{ $ret->kode_retribusi_imb }}<br/>
            {{ $ret->kode_papan_proyek }}<br/>
            {{ $ret->kode_plat_imb }}<br/>
            {{ $ret->kode_denda_imb }}<br/>
        </td>
        <td class="text-right">
            Rp. {{ number_format($ret->retribusi_imb) }}<br/>
            Rp. {{ number_format($ret->papan_proyek) }}<br/>
            Rp. {{ number_format($ret->plat_imb) }}<br/>
            Rp. {{ number_format($ret->denda_imb) }}<br/>
        </td>
    </tr>
    <tr>
      <td colspan="4" class="text-right"><strong>JUMLAH TOTAL</strong></td>
      <td class="text-right"><strong>Rp. {{ number_format($ret->total) }}</strong></td>
    </tr>
    <tr>
      <td colspan="5"><strong>TOTAL : {{ ucwords(\App\Util\Terbilang::Konversi($ret->total)) }} Rupiah</strong></td>
    </tr>
  </tbody>
</table>
@elseif($per->izin == 139)
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="text-center" width="32">No</th>
        <th>Nomor Pendaftaran</th>
        <th>Jenis Permohonan Izin</th>
        <th class="text-center" width="180">Kode Rekening</th>
        <th class="text-right" width="180">Jumlah Retribusi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <td valign="top" class="text-center">1</td>
          <td valign="top">{{ $per->no_pendaftaran_sementara }}</td>
          <td valign="top">
            BIAYA UKUR<br/>
            BLANKO KRK<br/>
            PETA KRK<br/>
            DENDA
          </td>
          <td class="text-center">
              {{ $ret->kode_biaya_ukur }}<br/>
              {{ $ret->kode_blanko_krk }}<br/>
              {{ $ret->kode_peta_krk }}<br/>
              {{ $ret->kode_denda_krk }}<br/>
          </td>
          <td class="text-right">
              Rp. {{ number_format($ret->biaya_ukur) }}<br/>
              Rp. {{ number_format($ret->blanko_krk) }}<br/>
              Rp. {{ number_format($ret->peta_krk) }}<br/>
              Rp. {{ number_format($ret->denda_krk) }}<br/>
          </td>
      </tr>
      <tr>
        <td colspan="4" class="text-right"><strong>JUMLAH TOTAL</strong></td>
        <td class="text-right"><strong>Rp. {{ number_format($ret->total) }}</strong></td>
      </tr>
      <tr>
        <td colspan="5"><strong>TOTAL : {{ ucwords(\App\Util\Terbilang::Konversi($ret->total)) }} Rupiah</strong></td>
      </tr>
    </tbody>
  </table>
@elseif(in_array($per->izin, range(256,276)))
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="text-center" width="32">No</th>
        <th>Nomor Pendaftaran</th>
        <th>Jenis Permohonan Izin</th>
        <th class="text-center" width="180">Kode Rekening</th>
        <th class="text-right" width="180">Jumlah Retribusi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <td valign="top" class="text-center">1</td>
          <td valign="top">{{ $per->no_pendaftaran_sementara }}</td>
          <td valign="top">
            RETRIBUSI<br/>
            <small>KARTU PENGAWASAN</small><br/>
            DENDA
          </td>
          <td class="text-center">
              {{ $ret->kode_retribusi_trayek }}<br/>
              {{ $ret->kode_kartu_pengawasan_trayek }}<br/>
              {{ $ret->kode_denda_trayek }}<br/>
          </td>
          <td class="text-right">
              Rp. {{ number_format($ret->retribusi_trayek) }}<br/>
              Rp. {{ number_format($ret->kartu_pengawasan_trayek) }}<br/>
              Rp. {{ number_format($ret->denda_trayek) }}<br/>
          </td>
      </tr>
      <tr>
        <td colspan="4" class="text-right"><strong>JUMLAH TOTAL</strong></td>
        <td class="text-right"><strong>Rp. {{ number_format($ret->total) }}</strong></td>
      </tr>
      <tr>
        <td colspan="5"><strong>TOTAL : {{ ucwords(\App\Util\Terbilang::Konversi($ret->total)) }} Rupiah</strong></td>
      </tr>
    </tbody>
  </table>
@endif

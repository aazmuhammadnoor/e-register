<!DOCTYPE html>
<html>
<head>
    <title>PERHITUNGAN RETRIBUSI IZIN MENDIRIKAN BANGUNAN GEDUNG</title>
    <style type="text/css">
        @page { margin: 5px 15px; size: A4}
        body { margin: 5px 15px; }
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
        .tg td{font-family:Arial, sans-serif;font-size:10px;padding:2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
        .tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
        .tg .tg-yw4l{vertical-align:middle;}
        #info, #bawah{
            font-family:Arial, sans-serif;font-size:10px;
        }
        @if(isset($ispdf) && $ispdf == false)
        section{
          background: #fff;
          padding:10mm;
          width:960px;
          margin-left:auto;
          margin-right: auto;
        }
        @endif
    </style>
  @if(isset($ispdf) && $ispdf == false)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paper.min.css') }}">
  @endif
</head>
<body class="A4 padding-10mm">
<section>
<div style="width: 100%;text-align:center">
    <h4 style="font-family:Arial, sans-serif;font-size:11px;">PERHITUNGAN RETRIBUSI<br/>IZIN MENDIRIKAN BANGUNAN</h4>
</div>
<h4 style="font-family:Arial, sans-serif;font-size:11px;">I. Data Bangunan</h4>
<table style="width: 100%;" id="info">
    <tr>
        <td>a. Nama Pemilik Bangunan</td>
        <td>:</td>
        <td>{{ $per->nama_pemohon }}</td>
    </tr>
    <tr>
        <td>b. Lokasi Bangunan</td>
        <td>:</td>
        <td>Padukuhan {{ $per->lokasi_dukuh }} Kelurahan {{ $per->lokasi_kel }} Kecamatan {{ $per->lokasi_kec }}</td>
    </tr>
    <tr>
        <td>c. Fungsi Bangunan</td>
        <td>:</td>
        <td>{{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
    </tr>
    <tr>
        <td>a. Nomor Register Berkas</td>
        <td>:</td>
        <td>{{ $per->no_pendaftaran }}</td>
    </tr>
    <tr>
        <td>d. Tanggal Register Berkas</td>
        <td>:</td>
        <td>{{ date_day($per->tgl_pendaftaran) }}</td>
    </tr>
</table>
<h4 style="font-family:Arial, sans-serif;font-size:11px;">II. Retribusi Bangunan Gedung</h4>
<table class="tg" style="width: 100%;">
  <tr>
    <td class="tg-yw4l" rowspan="2" align="center">1.</td>
    <td class="tg-yw4l" rowspan="2">Luas Bangunan</td>
    <td class="tg-yw4l">Basm = {{ $rs['luas']['luas_bangunan_lantai_Basement_1'] }}</td>
    <td class="tg-yw4l">Lt.1 = {{ $rs['luas']['luas_bangunan_lantai_1'] }}</td>
    <td class="tg-yw4l">Lt.2 = {{ $rs['luas']['luas_bangunan_lantai_2'] }}</td>
    <td class="tg-yw4l" rowspan="2" align="center" valign="middle">Luas Total (m<sup>2</sup>) </td>
    <td class="tg-yw4l" rowspan="2" align="center" valign="middle">{{ $rs['luas']['total'] + $rs['luas']['luas_basement'] }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l">Lt.3 = {{ $rs['luas']['luas_bangunan_lantai_3'] }}</td>
    <td class="tg-yw4l" colspan="2">Lt.4 = {{ $rs['luas']['luas_bangunan_lantai_4'] }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" align="center">2.</td>
    <td class="tg-yw4l">Kegiatan</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['item'] }}</td>
    <td class="tg-yw4l" colspan="4"><span style="margin-right:55px;">indeks =</span> {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'],2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" align="center">3.</td>
    <td class="tg-yw4l">Indeks Terintegrasi</td>
    <td class="tg-yw4l" colspan="5"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">a.Fungsi</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
    <td class="tg-yw4l" colspan="4"><span style="margin-right:55px;">indeks =</span> {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'],2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">b.Parameter</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Parameter']['item'] }}</td>
    <td class="tg-yw4l" colspan="4"><span style="margin-right:55px;">indeks =</span> {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'],2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="6">c. Indeks Klasifikasi</td>
  </tr>
  @foreach($integrasi as $nama=>$value)
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"><span style="margin-left:15px;">{{ $nama }}</span></td>
    <td class="tg-yw4l">{{ $value['item'] }}</td>
    <td class="tg-yw4l" colspan="4">
        <span style="margin-right:55px;">indeks =</span> 
        <span style="margin-right:55px;">{{ number_format($value['index'],2) }}</span>
        <span style="margin-right:55px;"><strong>x {{ number_format($value['parent'],2) }}</strong></span>  
        <span style="margin-right:55px;">= {{ number_format(($value['parent'] * $value['index']),3) }}</span> 
    </td>
  </tr>
  <?php $total_index+=($value['parent'] * $value['index']); ?>
  @endforeach
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="4"><strong><span style="margin-right:225px;">Jumlah</span> = {{ number_format($total_index,3) }}</strong></td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="6">Indeks Terintegrasi = a x b x c = {{ $rs['Retribusi Bangunan Gedung']['a']}} x {{ $rs['Retribusi Bangunan Gedung']['b'] }} x {{ $rs['Retribusi Bangunan Gedung']['c'] }} = {{ ($rs['Retribusi Bangunan Gedung']['a'] * $rs['Retribusi Bangunan Gedung']['b'] * $rs['Retribusi Bangunan Gedung']['c'] ) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l" align="center">4.</td>
    <td class="tg-yw4l">Index Waktu Penggunaan</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['item'] }}</td>
    <td class="tg-yw4l" colspan="4"><span style="margin-right:55px;">indeks =</span> {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'],2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">Retribusi Bangunan Gedung</td>
    <td class="tg-yw4l" colspan="5"> = Luas total x Kegiatan x Indeks terintegrasi x waktu penggunaan x Rp. 15,000</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="5"> = {{ $rs['luas']['total'] }} x {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'],2) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['indeks_integrasi'],2) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'],2) }} x Rp. {{ number_format($rs['Retribusi Bangunan Gedung']['retribusi']) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="5"> = Rp. {{ number_format($rs['Retribusi Bangunan Gedung']['retribusi_bangunan']) }}</td>
  </tr>
</table>
<h4 style="font-family:Arial, sans-serif;font-size:11px;">III. Retreibusi Prasarana Bangunan Gedung</h4>
<table class="tg" style="width: 100%;">
  <tr>
    <th class="tg-yw4l"></th>
    <th class="tg-031e" colspan="3">Jenis Prasarana Bangunan Gedung</th>
    <th class="tg-031e">Volume</th>
    <th class="tg-031e">Harga Satuan</th>
    <th class="tg-031e">Retribusi Prasarana</th>
  </tr>
  @php $no=1 @endphp
  @foreach($rs['Retribusi Prasarana Bangunan Gedung']['data'] as $nama=>$value)
  <tr>
    <td class="tg-yw4l">{{ $no }}</td>
    <td class="tg-031e" colspan="6"><strong>{{ $nama }}</strong></td>
  </tr>
      @foreach($value as $txt=>$val)
      <tr>
        <td></td>
        <td class="tg-yw4l" colspan="3">{!! $txt !!}</td>
        <td class="tg-yw4l" align="center">{{ $val['volume'] }}</td>
        <td class="tg-yw4l" align="right">{{ number_format($val['harga']) }}</td>
        <td class="tg-yw4l" align="right">{{ number_format($val['total']) }}</td>
      </tr>
      @php $total_prasarana+=$val['total'] @endphp
      @endforeach
  @php $no++ @endphp
  @endforeach
  <tr>
    <td class="tg-lqy6"></td>
    <td class="tg-0ord" colspan="5" align="right">Jumlah</td>
    <td class="tg-0ord" align="right">{{ number_format($total_prasarana) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">Kegiatan</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['item'] }}</td>
    <td class="tg-yw4l">indeks</td>
    <td class="tg-yw4l" colspan="3"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'], 2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">Fungsi</td>
    <td class="tg-yw4l">{{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
    <td class="tg-yw4l">indeks</td>
    <td class="tg-yw4l" colspan="3">= {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">Retribusi</td>
    <td class="tg-yw4l" colspan="5"> = Jumlah satuan x indeks kegiatan x indeks fungsi</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" rowspan="2"></td>
    <td class="tg-yw4l" colspan="5"> = {{ number_format($total_prasarana) }} x  {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'], 2) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }}</td>
  </tr>
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="5">= {{ number_format($rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan']) }}</td>
  </tr>
</table>
<h4 style="font-family:Arial, sans-serif;font-size:11px;">IV.Sanki Administrasi Berupa Denda Pelanggaran RTBL</h4>
<table class="tg" style="width: 100%;">
    <?php $no =1; ?>
    @foreach($rs['Denda Administrasi']['data'] as $nama=>$value)
        <tr>
            <td width="24" align="center">{{ $no }}.</td>
            <td colspan="4">{{ $nama }}</td>
        </tr>
        @foreach($value as $txt=>$val)
            <tr>
                <td></td>
                <td>{!! $txt !!}</td>
                <td align="left">
                    {{ $txt }} x {{ $val['kooef'] }} 
                    @if(isset($val['faktor']))
                        @if($val['faktor'] == 'makam')
                            x Rp. {{ number_format($val['tambahan']) }}
                        @else
                            @if($val['faktor'] == 'harga_bangunan')
                                x 0.75 x {{ $txtdenda[$val['faktor']] }}
                            @else
                                x {{ $txtdenda[$val['faktor']] }}
                            @endif
                            
                        @endif
                    @endif
                </td>
                <td align="right">
                    {{ $val['volume'] }} x {{ $val['kooef'] }} 
                    @if(isset($val['faktor']))
                        @if($val['faktor'] == 'makam')
                            x Rp. {{ number_format($val['tambahan']) }}
                        @else
                            @if($val['faktor'] == 'harga_bangunan')
                              x 0.75 x Rp. {{ number_format($rs['harga'][$val['faktor']]) }}
                            @else
                              x Rp. {{ number_format($rs['harga'][$val['faktor']]) }}
                            @endif
                            
                        @endif
                    @endif
                </td>
                <td align="right">
                    @if($val['faktor'] == 'makam')
                        {{ number_format($val['volume'] * $val['kooef'] * $val['tambahan']) }} 
                    @else
                        @if($val['faktor'] == 'harga_bangunan')
                            {{ number_format($val['volume'] * 0.75 * $val['kooef'] * $rs['harga'][$val['faktor']]) }} 
                        @else
                            {{ number_format($val['volume'] * $val['kooef'] * $rs['harga'][$val['faktor']]) }} 
                        @endif
                        
                    @endif
                </td>
            </tr>
        @endforeach
     <?php $no++; ?>
    @endforeach
</table>
<h4 style="font-family:Arial, sans-serif;font-size:11px;">Retribusi Izin Mendirikan Bangunan</h4>
<table style="width: 100%;" id="bawah">
    <tr>
        <td width="32" align="center">1.</td>
        <td>Retribusi Bangunan Gedung</td>
        <td width="40">= Rp</td>
        <td align="right">{{ number_format($retribusi['jumlah_retribusi_gedung']) }}</td>
    </tr>
    <tr>
        <td width="32" align="center">2.</td>
        <td>Retribusi Prasarana Bangunan Gedung</td>
        <td>= Rp</td>
        <td align="right">{{ number_format($retribusi['retribusi_prasarana_gedung']) }}</td>
    </tr>
    <tr>
        <td style="border-bottom: 3px solid #4e4e4e;" width="32" align="center">3.</td>
        <td style="border-bottom: 3px solid #4e4e4e;">Sanki Administrasi Berupa Denda Pelanggaran RTBL</td>
        <td style="border-bottom: 3px solid #4e4e4e;">= Rp</td>
        <td style="border-bottom: 3px solid #4e4e4e;" align="right">{{ number_format($retribusi['sanksi_administrasi']) }}</td>
    </tr>
    <tr>
        <td align="center" colspan="2">Jumlah yang harus dibayarkan</td>
        <td>= Rp</td>
        <td align="right">{{ number_format($retribusi['harus_dibayarkan']) }}</td>
    </tr>
    <tr>
      <td colspan="2" align="center">
          <p><br/><br/><br/>Dihitung Petugas<br/><br/><br/><br/>
            {{ $identitas->petugas_teknis_imb }}<br/>
            NIP:{{ $identitas->nip_petugas_teknis_imb }}
          </p>
      </td>
      <td colspan="2" align="center">
          <p><br/><br/><br/>Diketauhi, <br/>Kepala Seksi IMB<br/><br/><br/><br/>
            {{ $identitas->kasie_imb }}<br/>
            NIP:{{ $identitas->nip_kasie_imb }}
          </p>
      </td>
    </tr>
</table>
</section>
</body>
</html>
{!! dd($rs) !!}
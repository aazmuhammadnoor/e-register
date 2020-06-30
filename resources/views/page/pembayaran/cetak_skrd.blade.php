<!DOCTYPE html>
<html>
<head>
	<title>SURAT KETETAPAN RETRIBUSI DAERAH</title>
	<style type="text/css">
		@if(isset($ispdf) && $ispdf == false)
        	@page { margin: 5px 15px; font-family:Arial, sans-serif;font-size:10px; size: A4 landscape}
        @else
        	@page { margin: 5px 15px; font-family:Arial, sans-serif;font-size:10px;}
        @endif
        body { margin: 5px 15px; font-family:Arial, sans-serif;font-size:10px;}
        p{font-family:Arial, sans-serif;font-size:10px;}
        #info, #bawah{
            font-family:Arial, sans-serif;font-size:10px;
        }
	</style>
  @if(isset($ispdf) && $ispdf == false)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  	<link rel="stylesheet" type="text/css" href="{{ asset('css/paper.min.css') }}">
  @endif
</head>
<body class="A4 landscape">
  <section class="sheet padding-10mm">
<table style="width: 49%;border:2px solid #4e4e4e;padding:4px;float:left;margin-right: 1px;" id="tabel">
	<tr>
		<td colspan="6" align="center">
		    <h4 style="font-family:Arial, sans-serif;font-size:11px;">SURAT KETETAPAN RETRIBUSI DAERAH<br/>IZIN MENDIRIKAN BANGUNAN</h4>
		    <p>Nomor : {{ $per->no_pendaftaran }}</p>
		    <hr/>
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->nama_pemohon }}</td>
		<td>Nomor Telepon</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->no_telepon }}</td>
	</tr>
	<tr>
		<td>Nomor Register</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->no_pendaftaran }}</td>
		<td>Tanggal masuk berkas</td>
		<td width="15" align="center">:</td>
		<td>{{ date_id($per->tgl_pendaftaran) }}</td>
	</tr>
	<tr>
		<td>Fungsi Bangunan</td>
		<td width="15" align="center">:</td>
		<td colspan="4">{{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
	</tr>
	<tr>
		<td>Lokasi</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Padukuhan {{ $per->lokasi_dukuh }} Kelurahan {{ $per->lokasi_kel }} Kecamatan {{ $per->lokasi_kec }}
		</td>
	</tr>
	<tr>
		<td>Status Hak atas tanah</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->getSertifikat()->first()->jenis }}</td>
		<td>Nomor</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->getSertifikat()->first()->nomor }}</td>
	</tr>
	<tr>
		<td>Luas Bangunan<br/>Dimintakan izin (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = {{ number_format($rs['luas']['luas_bangunan_lantai_Basement_1'], 2) }}
			Lantai 1 = {{ number_format($rs['luas']['luas_bangunan_lantai_1'], 2) }}
			Lantai 2 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 3 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 4 = {{ number_format($rs['luas']['luas_bangunan_lantai_4'], 2) }}
		</td>
	</tr>
	<tr>
		<td>Luas bangunan<br/>Melanggar Garis</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = 0.00 
			Lantai 1 = 0.00 
			Lantai 2 = 0.00 
			Lantai 3 = 0.00 
			Lantai 4 = 0.00 
		</td>
	</tr>
	<tr>
		<td>Luas bangunan<br/>Melanggar KDB (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">0.00 m<sup>2</sup></td>
	</tr>
	<tr>
		<td>Keseluruhan luas<br/>bangunan yang diizinkan (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = {{ number_format($rs['luas']['luas_bangunan_lantai_Basement_1'], 2) }}
			Lantai 1 = {{ number_format($rs['luas']['luas_bangunan_lantai_1'], 2) }}
			Lantai 2 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 3 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 4 = {{ number_format($rs['luas']['luas_bangunan_lantai_4'], 2) }}
		</td>
	</tr>
	<tr>
		<td colspan="6"><strong>Perhitungan retribusi</strong></td>
	</tr>
	<tr>
		<td>Indeks Kegiatan (IK)</td>
		<td width="15" align="center">:</td>
		<td colspan="2">{{ $rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['item']}}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'], 2) }}</td>
	</tr>
	<tr>
		<td>Indeks terintegrasi (It)</td>
		<td width="15" align="center">:</td>
		<td>1. Indeks Fungsi</td>
		<td> = {{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>2. Indeks Parameter</td>
		<td> = {{ $rs['Retribusi Bangunan Gedung']['data']['Parameter']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'], 2) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>3. Indeks Klasifikasi</td>
		<td>= Indek klasifikasi bangunan</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['indeks_integrasi'], 3) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>4. Indeks Waktu</td>
		<td>= {{ $rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'], 2) }}</td>
	</tr>
	<tr>
		<td align="right">It</td>
		<td width="15" align="center">:</td>
		<td> = 1 x 2 x 3 x 4</td> 
		<td> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }} {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'], 2) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['indeks_integrasi'], 3) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'], 2) }}
		</td>
		<td colspan="2">= 
			{{ number_format(($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'] * $rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'] * $rs['Retribusi Bangunan Gedung']['indeks_integrasi'] * $rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index']),3) }}
		</td>
	</tr>
	<tr>
		<td>Perhitungan retribusi<br/>bangunan gedung (a)</td>
		<td width="15" align="center">:</td>
		<td colspan="2">keseluruhan luas bangunan x ik x it x Rp. {{ number_format($rs['harga']['harga_retribusi']) }}
		</td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.{{ number_format($rs['Retribusi Bangunan Gedung']['retribusi_bangunan']) }} (a)</td>
	</tr>
	<tr>
		<td>Jumlah retribusi<br/>prasarana bangunan (b)</td>
		<td width="15" align="center">:</td>
		<td colspan="2"></td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.{{ number_format($rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan']) }} (b)</td>
	</tr>
	<tr>
		<td>Jumlah Administrasi (b)</td>
		<td width="15" align="center">:</td>
		<td colspan="2"></td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.0.00</td>
	</tr>
	<tr>
		<td>Retribusi IMB<br/>yang harus dibayar (a + b + c)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Rp.{{ number_format($rs['Retribusi Bangunan Gedung']['retribusi_bangunan']) }} + Rp.{{ number_format($rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan']) }} + Rp.0.00
		</td>
	</tr>
	<tr>
		<td align="right">Total</td>
		<td width="15" align="center">:</td>
		<td colspan="4">Rp.{{ number_format(($rs['Retribusi Bangunan Gedung']['retribusi_bangunan'] + $rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan'])) }}</td>
	</tr>
	<tr>
		<td align="right">Terbilang</td>
		<td width="15" align="center">:</td>
		<td colspan="4">{{ $bilang->conversiAngka(($rs['Retribusi Bangunan Gedung']['retribusi_bangunan'] + $rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan'])) }}</td>
	</tr>
	<tr>
		<td colspan="6">
			Surat ketetapan retribusi ini ditetapkan sesuai data yang disampaikan pemohon, dan paling lambat dibayarkan 30 hari ) tiga puluh ) hari setelah tanggal ditetapkan, serta apabila ada data baru atau data yang semula belum terungkap yang menyebabkan penambahan atau pengurangan jumlah retribusi yang harus dibayar, maka akan dikeluarkan SKRDLB (Surat Ketetapan Retribusi Daerah Lebih Bayar)<br/><br/>
			Pembayaran dapat melalui BPD DIY dengan nomor Rekening Kas Daerah 005.111.000059
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="bottom" align="left">
			Lembar 1 Untuk Pemohon<br/>
			Lembar 2 Untuk DPPMPT
		</td>
		<td align="center" colspan="3">
			Sleman, @if(!is_null($per->getRetribusi->tgl_skrd))
				{{ date_day($per->getRetribusi->tgl_skrd) }}
			@else
				___________________
				<!--<a href="{{ url('perizinan/pembayaran',['penetapan-skrd',$per->getRetribusi->id]) }}">Tetapkan Tanggal SKRD</a>-->
			@endif
			<br/>
			a.n Kepala DPPMTP Kabupaten Sleman<br/>
			Sekretaris<br/>
			u.b<br/>
			Kepala Bidang Perizinan Dan Pemanfaatan Ruang<br/><br/><br/><br/>

			<u>{{ $identitas->kabid_pemanfaatan_ruang }}<br/>
				{{ $identitas->nip_kabid_pemanfaatan_ruang }}</u>
		</td>
	</tr>
</table>
<table style="width: 49%;border:2px solid #4e4e4e;padding:4px;float:left;" id="tabel">
	<tr>
		<td colspan="6" align="center">
		    <h4 style="font-family:Arial, sans-serif;font-size:11px;">SURAT KETETAPAN RETRIBUSI DAERAH<br/>IZIN MENDIRIKAN BANGUNAN</h4>
		    <p>Nomor : {{ $per->no_pendaftaran }}</p>
		    <hr/>
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->nama_pemohon }}</td>
		<td>Nomor Telepon</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->no_telepon }}</td>
	</tr>
	<tr>
		<td>Nomor Register</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->no_pendaftaran }}</td>
		<td>Tanggal masuk berkas</td>
		<td width="15" align="center">:</td>
		<td>{{ date_id($per->tgl_pendaftaran) }}</td>
	</tr>
	<tr>
		<td>Fungsi Bangunan</td>
		<td width="15" align="center">:</td>
		<td colspan="4">{{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
	</tr>
	<tr>
		<td>Lokasi</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Padukuhan {{ $per->lokasi_dukuh }} Kelurahan {{ $per->lokasi_kel }} Kecamatan {{ $per->lokasi_kec }}
		</td>
	</tr>
	<tr>
		<td>Status Hak atas tanah</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->getSertifikat()->first()->jenis }}</td>
		<td>Nomor</td>
		<td width="15" align="center">:</td>
		<td>{{ $per->getSertifikat()->first()->nomor }}</td>
	</tr>
	<tr>
		<td>Luas Bangunan<br/>Dimintakan izin (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = {{ number_format($rs['luas']['luas_bangunan_lantai_Basement_1'], 2) }}
			Lantai 1 = {{ number_format($rs['luas']['luas_bangunan_lantai_1'], 2) }}
			Lantai 2 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 3 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 4 = {{ number_format($rs['luas']['luas_bangunan_lantai_4'], 2) }}
		</td>
	</tr>
	<tr>
		<td>Luas bangunan<br/>Melanggar Garis</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = 0.00 
			Lantai 1 = 0.00 
			Lantai 2 = 0.00 
			Lantai 3 = 0.00 
			Lantai 4 = 0.00 
		</td>
	</tr>
	<tr>
		<td>Luas bangunan<br/>Melanggar KDB (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">0.00 m<sup>2</sup></td>
	</tr>
	<tr>
		<td>Keseluruhan luas<br/>bangunan yang diizinkan (m<sup>2</sup>)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Basement = {{ number_format($rs['luas']['luas_bangunan_lantai_Basement_1'], 2) }}
			Lantai 1 = {{ number_format($rs['luas']['luas_bangunan_lantai_1'], 2) }}
			Lantai 2 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 3 = {{ number_format($rs['luas']['luas_bangunan_lantai_3'], 2) }}
			Lantai 4 = {{ number_format($rs['luas']['luas_bangunan_lantai_4'], 2) }}
		</td>
	</tr>
	<tr>
		<td colspan="6"><strong>Perhitungan retribusi</strong></td>
	</tr>
	<tr>
		<td>Indeks Kegiatan (IK)</td>
		<td width="15" align="center">:</td>
		<td colspan="2">{{ $rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['item']}}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Kegiatan']['index'], 2) }}</td>
	</tr>
	<tr>
		<td>Indeks terintegrasi (It)</td>
		<td width="15" align="center">:</td>
		<td>1. Indeks Fungsi</td>
		<td> = {{ $rs['Retribusi Bangunan Gedung']['data']['Fungsi']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>2. Indeks Parameter</td>
		<td> = {{ $rs['Retribusi Bangunan Gedung']['data']['Parameter']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'], 2) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>3. Indeks Klasifikasi</td>
		<td>= Indek klasifikasi bangunan</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['indeks_integrasi'], 3) }}</td>
	</tr>
	<tr>
		<td></td>
		<td width="15" align="center"></td>
		<td>4. Indeks Waktu</td>
		<td>= {{ $rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['item'] }}</td>
		<td colspan="2"> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'], 2) }}</td>
	</tr>
	<tr>
		<td align="right">It</td>
		<td width="15" align="center">:</td>
		<td> = 1 x 2 x 3 x 4</td> 
		<td> = {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'], 2) }} {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'], 2) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['indeks_integrasi'], 3) }} x {{ number_format($rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index'], 2) }}
		</td>
		<td colspan="2">= 
			{{ number_format(($rs['Retribusi Bangunan Gedung']['data']['Fungsi']['index'] * $rs['Retribusi Bangunan Gedung']['data']['Parameter']['index'] * $rs['Retribusi Bangunan Gedung']['indeks_integrasi'] * $rs['Retribusi Bangunan Gedung']['data']['Waktu Penggunaan']['index']),3) }}
		</td>
	</tr>
	<tr>
		<td>Perhitungan retribusi<br/>bangunan gedung (a)</td>
		<td width="15" align="center">:</td>
		<td colspan="2">keseluruhan luas bangunan x ik x it x Rp. {{ number_format($rs['harga']['harga_retribusi']) }}
		</td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.{{ number_format($rs['Retribusi Bangunan Gedung']['retribusi_bangunan']) }} (a)</td>
	</tr>
	<tr>
		<td>Jumlah retribusi<br/>prasarana bangunan (b)</td>
		<td width="15" align="center">:</td>
		<td colspan="2"></td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.{{ number_format($rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan']) }} (b)</td>
	</tr>
	<tr>
		<td>Jumlah Administrasi (b)</td>
		<td width="15" align="center">:</td>
		<td colspan="2"></td>
		<td width="15" align="center">=</td>
		<td align="left">Rp.0.00</td>
	</tr>
	<tr>
		<td>Retribusi IMB<br/>yang harus dibayar (a + b + c)</td>
		<td width="15" align="center">:</td>
		<td colspan="4">
			Rp.{{ number_format($rs['Retribusi Bangunan Gedung']['retribusi_bangunan']) }} + Rp.{{ number_format($rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan']) }} + Rp.0.00
		</td>
	</tr>
	<tr>
		<td align="right">Total</td>
		<td width="15" align="center">:</td>
		<td colspan="4">Rp.{{ number_format(($rs['Retribusi Bangunan Gedung']['retribusi_bangunan'] + $rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan'])) }}</td>
	</tr>
	<tr>
		<td align="right">Terbilang</td>
		<td width="15" align="center">:</td>
		<td colspan="4">{{ $bilang->conversiAngka(($rs['Retribusi Bangunan Gedung']['retribusi_bangunan'] + $rs['Retribusi Prasarana Bangunan Gedung']['retribusi_prasarana_bangunan'])) }}</td>
	</tr>
	<tr>
		<td colspan="6">
			Surat ketetapan retribusi ini ditetapkan sesuai data yang disampaikan pemohon, dan paling lambat dibayarkan 30 hari ) tiga puluh ) hari setelah tanggal ditetapkan, serta apabila ada data baru atau data yang semula belum terungkap yang menyebabkan penambahan atau pengurangan jumlah retribusi yang harus dibayar, maka akan dikeluarkan SKRDLB (Surat Ketetapan Retribusi Daerah Lebih Bayar)<br/><br/>
			Pembayaran dapat melalui BPD DIY dengan nomor Rekening Kas Daerah 005.111.000059
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="bottom" align="left">
			Lembar 1 Untuk Pemohon<br/>
			Lembar 2 Untuk DPPMPT
		</td>
		<td align="center" colspan="3">
			Sleman, @if(!is_null($per->getRetribusi->tgl_skrd))
				{{ date_day($per->getRetribusi->tgl_skrd) }}
			@else
				___________________
				<!--<a href="{{ url('perizinan/pembayaran',['penetapan-skrd',$per->getRetribusi->id]) }}">Tetapkan Tanggal SKRD</a>-->
			@endif
			<br/>
			a.n Kepala DPPMTP Kabupaten Sleman<br/>
			Sekretaris<br/>
			u.b<br/>
			Kepala Bidang Perizinan Dan Pemanfaatan Ruang<br/><br/><br/><br/>

			<u>{{ $identitas->kabid_pemanfaatan_ruang }}<br/>
				{{ $identitas->nip_kabid_pemanfaatan_ruang }}</u>
		</td>
	</tr>
</table>
</section>
</body>
</html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SURAT PERITAH MEMBAYAR - {{ $per->getIzin->nama }} - {{ $per->no_pendaftaran_sementara }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>
      @page { size: A4 }
      #kop{
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 4px solid #4e4e4e;
        display: flex;
      }

      h1,h2,p{
        margin:0px;
        padding:0px;
      }

      h2{
        font-size:17px;
      }
      h1{
        font-size: 19px;
      }

      #logo img{
        width: 79px;
        height: auto;
      }

      #kop #header{
        text-align: center;
      }

      #body, .lampiran{
        font-size: 13px;
      }

      table.table, table.table th, table.table td
      {
        border-collapse:collapse;
        border: 1px solid black;
      }
      table.table th, table.table td{
        padding:4px;
      }

      .text-right{
        text-align: right !important;
      }

      .text-center{
        text-align: center !important;
      }

      #footer{
        margin-top:45px;
        display: flex;
        justify-content:flex-end
      }

      #footer .ttd{
        text-align: center;
      }

      .lampiran-header{
        display: flex;
        margin-bottom: 20px;
      }

      .kop-kiri, .kop-kanan{
        width: 50%;
        padding:6px;
        border:1px solid #4e4e4e;
      }

      .kop-kanan{
        padding:20px;
        border-left:none;
      }

      .small{
        font-size: 12px;
      }

      .lampiran-footer{
        display: flex;
        margin-top:20px;
        justify-content:center;
        margin-bottom: 20px;
      }

      .lampiran-footer div{
        width:33%;
        text-align: center;
        font-size: 11px;
        padding:4px;
      }
    </style>
  </head>
  <body class="A4" onload="return window.print();">
    @if(!isset($user))
      <section class="sheet padding-10mm">
      <div id="kop">
        <div id="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Lambang_Kota_Palembang.gif"/>
        </div>
        <div id="header">
            <h2> PEMERINTAH KOTA PALEMBANG</h2>
            <h1>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<br/>SATU PINTU</h1>
            <p>Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang, Provinsi Sumatra Selatan Telp. (0711) 370679, 370681 Palembang</p>
        </div>
      </div>
      <div id="body">
          <table>
              <tr>
                <td width="65%"></td>
                <td width="30"></td>
                <td>Palembang, {{ date_id(date('Y-m-d')) }}<br/><br/></td>
              </tr>
              <tr>
                <td valign="top">
                  <table>
                    <tr>
                        <td width="60">Nomor</td>
                        <td>: {{ $ret->no_spm }}</td>
                    </tr>
                    <tr>
                        <td width="60">Perihal</td>
                        <td>: Pemberitahuan Retribusi Perijinan</td>
                    </tr>
                    <tr>
                        <td width="60">Lampiran</td>
                        <td>: Slip Setoran Pembayaran Retribusi</td>
                    </tr>
                  </table>
                </td>
                <td valign="top">Yth<br/><br/><br/>di</td>
                <td valign="top">
                    Kepada<br/>{{ strtoupper($per->getPemohon->nama) }}<br/><br/>
                    {{ strtoupper($per->getPemohon->alamat) }} RT {{ $per->getPemohon ? $per->getPemohon->rt : '' }} RW {{ $per->getPemohon ? $per->getPemohon->rw : '' }} KELURAHAN {{ strtoupper($per->getPemohon->getKelurahan->name) }}
                    KECAMATAN {{ $per->getPemohon ? $per->getPemohon->getKecamatan->name : '' }}
                </td>
              </tr>
          </table>
          <br/><br/><br/>
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menunjuk surat permohonan ijin saudara tanggal {{ date_id($per->tgl_penerimaan) }}, bersama ini kami beritahukan bahwa retribusi yang harus saudara bayar sebesar :</p>
          <br/></br/>
          @include('admin.proses.partial.spm')
          <br/>
          <p>
            <strong>Catatan :</strong><br/>
            <ol>
              <li>Pembayaran dilakukan di loket pembayaran Kantor Kas Bank sumselbabel Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Kota Palembang Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang pada jam kerja dengan nomor rekening <strong>150.300.0001</strong> a.n PEMKOT PALEMBANG, selambat-lambatnya <strong>3 (tiga) bulan</strong> sejak diterbitkanya Surat Pemberitahuan Retribusi.</li>
              <li>Apabila Melebihi waktu <strong>3 (tiga) bulan</strong> sejak diterbitkanya Surat Pemberitahuan Retribusi belum melakukan pembayaran, maka permohonan perijinan dibatalkan dan dapat melakukan pendaftaran kembali.</li>
            </ol>
          </p>
          <div id="footer">
            <div></div>
            <div class="ttd">
              <p>KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<BR/>SATU PINTU</p>
              <br/><br/><br/>
              <p><strong>{{ $identitas->kepala_dinas }}</strong><br/>Pembina Tingkat I<br/>NIP {{ $identitas->nip_kepala_dinas }}</p>
            </div>
          </div>
      </div>
    </section>
    @endif
    <section class="sheet padding-10mm">
      @for($i=0; $i<=1; $i++)
      <div class="lampiran-body">
        <div class="lampiran lampiran-header">
          <div class="kop-kiri">
            <p class="text-center small">
              PEMERINTAH KOTA PALEMBANG<br/>
              DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<br/>
              SATU PINTU
            </p>
            <p class="text-center">Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang, Provinsi Sumatra Selatan Kode Pos 30267</p>
          </div>
          <div class="kop-kanan">
            <p class="text-center"><b>SLIP SETORAN PEMBAYARAN RETRIBUSI</b></p>
            <strong>
              <table>
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $ret->no_spm }}</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>: {{ date('Y') }} Bulan : {{ month_id(date('m')) }}</td>
                </tr>
              </table>
            </strong>
          </div>
        </div>
        <div class="lampiran">
          <table width="90%">
              <tr>
                  <td width="100" valign="top">Nama Pemohon</td>
                  <td width="10" valign="top">:</td>
                  <td valign="top"><b>{{ strtoupper($per->getPemohon->nama) }}</b></td>
              </tr>
              <tr>
                  <td valign="top">Alamat</td>
                  <td valign="top">:</td>
                  <td valign="top"><b>{{ strtoupper($per->getPemohon->alamat) }} RT {{ $per->getPemohon ? $per->getPemohon->rt : '' }} RW {{ $per->getPemohon ? $per->getPemohon->rw : '' }} KELURAHAN {{ strtoupper($per->getPemohon->getKelurahan->name) }}
                  KECAMATAN {{ $per->getPemohon ? $per->getPemohon->getKecamatan->name : '' }}</b></td>
              </tr>
              <tr>
                  <td width="100" valign="top">Nama Usaha</td>
                  <td width="10" valign="top">:</td>
                  <td valign="top"><b>-</b></td>
              </tr>
          </table>
          @include('admin.proses.partial.spm')
        </div>
        <div class="lampiran lampiran-footer">
          <div><p>PETUGAS PENERIMA BANK SUMSEL<BR/>(TELLER)</p><br/><br/><br/><br/><hr/></div>
          <div><p>PEMOHON</p><br/><br/><br/><br/><br/><hr/></div>
          <div class="text-center">
            <p>KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<BR/>SATU PINTU</p>
            <br/><br/><br/>
            <p><strong>{{ $identitas->kepala_dinas }}</strong><br/>Pembina Tingkat I<br/>NIP {{ $identitas->nip_kepala_dinas }}</p>
          </div>
        </div>
      </div>
      @if($i==0)<hr/><br/></br> @endif
      @endfor
    </section>
  </body>
</html>

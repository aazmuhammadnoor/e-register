<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SURAT PERITAH MEMBAYAR</title>
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
        width: 59px;
        height: auto;
        float:left;
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
    <section class="sheet padding-10mm">
      <div class="lampiran-body">
        <div class="lampiran lampiran-header">
          <div class="kop-kiri">
            <div id="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Lambang_Kota_Palembang.gif"/>
            </div>
            <p class="text-center small">
              <b>PEMERINTAH KOTA PALEMBANG<br/>
              DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<br/>
              SATU PINTU</b>
            </p>
            <p class="text-center">Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang, Provinsi Sumatra Selatan Kode Pos 30267</p>
          </div>
          <div class="kop-kanan">
            <p class="text-center"><b>S K R D</b><br/>(Surat Ketetapan Retribusi Daerah)</p>

            <strong>
              <table width="100%">
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $ret->no_skrd }}</td>
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
                  <td valign="top"><b>{{ $per->izin != 139 ? 'BRT/PERUMAHAN MBR' : '-' }}</b></td>
              </tr>
          </table>
          @include('admin.proses.partial.spm')
        </div>
        <div class="lampiran lampiran-footer">
          <div></div>
          <div></div>
          <div class="text-center">
            <p>KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<BR/>SATU PINTU</p>
            <br/><br/><br/>
            <p><strong>{{ $identitas->kepala_dinas }}</strong><br/>Pembina Tingkat I<br/>NIP {{ $identitas->nip_kepala_dinas }}</p>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

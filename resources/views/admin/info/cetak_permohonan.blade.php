<!DOCTYPE html>
<html>
<head>
    <title>Cetak Timeline</title>
    <meta charset="utf-8">
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

      table, table th, table td
      {
        width: 100%;
        border-collapse:collapse;border: 1px solid #e0e0e0;
        font-size: 12px !important;
        margin: 10px 15px 10px 15px;
        font-family: 'Calibri' !important;
      }
      table th, table td{
        padding:4px;
      }

      table.bordered, table.bordered th, table.bordered td{
        width: 100%;
        border: 1px solid black;
      }

      table{
        margin-bottom: 10px;
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
      .content{
        max-width: 90% !important;
        font-size: 12px !important;
        margin: 10px 15px 10px 15px;
        font-family: 'Calibri' !important;
      }
      .divider{
        font-size: 16px;
        font-weight: bold;
      }
      body{
        background-color: #FFF !important;
      }
    </style>
</head>
<body class="A4">
    <section class="sheet">
        <div id="kop">
            <img src="{!! url("uploads/".$identitas->kop_surat) !!}" width="95%" />
        </div>
        <div class="content">
            <table class="bordered table-dot table-sm">
                <tr>
                    <td width="200">Permohonan</td>
                    <td>: {{ $per->getIzin ? $per->getIzin->nama : "N/A" }}</td>
                </tr>
                <tr>
                    <td>Nomor Pendaftaran</td>
                    <td>: {{ str_replace("SEM-","",$per->no_pendaftaran_sementara) }}</td>
                </tr>
                @include('admin.info.partial.executor')
            </table>
            <div class="divider text-primary">DATA PEMOHON</div>
            @include('admin.info.partial.data_pemohon')

            @include($permohonan_profile)

            <div class="divider text-primary">LOKASI PERIZINAN</div>
            <table class="table-dot table-sm">
                <tr>
                    <td width="200">Lokasi Perizinan</td>
                    <td>: {{ $per->alamat_permohonan }}, {{ $per->lokasi_kel }}, {{ $per->lokasi_kec }}, Kota Palembang</td>
                </tr>
                <tr>
                    <td>Koordinat Lokasi Perizinan</td>
                    <td>: {{ $per->koordinat }}</td>
                </tr>
            </table>

            <div class="divider text-primary">DATA PERMOHONAN</div>
            <table class="table-dot table-sm">
                @foreach($meta as $key=>$val)
                    <tr>
                        <td width="200">{{ title_case(str_replace("_"," ",$key)) }}</td>
                        <td>:
                            @if(is_array($val))
                                {{ join($val,",") }}
                            @else
                                {{ $val }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            @include('admin.info.partial.spm')
            <div class="divider text-primary">HISTORI CATATAN</div>
            <table class="table-dot table-sm">
                @include('admin.info.partial.data_catatan')
            </table>
        </div>
    </section>
</body>
</html>

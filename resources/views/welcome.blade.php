@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
<main>
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:left;">
            <img src="{{ asset('themes/img/logo-publik.png') }}">
            <h1 class="header-title" style="display: block;">
                <strong class="hidden-sm-down">{{ $identitas->singkatan_instansi }}</strong>
                <small>{{ $identitas->nama_aplikasi }}<br/>{{ $identitas->instansi }}</small>
            </h1>
        </div>
    </header>
    @include('publik.pengumuman.default')
    <div class="main-content" id="home-main-content">
        <div class="d-flex flex-row flex-wrap align-items-stretch">
            <div class="col-12 col-md-4">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">DAFTAR ONLINE</h4>
                    <h1 class="text-center"><span class="icon ti-pencil-alt text-info"></span></h1>
                    <p class="text-center">
                        <code>Capek menunggu antrian ?</code>
                        lakukan pendaftaran secara online <strong>sekarang</strong>
                    </p>
                    <p class="text-center">
                        <a href="{{ url('anggota/daftar') }}" class="btn btn-outline btn-info">Pendaftaran</a>
                        <a href="#" class="btn btn-outline btn-info" data-toggle="modal" data-target="#InformasiPendaftaran"><span class="icon ti-help"></span></a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">CEK STATUS</h4>
                    <h1 class="text-center"><span class="icon ti-search text-success"></span></h1>
                    <p class="text-center">
                        Dapatkan <code>informasi terkini</code> status pengajuan permohonan anda
                    </p>
                    <p class="text-center">
                        <a href="{{ url('anggota/login') }}" class="btn btn-outline btn-success">Cek Status</a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">PENGADUAN</h4>
                    <h1 class="text-center"><span class="icon ti-comments text-warning"></span></h1>
                    <p class="text-center">
                        Anda memiliki <code>Keluhan atau Aduan? </code> informasikan kepada kami.
                    </p>
                    <p class="text-center">
                        <a href="#" class="btn btn-outline btn-warning">Pengaduan</a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">SYARAT</h4>
                    <h1 class="text-center"><span class="icon ti-file text-danger"></span></h1>
                    <p class="text-center">
                        Lihat informasi mengenahi <code>Persyaratan </code> sebelum anda mengajukan permohonan
                    </p>
                    <p class="text-center">
                        <a href="{{ url('publik/syarat') }}" class="btn btn-outline btn-danger">Syarat</a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">PETUNJUK</h4>
                    <h1 class="text-center"><span class="icon ti-file text-purple"></span></h1>
                    <p class="text-center">
                        Lihat dan pelajari <code>Bantuan & Tutorial </code> agar mempermudah anda pada saat mengajukan permohonan
                    </p>
                    <p class="text-center">
                        <a href="{{ url('publik/bantuan') }}" class="btn btn-outline btn-purple">Petunjuk Pendaftaran</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-middle">
            <div class="col-12 col-md-8">
                <video width="100%" controls class="p-3">
                  <source src="{{ url('source_tutorial', 'tutorial_1.webm') }}" type="video/mp4">
                  Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="col-md-4 align-items-middle p-3">
                <h4 class="text-primary"><b>Petunjuk Pendaftaran</b></h4>
                <p>Video petunjuk pendaftaran pengajuan permohonan secara online</p>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <h4 class="card-title"><strong>CEK PENDAFTARAN</strong></h4>
                <div class="card-body">
                    <div class="input-group">
                        {!! Form::text('keyword',old('keyword'),['id'=>'keyword-cek','class'=>'form-control','required','placeholder'=>'NO PENDAFTARAN / NIK / EMAIL'])!!}
                        <span class="input-group-btn">
                            <button class="btn btn-light" type="button" id="cek-pendaftaran" data-toggle="modal" data-target="#cekModals">PERIKSA</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="col-lg-4 col-sm-12">
            <a href="#" class="btn btn-label btn-dark btn-block" target="_blank" style="border-radius:0px">
                <label><i class="ti-android fs-20"></i></label>
                Download Aplikasi Perizinan
            </a>
            <div class="card card-inverse card-info">
                <div class="card-body">
                    <small class="text-muted">Callcenter Perizinan</small>
                    <p class="text-left callcenter"><i class="ti-headphone-alt"></i>  (9999) 999999</p>
                </div>
            </div>
        </div>-->
        <div class="col-lg-4 col-sm-12">
            <div class="card card-body ">
                <h6 class="text-uppercase">Pengunjung Website<br/><small>Sejak Tanggal 1 Januari 2018</small></h6>
                <div class="flexbox mt-2">
                    <span class="ti-world fs-30"></span>
                    <span class="fs-30">{{ \Visitor::count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <table class="table table-striped table-hover">
                    <!--
                    <tr>
                        <td class="align-middle">
                            <a href="{{ url('publik/simulasi') }}"><i class="ti-wallet fs-20 mr-10"></i> Simulasi Perhitungan Retribusi</a>
                        </td>
                    </tr>-->
                    <tr>
                        <td><a href="{{ url('publik/statistik') }}"><i class="ti-bar-chart-alt fs-20 mr-10"></i> Statistik Perizinan</a></td>
                    </tr>
                    <tr>
                        <td><a href="#/"><i class="ti-direction-alt fs-20 mr-10"></i> DPMPTSP Kota Palembang</a></td>
                    </tr>
                    <!--
                    <tr>
                        <td><a href="#"><i class="ti-world fs-20 mr-10"></i> Diskominfo Kota Palembang</a></td>
                    </tr>-->
                </table>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>

<!-- Modal -->
<div class="modal modal-center fade" id="pendaftaran" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span class="icon ti-pencil-alt"></span> Pendaftaran</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form-type-material" method="POST" action="">
        {{ csrf_field() }}
        <div class="modal-body px-30">
            <div class="form-group">
              <input type="text" class="form-control" name="username">
              <label for="username">Username</label>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="email">
              <label for="email">Alamat Email</label>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password">
              <label for="password">Password</label>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password-conf">
              <label for="password-conf">Konfirmasi Password</label>
            </div>
        </div>
        <div class="modal-footer p-30">
            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Daftar</button>
            <button class="btn btn-label btn-danger" data-dismiss="modal"><label><i class="ti-close"></i></label> Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="InformasiPendaftaran" tabindex="-1" role="dialog" aria-labelledby="InformasiPendaftaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InformasiPendaftaranLabel">Informasi Pendaftaran Online</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <b>
                <p>Petunjuk Pengisian</p>
                <p>Pendaftaran Permohonan Izin Online</p>
                <p>Dinas Penanaman Modal dan Pelayanan Perizinan Kota Palembang</p>
            </b>
        </center>
        <ol>
            <li>
                Masuk ke menu “DAFTAR ONLINE” dengan klik tombol “Pendaftaran”<br>
                <img src="{{ asset('themes/img/1.png') }}" style="border: 2px solid #F7F7F7;">
            </li>
            <li>
                Pilih Perizinan
                <ol type="a" style="margin-left: -20px;">
                    <li>Bila ingin mengetahui informasi masing-masing izin terlebih dahulu, klik “Lihat Informasi”</li>
                    <li>Pilih Jenis Perizinan yang akan diajukan</li>
                    <li>Klik “Proses Selanjutnya”</li>
                </ol>
                <img src="{{ asset('themes/img/2.png') }}" style="border: 2px solid #F7F7F7;">
            </li>
            <li>
                Input Data
                <ol type="a" style="margin-left: -20px;">
                    <li>Isi data dengan lengkap dan benar</li>
                    <li>Kolom dengan tanda bintang merah tidak boleh kosong, bila tidak ada isian maka dapat diisi – (strip)</li>
                    <li>Kolom “Telepon Pemohon / Kuasa” harap diisi dengan nomor telepon valid karena pemberitahuan status melalui sms akan dikirimkan ke nomor tersebut.</li>
                    <li>Pastikan isian data sudah benar kemudian klik “Simpan dan Proses”</li>
                </ol>
                <img src="{{ asset('themes/img/3.png') }}" style="border: 2px solid #F7F7F7;">
            </li>
            <li>
                Upload Dokumen
                <ol type="a" style="margin-left: -20px;">
                    <li>Upload file dokumen persyaratan dengan format JPG, PNG atau PDF dengan kapasitas file maks. 5 Mb</li>
                    <li>Klik “Upload dan Proses”</li>
                </ol>
                <img src="{{ asset('themes/img/4.png') }}" style="border: 2px solid #F7F7F7;">
            </li>
            <li>
                Cetak Bukti Penerimaan (BP) Sementara
                <ol type="a" style="margin-left: -20px;">
                    <li>BP Sementara digunakan untuk pengambilan Surat Keputusan (SK) dengan membawa berkas upload hardcopy bila file persyaratan sebelumnya telah diupload dan tidak kurang syarat. <br>Pemberitahuan status akan dikirim melalui sms.</li>
                    <li>BP Sementara agar dibawa ke DPMPPT Kota Palembang untuk diganti menjadi BP Tetap dengan membawa Form Blangko yang telah diisi berserta berkas persyaratan bila file persyaratan sebelumnya tidak diupload / telah diupload tetapi kurang syarat. BP Tetap digunakan untuk pengambilan Surat Keputusan (SK). <br>Pemberitahuan status akan dikirim melalui sms.</li>
                </ol>
                <img src="{{ asset('themes/img/5.png') }}" style="border: 2px solid #F7F7F7;">
            </li>
        </ol>
        <a href="{{ asset('uploads/pedoman-pendaftaran-online.pdf') }}" class="btn btn-sm btn-info">Download</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cekModals" tabindex="-1" role="dialog" aria-labelledby="cekModalsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="cekModalsLabel">Cek Pendaftaran Permohonan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    function status_cek() {
            $.ajax({
                url : '{{ url('ajax/onload') }}/',
                type : 'get',
                error : function(xhr){
                    console.log(xhr);
                },
                success : function(xhr){
                }
            })
    }
    $(document).on("click","#cek-pendaftaran",function(e){
        var keyword = $("#keyword-cek").val();
        var content = ``;
        if(keyword == null || keyword == ''){
            content = `<h3 class="text-center">Kata pencarian tidak boleh kosong !</h3>`;
            $(".modal-body").html(content);
        }else{
            $.ajax({
                url : '{{ url('publik/cek_pendaftaran') }}/'+keyword,
                type : 'get',
                beforeSend : function(xhr){
                    $(".modal-body").html('');
                    content = `<h5 class="text-center p-3">Sedang Memproses ...</h5>`;
                    $(".modal-body").html(content);
                },
                error : function(xhr){
                    $(".modal-body").html('');
                    content = `<h5 class="text-center p-3">Gagal Memproses. Harap Coba Lagi</h5>`;
                    $(".modal-body").html(content);
                },
                success : function(xhr){
                    $(".modal-body").html('');
                    if(xhr.ada){
                        content = `<table class="table table-borderless" style="font-size : 16px!important">
                                        <tr>
                                            <th width="30%">Nomor Pendaftaran</th>
                                            <td>: ${xhr.nomor_pendaftaran}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: ${xhr.nama}</td>
                                        </tr>
                                        <tr>
                                            <th>Permohonan Izin</th>
                                            <td>: ${xhr.izin}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Izin</th>
                                            <td>: ${xhr.jenis_izin}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pendaftaran</th>
                                            <td>: ${xhr.tgl_pendaftaran}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>: ${xhr.status}</td>
                                        </tr>
                                    </table>
                                    `;
                    }else{
                        content = `<h5 class="text-center p-3">Data tidak ditemukan, periksa kembali Nomor Pendaftaran, NIK, atau Email Anda</h5>`;
                    }
                    $(".modal-body").html(content);
                }
            })
        }
    });
    $("#cetak-ulang").click(function(){
        var keyword = $("#keyword-cetak").val();
        if(keyword == ''){
            $.alert({
                title: 'Perhatian!',
                content: 'Masukan No Pendaftaran Atau NIK Atau No Handphone untuk mencetak ulang bukti pendaftaran',
            });
        }else{

            $.confirm({
                title: 'Cetak Ulang Bukti Pendaftaran Sementara',
                content: 'url:{{ url('publik/pendaftaran/cetak-ulang-bukti-pendaftaran') }}?keyword='+keyword+'',
                columnClass: 'large',
                buttons: {
                    tutup: function () {}
                }
            });
        }
    });
</script>
@endsection

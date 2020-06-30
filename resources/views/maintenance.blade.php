{{-- @extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content') --}}
<center>
    <div>
        <h2 class="text-center">SEDANG DALAM PROSES PERBAIKAN</h2>
    </div>
    @include('layouts.footer')
</center>
{{-- 
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
</div> --}}
{{-- 
<!-- Modal -->
<div class="modal modal-center fade" id="login" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span class="icon ti-unlock"></span> Login</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-type-material" method="POST" action="">
            {{ csrf_field() }}
            <div class="modal-body px-30">
                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                  <input type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus/>
                  <label for="username">Username</label>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <input type="password" class="form-control" id="password" name="password">
                  <label for="password">Password</label>
                </div>
                <div class="form-group flexbox">
                  <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Ingat Saya</span>
                  </label>
                  <a class="text-muted hover-primary fs-13" href="{{ route('password.request') }}">Lupa password?</a>
                </div>
            </div>
            <div class="modal-footer p-30">
                <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Login</button>
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
@endsection --}}

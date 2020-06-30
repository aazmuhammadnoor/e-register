@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong><br/>
                <small>DETAIL PERMOHONAN</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <div class="card card-body" data-provide="wizard">
                    <ul class="nav nav-process nav-process-circle hidden-sm-down">
                        <li class="nav-item complete">
                            <span class="nav-title">PILIH PERIZINAN</span>
                            <a href="#jenis-izin" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item complete">
                            <span class="nav-title">INPUT DATA</span>
                            <a href="#input-data" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item complete">
                            <span class="nav-title">UPLOAD DOKUMEN</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item active processing">
                            <span class="nav-title">REVIEW</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab" aria-expanded="true"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">BUKTI PENDAFTARAN</span>
                            <a href="#cetak-bukti-daftar" class="nav-link" data-toggle="tab"></a>
                        </li>
                    </ul>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMOHON</div>
                        </div>
                        <div class='col-md-8'>
                            @include('anggota.partial.data_diri')
                        </div>
                        <div class="col-md-4">
                            <img src="{{ url('storage', [$per->getPendaftar->pas_foto]) }}" class="img-thumbnail mx-auto" style="width: 151px !important">
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERUSAHAAN</div>
                        </div>
                        <div class="col-md-12">
                            @include('anggota.partial.per_perusahaan')
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>LOKASI PERIZINAN</div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td width="30%">KECAMATAN</td>
                                    <td>: {{ $per->lokasi_kec }}</td>
                                </tr>
                                <tr>
                                    <td>KELURAHAN</td>
                                    <td>: {{ $per->lokasi_kel }}</td>
                                </tr>
                                <tr>
                                    <td>RT</td>
                                    <td>: {{ $per->lokasi_rt }}</td>
                                </tr>
                                <tr>
                                    <td>RW</td>
                                    <td>: {{ $per->lokasi_rw }}</td>
                                </tr>
                                <tr>
                                    <td>ALAMAT</td>
                                    <td>: {{ $per->alamat_permohonan }}</td>
                                </tr>
                                <tr>
                                    <td>KOORDINAT</td>
                                    <td>: {{ $per->permohonan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                            @foreach($meta as $key=>$val)
                                <tr>
                                    <td width="40%">{{ title_case(str_replace("_"," ",$key)) }}</td>
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
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERSYARATAN</div>
                        </div>
                        {!! $form !!}
                        <div class="col-12 row">
                            <footer class="col-12">
                                <a href="{{ url('permohonan/selesai',[$token]) }}" class="btn btn-primary">Lanjutkan Proses</a>
                                <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
                                <a href="#!" class="btn btn-danger float-right" id="batal-frm-pendaftaran">Batal</a>
                            </footer>
                        </div>
                    </div>

                </div>                
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
<script type="text/javascript">
        $("#batal-frm-pendaftaran").click(function(){
            $.confirm({
                title: 'Konfirmasi',
                content: 'Apakah anda yakin akan membatalkan proses permohonan ini?',
                buttons: {
                    Ya : function(){
                        window.location.href = "{{ url('permohonan/cancel-proses',[$token]) }}";
                    },
                    Tidak: function () {}
                }
            });
        });
</script>
@endsection
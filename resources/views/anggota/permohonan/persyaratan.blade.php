@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                    <strong>{{ strtoupper($title) }}</strong><br/>
                    <small>UPLOAD DOKUMEN PERSYARATAN</small>
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
                        <li class="nav-item active processing">
                            <span class="nav-title">UPLOAD DOKUMEN</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab" aria-expanded="true"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">REVIEW</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">BUKTI PENDAFTARAN</span>
                            <a href="#cetak-bukti-daftar" class="nav-link" data-toggle="tab"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="jenis-izin"></div>
                        <div class="tab-pane fade" id="input-data"></div>
                        <small>Ukuran Maksimal 2 MB / Dokumen</small>
                        @if($izin->ceklis == "ceklis")
                            <div class="col-12 mt-2">
                                <alert class="alert alert-danger w-100">
                                    Untuk izin ceklis syarat dapat diupload/dilengkapi setelah survey
                                </alert>
                            </div>
                        @endif
                        <div class="tab-pane fade active show" aria-expanded="true" id="upload-dokumen">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif
                            {!! $form !!}
                        </div>
                        <div class="tab-pane fade" id="cetak-bukti-daftar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
@section('js')
    <script type="text/javascript">
        $(document). on('change','input[type="file"]',function(e){
            size = this.files[0].size;
            if(size >= 2097152){
                $.alert('Maaf file maksimal 2 MB');
            }
        });
        $(document).on('submit','form',function(e){
            $('input[type="file"]').each(function(){
                if(this.files[0]){
                    size = this.files[0].size;
                    if(size >= 2097152){
                        $.alert('Maaf file maksimal 2 MB');
                        e.preventDefault();
                    }
                }
            });
        });
        let i = 0;
        @if($izin->ceklis == 'ceklis')
            $("input").each(function(e){
                $(this).removeAttr("required");
                console.log(i++);
            })
        @endif
    </script>
@endsection
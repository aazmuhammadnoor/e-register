@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong><br/>
                <small>UPLOAD BUKTI PEMBAYARAN</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                {{ Form::open(['url' => url()->current(),'files'=>true]) }}
                <div class="card card-body" data-provide="wizard">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                        @endforeach
                    @endif
                    <div class="alert alert-warning">
                        {{ $per->catatan_spm }}
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>UPLOAD BUKTI PEMBAYARAN</div>
                            <div class="form-group">
                                <label class="control-label require">Catatan</label>
                                <textarea class="form-control" name="catatan_pembayaran"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label require">Bukti Pembayaran</label>
                                <div class="input-group file-group">
                                    <input type="text" class="form-control file-value" placeholder="Choose file..." readonly>
                                    <input type="file" name="bukti_pembayaran">
                                    <span class="input-group-btn">
                                        <button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button>
                                    </span>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <footer class='card-footer text-left'>
                    <button type='submit' class='btn btn-label btn-primary'><label><i class="ti-check"></i></label> Simpan</button>
                    <a href='{{ url("permohonan") }}' class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
                </footer>
                {{ Form::close() }}                
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

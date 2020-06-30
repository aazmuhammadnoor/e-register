@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>    
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Profile Data Profesi
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                        {{ csrf_field() }}
                        <div class="card-body">
                            @include('flash::message')
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif                
                            <div class="row">                            
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('profesi') ? ' has-error' : '' }}">
                                        <label for="id_profesi" class="control-label require">Profesi</label>
                                        <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Profesi..." name="id_profesi">
                                            <option value=""> - </option>
                                            @foreach($profesi as $pf)
                                                <option value="{{ $pf->id }}" {{ $pendaftarProfesi != null && $pendaftarProfesi->id_profesi == $pf->id ? "selected" : ""}}>{{ $pf->nama }}</option>
                                            @endforeach
                                        </select>                                        
                                        @if ($errors->has('id_profesi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_profesi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nomor') ? ' has-error' : '' }}">
                                        <label for="nomor" class="control-label require">Nomor</label>
                                        <input id="nomor" type="text" class="form-control" name="nomor" value="{{ $pendaftarProfesi != null ? $pendaftarProfesi->nomor : '' }}" required>
                                        @if ($errors->has('nomor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                        <label for="penerbit" class="control-label require">Penerbit</label>
                                        <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ $pendaftarProfesi != null ? $pendaftarProfesi->penerbit : '' }}" required>
                                        @if ($errors->has('penerbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('penerbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('berlaku_sampai') ? ' has-error' : '' }}">
                                        <label for="berlaku_sampai" class="control-label require">Berlaku Sampai</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="berlaku_sampai" value="{{ $pendaftarProfesi != null ? $pendaftarProfesi->berlaku_sampai : '' }}">
                                        @if ($errors->has('berlaku_sampai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('berlaku_sampai') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection

@section('js')
<script>
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

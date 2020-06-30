@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/persyaratan') }}">Persyaratan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/persyaratan/'.$syarat->id.'/edit']) }}
    				<div class="card-body form-type-material">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('name','Persyaratan',['class'=>'require']) !!}
                                    {!! Form::textarea('name',$syarat->name,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="text-info">Jenis Persyaratan</p>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            {!! Form::radio('jenis',1,($syarat->jenis) ? true : false,['class'=>'custom-control-input']) !!}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description"> Persyaratan Administrasi</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            {!! Form::radio('jenis',0,(!$syarat->jenis) ? true : false,['class'=>'custom-control-input']) !!}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description"> Persyaratan Teknis</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="text-info">Tampilkan Persyaratan ini</p>
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            {!! Form::radio('aktif',1,($syarat->aktif) ? true : false,['class'=>'custom-control-input']) !!}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description"> Ya, Tampilkan sebagai persyaratan aktif</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            {!! Form::radio('aktif',0,(!$syarat->aktif) ? true : false,['class'=>'custom-control-input']) !!}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description"> Jangan tampilkan</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('referensi/persyaratan') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
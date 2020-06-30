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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/provinsi') }}">Provinsi</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kabupaten',[$prov->id]) }}">Kabupaten/Kota</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kecamatan',[$prov->id,$kab->id]) }}">Kecamatan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/kecamatan/'.$prov->id.'/'.$kab->id.'/add']) }}
                    {!! Form::hidden('kabupaten',$kab->id) !!}
    				<div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label require">Nama Kecamatan</label>
                            <div class="col-sm-6">
                                {!! Form::text('name',old('name'),['class'=>'form-control form-control-sm','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label require">Kode</label>
                            <div class="col-sm-3">
                                {!! Form::text('kode_kec',old('kode_kec'),['class'=>'form-control form-control-sm','required']) !!}
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/kecamatan',[$prov->id,$kab->id]) }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
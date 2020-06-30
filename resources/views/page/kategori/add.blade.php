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
            <li class="breadcrumb-item"><a href="{{ url('referensi/kategori') }}">Kategori</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/kategori/add']) }}
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
                                    {!! Form::label('name','Nama Kategori',['class'=>'require']) !!}
                                    {!! Form::text('name',old('name'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/kategori') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
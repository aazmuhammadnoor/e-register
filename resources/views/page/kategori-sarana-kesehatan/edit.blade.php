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
            <li class="breadcrumb-item"><a href="{{ url('referensi/kategori-sarana-kesehatan') }}">Kategori Sarana Kesehatan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/kategori-sarana-kesehatan/'.$kategori->id.'/edit']) }}
                    <div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Nama Kategori</label>
                            <div class="col-sm-4">
                                {!! Form::text('nama_kategori',$kategori->nama_kategori,['class'=>'form-control form-control-sm','required']) !!}
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('referensi/kategori-sarana-kesehatan') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection
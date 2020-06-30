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
            <li class="breadcrumb-item"><a href="{{ url('admin/pengumuman') }}">Pengumuman</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'admin/pengumuman/add']) }}
    				<div class="card-body">
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
                                    {!! Form::label('judul','Judul',['class'=>'require']) !!}
                                    {!! Form::text('judul',old('judul'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('isi','Isi Pengumuman',['class'=>'require']) !!}
                                    {!! Form::textarea('isi',old('isi'),['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim','data-min-height'=>'150']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('name','Publish',['class'=>'require']) !!}
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio">
                                            {{ Form::radio('publish', "Publik" , true,['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Publik</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            {{ Form::radio('publish', "Member" , null,['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Member</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            {{ Form::radio('publish', "Keduanya" , null,['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Keduanya</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            {{ Form::radio('publish', "Tidak Aktif" , null,['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Tidak Aktif</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('admin/pengumuman') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
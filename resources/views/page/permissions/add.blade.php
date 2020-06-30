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
            <li class="breadcrumb-item"><a href="{{ url('config/permissions') }}">Permissions List</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
    					{{ Form::open(['url' => 'admin/config/permissions/add','class'=>'form-horizontal']) }}
                            <div class="form-group">
                                {!! Form::label('name','Nama Permission') !!}
                                {!! Form::text('name',old('name'),['class'=>'form-control col-4']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('akses','Permission Untuk Role/Bidang') !!}
                                <div class="custom-controls-stacked">
                                    @foreach ($roles as $role) 
                                        <label class="custom-control custom-checkbox">
                                            {{ Form::checkbox('roles[]',  $role->id, null,['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">{{ $role->name}}</span>
                                        </label>
                                    @endforeach
                                </div> 
                                
                            </div>
                            <div class="form-group">
                                <button class="btn btn-label btn-primary btn-sm">
                                    <label><i class="ti-check"></i></label> 
                                    Simpan
                                </button>
                                <a href="{{ url('config/permissions') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                            </div>
    					{{ Form::close() }}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
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
            <li class="breadcrumb-item"><a href="{{ url('admin/config/roles') }}">Role/Bidang</a></li>
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
    					{{ Form::open(['url' => 'admin/config/roles/addnew','class'=>'form-horizontal']) }}
                            <div class="form-group">
                                {!! Form::label('name','Nama Role/Bidang') !!}
                                {!! Form::text('name',old('name'),['class'=>'form-control col-6']) !!}
                            </div>
                            <div class="form-group">
                                <button class="btn btn-label btn-primary btn-sm">
                                    <label><i class="ti-check"></i></label> 
                                    Simpan
                                </button>
                                <a href="{{ url('config/roles') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
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
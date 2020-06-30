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
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-md-6 col-xs-12">
    			{{ Form::open(['url' => 'admin/config/users/profile','class'=>'card']) }}
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        @include('flash::message')
                        <div class="form-group">
                            <label>Role/Bidang</label>
                            @if(auth()->user()->is_admin)
                                <p class="text-success">Super Administrator</p>
                            @else
                                @if(auth()->user()->roles()->count() > 0)

                                    <p class="text-success">{{ auth()->user()->roles()->first()->name }}</p>

                                @else
                                    <p class="text-danger">n/a</p>
                                @endif
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            {!! Form::text('name',auth()->user()->name,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            {!! Form::text('username',auth()->user()->username,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            {!! Form::text('password',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Perubahan Password</label>
                            {!! Form::text('password_confirmation',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Alamat Email</label>
                            {!! Form::text('email',auth()->user()->email,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-sm btn-primary">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                    </footer>
                {{ Form::close() }}         
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection
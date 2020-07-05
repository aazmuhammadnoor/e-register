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
            <li class="breadcrumb-item"><a href="{{ url('admin/config/users') }}">User/Pengguna</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'admin/config/users/'.$user->id.'/edit']) }}
    				<div class="card-body form-type-material">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('name','Nama Lengkap',['class'=>'require']) !!}
                                    {!! Form::text('name',$user->name,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('email','Alamat Email',['class'=>'require']) !!}
                                    {!! Form::text('email',$user->email,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('username','Username',['class'=>'require']) !!}
                                    {!! Form::text('username',$user->username,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('password','Password') !!}
                                    {!! Form::text('password',null,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <p class="text-info"><strong>Role Pengguna</strong></p>
                                <div class="custom-controls-stacked">
                                    @foreach ($roles as $role) 
                                        <label class="custom-control custom-radio">
                                            {{ Form::radio('roles',  $role->id, (in_array($role->id, $ext_role) ? true : false),['class'=>'custom-control-input'] ) }}
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">{{ $role->name}}</span>
                                        </label>
                                    @endforeach
                                </div> 
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::checkbox('email_notif',1,($user->email_notif == 1) ? true : false) !!}
                                    Notifikasi Email
                                </div>
                            </div>                          
                        </div>                       
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('config/users') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
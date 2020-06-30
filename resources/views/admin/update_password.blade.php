@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
<style>
[data-role="dynamic-fields"] > .form-group [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-group:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-group:last-child [data-role="remove"] {
    display: none;
}
</style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => url()->current(),'files'=>true]) }}
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
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('old_password','Password Lama',['class'=>'require']) !!}
                                    <input type="password" name="old_password" class="form-control" placeholder="Password Lama">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('password','Password Baru',['class'=>'require']) !!}
                                    <input type="password" name="password" class="form-control" placeholder="Password Baru">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('password_confirm','Ulangi Password Baru',['class'=>'require']) !!}
                                    <input type="password" name="password_confirm" class="form-control" placeholder="Ulangi Password Baru">
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/perizinan') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
@endsection
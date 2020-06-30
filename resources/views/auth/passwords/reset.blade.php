@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>RESET PASSWORD</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-md-12 center-vh">
                <div class="card bg-white w-400px mb-3">
                    <div class="card-body">
                        @include('flash::message')
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <form class="form-type-material" method="POST" action="{{ route('password.reset') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                Username: <span class="text-danger">{{ $username }}</span>
                            </div>

                            <div class="form-group">
                                Silakan masukkan password baru Anda.
                            </div>

                            <div class="form-group">
                              <input type="password" class="form-control" name="password" value="{{ old('password') }}"/>
                              <label for="password">Password</label>
                            </div>

                            <div class="form-group">
                              <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"/>
                              <label for="password_confirmation">Konfirmasi Password</label>
                            </div>

                            <div class="form-group">
                              <button class="btn btn-bold btn-block btn-primary" type="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
@endsection

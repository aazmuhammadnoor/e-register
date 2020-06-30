@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>KIRIM KODE AKTIVASI</strong>
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
                      <form class="form-type-material" method="POST" action="{{ route('anggota.aktivasi.ulang') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" >
                          <label for="username">Username/Email</label>
                        </div>

                        <br>
                        <button class="btn btn-bold btn-block btn-primary" type="submit">Aktivasi Ulang</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
@endsection

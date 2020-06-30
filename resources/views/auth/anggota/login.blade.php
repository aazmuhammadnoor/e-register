@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>LOGIN</strong>
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
						            @if(\Session::has('alert'))
						                <div class="alert alert-danger">
						                    <div>{{Session::get('alert')}}</div>
						                </div>
												@endif
						            @if ($errors->any())
						                @foreach ($errors->all() as $error)
						                <div class="alert alert-danger">
						                    {{ $error }}
						                </div>
						                @endforeach
						            @endif
												<form class="form-type-material" method="POST" action="{{ url()->current() }}">
									            	{{ csrf_field() }}
										            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
										              <input type="text" class="form-control" name="username" value="{{ old('username') }}"/>
										              <label for="username">Username / Email</label>
										            </div>
										            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
										              <input type="password" class="form-control" id="password" name="password"/>
										              <label for="password">Password</label>
										            </div>
										            <div class="form-group flexbox">
										              <label class="custom-control custom-checkbox">
										                <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
										                <span class="custom-control-indicator"></span>
										                <span class="custom-control-description">Ingat Saya</span>
										              </label>
										              <a class="text-muted hover-primary fs-13" href="{{ route('password.reset') }}">Lupa password?</a>
										            </div>
											        <div class="form-group">
											          <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
											        </div>
							        		</form>
							        		<p>Tidak menerima email aktivasi ? <a href="{{ url('anggota/aktivasi_ulang') }}" class="text-warning">Kirim Ulang Kode Aktivasi</a></p>
										</div>
								</div>
						</div>
				</div>
		</div>
    @include('layouts.footer')
@endsection

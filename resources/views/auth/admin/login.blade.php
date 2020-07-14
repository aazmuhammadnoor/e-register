@extends('layouts.app')

@section('content')
<div class="row no-gutters min-h-fullscreen bg-white">
	<div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url({{ \Storage::url($identitas->bg_login) }})" data-overlay="5">

		<div class="row h-100 pl-50">
			<div class="col-md-10 col-lg-8 align-self-end">
				<br/><br/><br/><br/>
            	<br/><br/>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
		<div class="px-80 py-30">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endforeach
            @endif
			<h4>Login</h4>
			<form class="form-type-material" method="POST" action="{{ url()->current() }}">
            	{{ csrf_field() }}
	            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
	              <input type="text" class="form-control" name="username" value="{{ old('username') }}"/>
	              <label for="username">Username</label>
	            </div>
	            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
	              <input type="password" class="form-control" id="password" name="password">
	              <label for="password">Password</label>
	            </div>
<!-- 	            <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
								@captcha
								<input type="text" id="captcha" class="form-control" name="captcha">

	            </div> -->
	            <div class="form-group flexbox">
	              <label class="custom-control custom-checkbox">
	                <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
	                <span class="custom-control-indicator"></span>
	                <span class="custom-control-description">Ingat Saya</span>
	              </label>

	              <a class="text-muted hover-primary fs-13" href="#">Lupa password?</a>
	            </div>
		        <div class="form-group">
		          <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
		        </div>
        	</form>
		</div>
	</div>
</div>
@endsection

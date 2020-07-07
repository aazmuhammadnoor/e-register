@extends('layouts.new_layout')

@section('content')
    <main class="container-fluid bg-primary eregister-main-container">
        <div class="eregister-homepage">
           <div class="left-content col-md-7">
               <img src="{{ asset('images/picture_home.png') }}">
           </div>
           <div class="right-content col-md-4">
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
               <h2>Login</h2>
           	   <p>
           	   		Masukkan Password anda
           			<br>Email : {{ $email }}
           		</p>
               <form method="POST" action="{{ url('login/key') }}" class="form w-100" id="form-login">
               		{{ csrf_field() }}
               		<input type="hidden" value="{{ $email }}" name="email">
               		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		              <input type="password" class="form-control number-only" name="password" required="" placeholder="Password" />
		            </div>
		            <button type="submit" class="btn btn-secondary">Login</button>
           	   </form>
           	   <a href="{{ route('login.otp',[$email]) }}" class="text-secondary">Masuk dengan OTP</a>
           </div>
        </div>
    </main>
@endsection

@section('js')
@endsection

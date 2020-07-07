@extends('layouts.new_layout')

@section('content')
    <main class="container-fluid bg-primary eregister-main-container">
        <div class="eregister-homepage">
           <div class="left-content col-md-7">
               <img src="{{ asset('images/picture_home.png') }}">
           </div>
           <div class="right-content col-md-4">
               <h2>Login</h2>
               @if ($auth == 'OTP')
               	   <p>
               	   		Masukkan kode OTP yang anda terima dari email
               			<br>Email : {{ $email }}
               		</p>
	               <form method="POST" action="{{ url('login/post') }}" class="form w-100">
	               		{{ csrf_field() }}
	               		<input type="hidden" email="{{ $email }}" name="email">
	               		<input type="hidden" name="auth" value="otp">
	               		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
			              <input type="number" class="partitioned text-white number-only" name="password" max="999999" autocomplete="off" />
			            </div>
	           	   </form>
               @else

               @endif
           </div>
        </div>
    </main>
@endsection

@section('js')
@endsection

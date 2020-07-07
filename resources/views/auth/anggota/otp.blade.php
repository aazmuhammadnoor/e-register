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
           	   		Masukkan kode OTP yang anda terima dari email
           			<br>Email : {{ $email }}
           		</p>
               <form method="POST" action="{{ url('login/with-otp') }}" class="form w-100" id="form-login">
               		{{ csrf_field() }}
               		<input type="hidden" value="{{ $email }}" name="email">
               		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		              <input type="number" class="partitioned text-white number-only" name="password" min="100000" max="999999" maxlength="6" minlength="6" autocomplete="off" id="otp" />
		            </div>
           	   </form>
           	   <p class="text-white" id="message"></p>
           	   <a href="{{ route('login.password',[$email]) }}" class="text-secondary">Masuk dengan Password</a>
           </div>
        </div>
    </main>
@endsection

@section('js')
	<script type="text/javascript">
		$(document).on('keyup','#otp',function(e)
		{
			let otp = $(this).val();
			let email = '{{ $email }}';
			if(otp.length == 6)
			{
				check(email,otp);
			}
		})

		function check(email,otp)
		{
			$.ajax({
				url : '{{ route('login.otp.check') }}',
				type : 'POST',
				data : {
					_token : '{{ csrf_token() }}',
					email : email,
					otp : otp
				},
				beforeSend: function(xhr){
					$('#message').html('Loading...');
				},
				error: function(xhr){
					$('#message').html('');
				},
				success: function(xhr){
					$('#message').html('');
					if(xhr.status == 'success')
					{
						$("#form-login").submit();
					}else{
						$('#message').html(xhr.message);
						if(xhr.message = 'OTP Incorrect')
						{
							setTimeout(function(){ 
								window.location.href = '{{ url('login') }}';
							}, 2000);
						}
					}
				},
			})
		}
	</script>
@endsection

@extends('layouts.new_layout')

@section('content')
    <main class="container-fluid bg-primary eregister-main-container">
        <div class="eregister-homepage">
           <div class="left-content col-1 col-md-7">
               <img src="{{ asset('images/picture_home.png') }}" height="100%">
           </div>
           <div class="right-content col-11 col-md-4">
               <h2>Login</h2>
               <p>Masukkan email anda yang terdaftar</p>
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
               <form method="POST" action="{{ url('login/post') }}" class="form w-100">
               		{{ csrf_field() }}
               		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		              <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" />
		            </div>
	               <button class="btn btn-secondary" type="submit">MASUK</button>
           	   </form>
           </div>
        </div>
    </main>
@endsection

@section('js')
@endsection

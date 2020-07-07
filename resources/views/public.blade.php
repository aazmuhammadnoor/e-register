@extends('layouts.new_layout')

@section('content')
    <main class="container-fluid bg-primary eregister-main-container">
        @if($form_register)
        <div class="eregister-homepage">
           <div class="left-content col-md-7">
               <img src="{{ asset('images/picture_home.png') }}">
           </div>
           <div class="right-content col-mc-4">
               <h2 class="text-uppercase">{{ $form_register->form_name }}</h2>
               <p>{!! $form_register->summary !!}</p>
               <button class="btn btn-secondary btn-block open-register" data-url="{{ $form_register->url }}">DAFTAR SEKARANG</button>
               {{-- <button class="btn btn-outline-light">CEK HASIL PENDAFTARAN</button> --}}
           </div>
        </div>
        @else
        <div class="eregister-homepage">
           <div class="left-content col-md-7">
               <img src="{{ asset('images/picture_home.png') }}">
           </div>
           <div class="right-content col-mc-4">
               <h2>PENDAFTARAN <br> MAHASISWA BARU</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
               <button class="btn btn-secondary btn-block open-register" data-url="zyafbp">DAFTAR SEKARANG</button>
               {{-- <button class="btn btn-outline-light">CEK HASIL PENDAFTARAN</button> --}}
           </div>
        </div>
        @endif
    </main>
@endsection

@section('js')
@endsection

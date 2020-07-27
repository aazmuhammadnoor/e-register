@extends('layouts.new_layout')

@section('content')
    <main class="container-fluid bg-primary eregister-main-container">
        @if($form_register)
        <div class="eregister-homepage">
           <div class="left-content col-1 col-md-8">
               <img src="{{ \Storage::url($identitas->bg_frontend) }}" height="100%">
           </div>
           <div class="right-content">
               <h2 class="text-uppercase">{{ $form_register->form_name }}</h2>
               <p>{!! $form_register->summary !!}</p>
               <button class="btn btn-secondary btn-block open-register" data-url="{{ $form_register->url }}">DAFTAR SEKARANG</button>
               {{-- <button class="btn btn-outline-light">CEK HASIL PENDAFTARAN</button> --}}
           </div>
        </div>
        @else
        <div class="eregister-homepage">
           <div class="left-content col-12">
               <img src="{{ asset('images/picture_home.png') }}">
           </div>
        </div>
        @endif
    </main>
@endsection

@section('js')
@endsection

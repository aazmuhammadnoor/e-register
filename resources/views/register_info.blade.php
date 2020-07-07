@extends('layouts.new_layout')

@section('css')
    <style type="text/css">
        .current-color{
            color : {{ $form_register->color }} !important;
        }
        .current-bg-color{
            background-color : {{ $form_register->color }} !important;
        }
        .current-bg-color-transparent{
            background-color : {{ $form_register->color }}CC !important;
        }
        .current-border-color{
            border-color: {{ $form_register->color }} !important;
        }
        .current-btn{
            background-color : {{ $form_register->color }} !important;
            border: none;
        }
        .current-list-color{
            list-style: none;
        }
        .current-list-color li:before{
            content: "\2022";
            color: {{ $form_register->color }} !important;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
        }
        #step-container .active a{
            color : {{ $form_register->color }} !important;
        }
        #step-container .active::after, #step-container .active::before{
            background-color: {{ $form_register->color }} !important;
            border-color: {{ $form_register->color }} !important;
        }
        .eregister-checkbox-container input:checked ~ .eregister-checkbox{
            background-color: {{ $form_register->color }} !important;
        }
        .eregister-radio-container input:checked ~ .eregister-radio {
          background-color: {{ $form_register->color }} !important;
        }
        .eregister-register-page::after{
            background-color: {{ $form_register->color }} !important;
        }
    </style>
@endsection

@section('content')

    <div class="loading-container current-bg-color-transparent" id="loading-page">
        <div class="sk-wave">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
        </div>
    </div>
    <main class="eregister-main-container bg-primary bg-image current-bg-color" style="background-image: url('{{ url('/').\Storage::url($form_register->background) }}') !important">
        <div class="container bg-white p-0">
            <div class="eregister-register-page">
                <div class="row w-100 py-3">
                    <div class="col-12 col-md-8 mx-auto pl-5 p-md-2">
                        <div class="eregister-form-title my-5">
                            <h4 class="current-color">{{ $form_register->form_name }}</h4>
                        </div>
                        <p>{!! $form_register->info !!}</p>
                        @php
                            $step = $form_register->hasStep;
                            $berkas = [];
                            if(count($step) > 0)
                            {
                                foreach($step as $row)
                                {
                                    $data = $row->metadata;
                                    $data = json_decode($data);
                                    if($data){
                                        foreach($data as $field)
                                        {
                                            if($field->type == 'file')
                                            {
                                                array_push($berkas,$field->label);
                                            }
                                        }
                                    }
                                } 
                            }
                        @endphp
                        @if (count($berkas) > 0)
                            <p>Berkas : </p>
                            <ul class="current-list-color">
                                @foreach ($berkas as $key => $element)
                                    <li>{{ $element }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="text-center w-100">
                            <a href="{{ route('register',[$form_register->url]) }}" class="btn current-btn text-white mx-auto">Register Sekarang !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
@endsection

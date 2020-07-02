@extends('layouts.new_layout')

@section('css')
    <style type="text/css">
        .current-color{
            color : {{ $form_register->color }} !important;
        }
        .current-bg-color{
            background-color : {{ $form_register->color }} !important;
        }
        .current-btn{
            background-color : {{ $form_register->color }} !important;
            border: none;
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
    <main class="eregister-main-container bg-primary bg-image current-bg-color" style="background-image: url('{{ url('/').\Storage::url($form_register->background) }}') !important">
        <div class="container bg-white p-0">
            <div class="eregister-register-page">
                <div class="nav-left">
                    <ul id="step-container">
                        @foreach($form_register->hasStep as $key => $row)
                            <li class='{{ ($key == 0) ? "active" : '' }}' id="form-step-{{ $row->id }}" data-id="{{ $row->id }}">
                                <a href="#!" class="btn-form-step" data-id="{{ $row->id }}">
                                    {{ $row->step_name }}
                                </a>
                            </li>
                        @endforeach
                        <li data-id="review">
                            <a href="#!" class="btn-form-step" data-id="review">
                                Review
                            </a>
                        </li>
                        <li data-id="done">
                            <a href="#!" class="btn-form-step" data-id="done">
                                Selesai
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="eregister-title-container">
                                <div id="form-step-title">
                                    Data Diri
                                </div>
                                <div class="eregister-form-title">
                                    <h4 class="current-color">{{ $form_register->form_name }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5" id="form-step-content">{{-- content will be here --}}</div>
                    <div class="row mt-5 mb-4">
                        <div class="col-12">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <button class="btn btn-outline-dark">Batal</button>
                                    <button class="btn btn-outline-danger">Reset</button>
                                </div>
                                <button class="btn btn-secondary text-white current-btn">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/administratif.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/eregister.js') }}"></script>
    <script type="text/javascript">
        function url_upload(step)
        {
            return url+'/file/{{ $form_register->url }}/'+step+'/upload';
        }
        function url_remove(step)
        {
            return url+'/file/{{ $form_register->url }}/'+step+'/remove';
        }
    </script>
@endsection

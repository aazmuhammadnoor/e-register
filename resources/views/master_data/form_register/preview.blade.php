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
                <div class="nav-left">
                    <ul id="step-container">
                        @foreach($form_step as $key => $row)
                            <li class='{{ ($key == 0) ? "active" : '' }}' id="form-step-{{ $row->id }}" data-id="{{ $row->id }}">
                                <a href="#!" class="btn-form-step" data-id="{{ $row->id }}">
                                    {{ $row->step_name }}
                                </a>
                            </li>
                        @endforeach
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
                    <form id="form-submit-register">
                        <div class="row mt-5" id="form-step-content">{{-- content here --}}

                        </div>
                         <div class="row mt-5 mb-4" id="button-form">
                            <div class="col-12">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <button class="btn btn-outline-dark">Batal</button>
                                        <a href="#!" class="btn btn-outline-danger" id="button-reset-form">Reset</a>
                                    </div>
                                    <a href="#!" class="btn btn-secondary text-white current-btn" script="javascript:void(0)">Simpan</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/administratif.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/eregister.js') }}"></script>
    <script type="text/javascript">

        var form_code = '{{ $form_register->url }}';
        var steps = [];
    @foreach ($form_step as $row)
        steps.push({{ $row->id }});
    @endforeach
        var step_information = [];
        stepInfo();

        $(document).ready(function(e)
        {
            loadTemp();
        })
        function url_upload(step)
        {
            return url;
        }
        function url_file_check(step)
        {
            return url+'/file/{{ $form_register->url }}/'+step+'/check';
        }
        function url_remove(step)
        {
            return url+'/file/{{ $form_register->url }}/'+step+'/remove';
        }
        function url_register_info(step)
        {
            return url+'/register/{{ $form_register->url }}/'+step+'/step-info';
        }
        function url_submit_form(step)
        {
            return url+'/register/{{ $form_register->url }}/'+step+'/submit';
        }
        function url_review()
        {
            return url+'/register/{{ $form_register->url }}/'+'review';
        }
        function url_path_file(path)
        {
            return url+path;
        }
        function url_final()
        {
            return '{{ route('register.final',[$form_register->url]) }}';
        }
        var now = '{{ \Carbon\Carbon::now()->format('Y-m-d') }}';
    </script>
@endsection

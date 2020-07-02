@extends('layouts.new_layout')

@section('css')
    <style type="text/css">
        .current-color{
            color : {{ $form_register->color }} !important;
        }
        .current-bg-color{
            background-color : {{ $form_register->color }} !important;
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
                    <div class="row mt-5" id="form-step-content">
                        <div class="eregister-form col-md-6">
                            <label>Text</label>
                            <input type="text" class="form-control" placeholder="Text">
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Select</label>
                            <select class="custom-select">
                                <option>a</option>
                            </select>
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Radio</label>
                            <div class="eregister-radio-container mx-auto">
                                <label class="eregister-radio-box"> 
                                      Text
                                      <input type="radio" name="x">
                                      <span class="eregister-radio"></span>
                                </label>
                            </div>
                            <div class="eregister-radio-container mx-auto">
                                <label class="eregister-radio-box"> 
                                      Text
                                      <input type="radio" name="x">
                                      <span class="eregister-radio"></span>
                                </label>
                            </div>
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Checkbox</label>
                            <div class="eregister-checkbox-container mx-auto">
                                <label class="eregister-checkbox-box"> 
                                      test
                                      <input type="checkbox">
                                      <span class="eregister-checkbox"></span>
                                </label>
                            </div>
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control" placeholder="Text">
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Number</label>
                            <input type="number" class="form-control" placeholder="Text">
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>File</label>
                            <input type="file" class="form-control" placeholder="Text">
                        </div>
                        <div class="eregister-form col-md-6">
                            <label>Textarea</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="col-12 administratif" data-id="1">
                            <div class="row">
                                <div class="eregister-form col-6">
                                    <label>Provinsi</label>
                                    <select class="custom-select administratif_provinsi" id="administratif_provinsi_1" data-id="1"></select>
                                </div>
                                <div class="eregister-form col-6">
                                    <label>Kabupaten/Kota</label>
                                    <select class="custom-select administratif_kabupaten" id="administratif_kabupaten_1" data-id="1"></select>
                                </div>
                                <div class="eregister-form col-6">
                                    <label>Kecamatan</label>
                                    <select class="custom-select administratif_kecamatan" id="administratif_kecamatan_1" data-id="1"></select>
                                </div>
                                <div class="eregister-form col-6">
                                    <label>Kelurahan</label>
                                    <select class="custom-select administratif_kelurahan" id="administratif_kelurahan_1" data-id="1"></select>
                                </div>
                            </div>
                        </div>
                        <div class="eregister-form col-md-12 autocomplete">
                            <label>Alamat</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control autocomplete_administratif" placeholder="Cari Kelurahan atau Kecamatan (Min 3 huruf depan)" maxlength="200" id="autocomplete_administratif_1" data-id="1">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-danger clear_autocomplete" type="button" data-id="1">
                                    <i class="icon ti-close"></i></button>
                                </div>
                            </div>
                            <div class="box" id="autocomplete_item_1" style="display: none"></div>
                            <small id="autocomplete_searching_1" style="display: none">Mencari alamat ...</small>
                            <small id="autocomplete_error_1" style="display: none">Tidak ditemukan</small>
                            <input type="hidden" id="autocomplete_value_1">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <button class="btn btn-outline-dark">Batal</button>
                                    <button class="btn btn-outline-danger">Reset</button>
                                </div>
                                <button class="btn btn-secondary text-white">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/eregister.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/administratif.js') }}"></script>
    <script type="text/javascript">
        /**
         * on click button form step
         */
        $(document).on('click','.btn-form-step',function(e)
        {
            e.preventDefault();
            let id = $(this).data('id');
            let active = 0;

            //remove active class
            $('#step-container li').each(function()
            {
                let this_id = $(this).data('id');
                $(this).removeClass('active');
                if(this_id == id)
                {
                    $(this).addClass('active');
                    active = 1;
                }
                (active == 0) ? $(this).addClass('active') : '';
            });

        })
    </script>
@endsection

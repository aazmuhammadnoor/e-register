@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/vendor/ckeditor5/sample/css/sample.css') }}">
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.form.register') }}">{{ $title }}</a></li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => url()->current(),'files'=>true]) }}
    				<div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Nama Form Register</label>
                            <div class="col-sm-4">
                                {!! Form::text('form_name',$form_register->form_name,['class'=>'form-control form-control-sm','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Kode Register</label>
                            <div class="col-sm-4">
                                {!! Form::text('register_code',$form_register->register_code,['class'=>'form-control form-control-sm','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Warna Background</label>
                            <div class="col-sm-1">
                                <input type="color" name="color" value="{{ ($form_register->color) ? $form_register->color : '#33CABB' }}" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Template Register</label>
                            <div class="col-sm-4">
                                {{ Form::file('template_register') }}
                                @if($form_register->template_register)
                                    <br>
                                    <a href="{{ route('admin.download.template.register',[$form_register->id]) }}"><i class="icon ti-download"></i> Download Template</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Background</label>
                            <div class="col-sm-4">
                                {{ Form::file('background') }}
                                @if($form_register->background)
                                    <br>
                                    <a href="{{ url('/').\Storage::url($form_register->background) }}"><i class="icon ti-download"></i> Download</a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Utama</label>
                            <div class="col-sm-10">
                                 {!! Form::radio('utama',1,($form_register->utama == 1) ? true : false) !!}
                                    Ya
                                 {!! Form::radio('utama',0,($form_register->utama == 0) ? true : false) !!}
                                    Tidak
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sumarry</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="info">{!! $form_register->sumarry !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Info Tambahan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="editor1" name="info">{!! $form_register->info !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Template Email Konfirmasi Pendaftaran</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="editor2" name="register_email_confirm">{!! $register_email_confirm !!}</textarea>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ route('admin.form.register') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('scripts')
    <script src="{{ asset('themes/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1')
        CKEDITOR.replace('editor2')
    </script>
@endsection
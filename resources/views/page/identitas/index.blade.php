@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
                <div class="card">
        			<div class="card-body">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{ $error }}
                                    </div>
                                @endforeach
                                @endif
                            @include('flash::message')

                        @php
                            $act1 = ($act == 1 || is_null($act))? 'active':'';
                            $act2 = ($act == 2)? 'active':'';
                            $act3 = ($act == 3)? 'active':'';
                            $showact1 = ($act == 1 || is_null($act))? 'active show':'';
                            $showact2 = ($act == 2)? 'active show':'';
                            $showact3 = ($act == 3)? 'active show':'';
                        @endphp 
                        <!--  tab  -->
                            <ul class="nav nav-tabs nav-justified nav-tabs-default">
                              <li class="nav-item">
                                <a class="nav-link {{$act1}}" data-toggle="tab" href="#home-wide">{{ strtoupper('Identitas Instansi Dan Aplikasi') }}</a>
                              </li>
                            </ul>
                        <!-- end tab -->
                        <!-- content tab -->
                            <div class="tab-content">
                              <div class="tab-pane fade {{$showact1}}" id="home-wide">
                                {{ Form::open(['url' => 'admin/config/identitas','class'=>'card form-type-combine','files'=>true]) }}
                                    <div class="card-body">
                                        <h6 class="text-light fw-300">INSTANSI</h6>
                                        <div class="form-groups-attached">
                                            <div class="row">
                                                <div class="form-group col-8">
                                                    {!! Form::label('instansi','Nama Instansi',['class'=>'require']) !!}
                                                    {!! Form::text('instansi',$rs->instansi,['class'=>'form-control form-control-sm']) !!}
                                                </div>
                                                <div class="form-group col-4">
                                                    {!! Form::label('singkatan_instansi','Singkatan',['class'=>'require']) !!}
                                                    {!! Form::text('singkatan_instansi',$rs->singkatan_instansi,['class'=>'form-control form-control-sm']) !!}
                                                </div>  
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-8">
                                                    {!! Form::label('alamat_instansi','Alamat Instansi',['class'=>'require']) !!}
                                                    {!! Form::text('alamat_instansi',$rs->alamat_instansi,['class'=>'form-control form-control-sm']) !!}
                                                </div> 
                                                <div class="form-group col-4">
                                                    {!! Form::label('telepon_instansi','Telepon Instansi',['class'=>'require']) !!}
                                                    {!! Form::text('telepon_instansi',$rs->telepon_instansi,['class'=>'form-control form-control-sm']) !!}
                                                </div> 
                                            </div>           
                                        </div>
                                        <h6 class="text-light fw-300">APLIKASI</h6>
                                        <div class="form-groups-attached">
                                            <div class="form-group">
                                                {!! Form::label('nama_aplikasi','Nama Aplikasi',['class'=>'require']) !!}
                                                {!! Form::text('nama_aplikasi',$rs->nama_aplikasi,['class'=>'form-control form-control-sm']) !!}
                                            </div>
                                            <div class="form-group">
                                                    {!! Form::label('footer','Footer',['class'=>'require']) !!}
                                                    {!! Form::text('footer',$rs->footer,['class'=>'form-control form-control-sm']) !!}
                                            </div>  
                                            <div class="row">
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('logo_public','Logo Publik 100 × 30 px',['class'=>'require']) !!}
                                                    {!! Form::text('logo_public_value',$rs->logo_public,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('logo_public') !!}
                                                </div>
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('logo_backend','Logo Backend 178 × 30 px',['class'=>'require']) !!}
                                                    {!! Form::text('logo_backend_value',$rs->logo_backend,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('logo_backend') !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('bg_login','Background Halaman Login 1920 × 1280 px',['class'=>'require']) !!}
                                                    {!! Form::text('bg_login_value',$rs->bg_login,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('bg_login') !!}
                                                </div>
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('logo_login','Logo Login 150 x 30 px',['class'=>'require']) !!}
                                                    {!! Form::text('logo_login_value',$rs->logo_login,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('logo_login') !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('bg_frontend','Background Halaman Depan 1920 × 1280 px',['class'=>'require']) !!}
                                                    {!! Form::text('bg_frontend_value',$rs->bg_frontend,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('bg_frontend') !!}
                                                </div>
                                                <div class="form-group col-6 file-group file-browser">
                                                    {!! Form::label('bukti_pendaftaran','Tempalte Word Bukti Pendaftaran',['class'=>'require']) !!}
                                                    {!! Form::text('bukti_pendaftaran_value',$rs->bukti_pendaftaran,['class'=>'form-control file-value']) !!}
                                                    {!! Form::file('bukti_pendaftaran') !!}
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    {!! Form::label('embed_widget','Embed Widget',['class'=>'require']) !!}
                                                    {!! Form::textarea('embed_widget',$rs->embed_widget,['class'=>'form-control']) !!}
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <footer class="card-footer text-left">
                                        <button class="btn btn-label btn-primary btn-sm">
                                            <label><i class="ti-check"></i></label> 
                                            Simpan Perubahan
                                        </button>
                                    </footer>
                                {{ Form::close() }}
                              </div>
                            </div>
                        <!-- end content tab -->


                    </div>
                </div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
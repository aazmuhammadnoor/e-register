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
            <li class="breadcrumb-item"><a href="{{ url('config/menu') }}">Daftar Menu</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'config/menu/'.$menu->id.'/edit']) }}
    				<div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Menu Parent</label>
                            <div class="col-sm-8">
                                <select name="parent" class="form-control form-control-sm select2" data-provide="selectpicker" id="parent">
                                    <option value=""> - </option>
                                    @foreach($menus as $mn)
                                        <option value="{{ $mn->id }}" {{ $mn->id == $menu->parent ? "selected" : "" }}>{{ $mn->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Menu Label</label>
                            <div class="col-sm-4">
                                {!! Form::text('label',$menu->label,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Route URL</label>
                            <div class="col-sm-3">
                                {!! Form::text('url',$menu->url,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Icon Menu</label>
                            <div class="col-sm-4">
                                {!! Form::text('icon',$menu->icon,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="text-info"><strong>Menu Untuk Role/Bidang</strong></p>
                            <div class="custom-controls-stacked">
                                @foreach ($roles as $role) 
                                    <label class="custom-control custom-checkbox">
                                        {{ Form::checkbox('roles[]',  $role->id, (in_array($role->id, $exrole)) ? true : false ,['class'=>'custom-control-input'] ) }}
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">{{ $role->name}}</span>
                                    </label>
                                @endforeach
                            </div> 
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-sm btn-primary">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('config/menu') }}" class="btn btn-sm btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
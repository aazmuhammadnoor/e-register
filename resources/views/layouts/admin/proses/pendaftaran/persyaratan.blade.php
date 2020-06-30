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
            <li class="breadcrumb-item"><a href="{{ url('perizinan/pendaftaran') }}">Daftar Perizinan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $title }}</h5>
                        <h5 class="text-primary"><strong>Permohonan {{ $izin->name }}</strong></h5>
                    </div>
                </div>
            </div>
    		<div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                    @endforeach
                @endif
                {!! $form !!}
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
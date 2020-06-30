@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="home-main-content">
        <div class="card-group">
            <div class="d-flex row col-12 align-items-stretch">
                @foreach($tutorial as $rs)
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-4">
                                <h1 class="text-center"><span class="icon ti-help-alt text-primary"></span></h1>
                                <p class="text-center">
                                    <a href="{{ route('bantuan.tutorial',[$rs->id]) }}"" class="btn btn-outline btn-info">Lihat</a>
                                </p>
                            </div>
                            <div class="col-8">
                                <h4 class="card-title b-0 px-0 card-title-bold">{{ $rs->judul_tutorial }}</h4>
                                <p class="text-left">
                                    {{ substr($rs->deskripsi_tutorial,0,50) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#menu-tutorial").addClass("active open");
    </script>
@endsection
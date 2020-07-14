@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
    <style type="text/css">
        .card{
            position: relative;
        }
        .card .line{
            position: absolute;
            top: 10px;
            left: 10px;
            height: calc(100% - 20px);
            width: 5px;
        }
    </style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Statistik</li>
        </ol>
        <div class="row">
            @foreach ($form_register as $row)
                <div class="col-12 col-lg-3">
                    <div class="card card-body bg-white">
                        <div class="line" style="background-color: {{ $row->color  }}"></div>
                        <div class="flexbox">
                            <span class="icon ti-clipboard fs-40" style="color: {{ $row->color  }}"></span>
                            <a href="{{ url('admin/registrasi') }}?id={{ $row->id }}">
                                <span class="fs-40" style="color: {{ $row->color  }}">
                                    {{ count($row->hasRegister) }}
                                </span>
                            </a>
                        </div>
                        <div class="text-right">
                            <a href="{{ url('admin/registrasi') }}?id={{ $row->id }}"><span class="color" style="color: {{ $row->color  }}">{{ $row->form_name }}</span></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection

@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
@section('custom-style')
    <link href="{{ asset('themes/vendor/spinkit/spinkit.css') }}" rel="stylesheet">
    <style type="text/css">
        .bg-color{
            background-color: {{  $register->thisFormRegister->color }} !important;
        }
        .current-color{
            color: {{  $register->thisFormRegister->color }} !important;
        }
        .title{
            display: flex;
            flex-direction: row;
        }
        h2{
            color : #888;
            font-weight: bold;
            position: relative;
            font-size: 20px;
        }
        h2:after{
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0px;
            width: 90%;
            background-color: {{  $register->thisFormRegister->color }};
            height: 3px;
        }
        .left-content{
            padding-left: 40px !important;
            position: relative;
        }
        .left-content:after{
            content: '';
            position: absolute;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 10px;
            background-color: {{  $register->thisFormRegister->color }};
        }
        .table{
            font-size: 16px;
            line-height: 36px;
        }
    </style>
@endsection
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body d-flex flex-row">
                        <div class="col-9 p-3 left-content" id="content">
                            @foreach ($register->thisFormRegister->hasStep as $step)
                                <div class="title">
                                    <h2>{{ $step->step_name }}</h2>
                                </div>
                                <table class="table table-borderd table-hover table-striped mt-3">
                                    @foreach (json_decode($step->metadata) as $metadata)
                                        <tr>
                                            <th width="25%">{{ $metadata->label }}</th>
                                            <td>: {!! renderMeta($register,$step,$metadata->field_name,$metadata->type) !!}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endforeach
                        </div>
                        <div class="col-3 nav-form-register">
                            
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
<script>
</script>
@endsection
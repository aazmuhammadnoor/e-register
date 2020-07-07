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
        .current-btn{
            background-color: {{  $register->thisFormRegister->color }} !important;
            border: none;
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
        .nav-form-register{
            box-shadow: -8px 3px 5px #888;
            position: fixed;
            bottom: 0px;
            right: 30px;
            height: calc(100vh - 60px);
            background-color: #fff;
        }
        .register-info{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        .register-info h1{
            line-height: 15px;
            color : #888;
        }
        .register-info h5{
            color: {{  $register->thisFormRegister->color }};
        }
        .card-body{
            position: relative;
        }
    </style>
@endsection
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            <li class="breadcrumb-item active">{{ $register->register_number }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body d-flex flex-row">
                        <div class="col-8 p-3 left-content" id="content">
                            <div class="register-info mb-5">
                                <div>
                                    <h1>{{ $register->register_number }}</h1>
                                    <h5>{{ $register->thisRegistant->email }}</h5>
                                </div>
                                <h5><i>{{ $register->updated_at->format('d F Y') }}</i></h5>
                            </div>
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
                        <div class="col-3 nav-form-register p-4">
                            <button class="btn btn-danger current-btn" id="print">
                                <i class="icon ti-printer"></i> Print
                            </button>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>

<div class="modal fade" id="print-prepare">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Print</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.register.print',[$register->id]) }}" method="POST" target="_blank">
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach ($fields as $element)
            <div class="title">
                <h2>{{ $element['name'] }}</h2>
            </div>
            <div class="row">
                @foreach ($element['fields'] as $field)
                    <div class="col-3">
                       <input type="checkbox" name="field_name[]" value="{{ $field['field_name'] }}" checked=""> {{ $field['label'] }}
                    </div>
                @endforeach
            </div>
        @endforeach
      </div>
      <div class="modal-footer justify-content-between">
        <a href="#!" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
        <button type="submit" class="btn btn-secondary current-btn">Print</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click','#print',function(e)
    {
        $('#print-prepare').modal('show');
    })
</script>
@endsection
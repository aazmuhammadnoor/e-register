@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
@section('custom-style')
    <style type="text/css">
        .custom-list{
            list-style: none;
            padding: 2px;
        }
        .custom-list li{
            border : 1px solid #888888;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 10px;
            padding-left: 50px;
            position: relative;
        }
        .custom-list li .line{
            content: '';
            position: absolute;
            height: 80%;
            width: 10px;
            z-index: 5;
            left: 10px;
            padding: 10px 0px 10px 0px;
            top: 10px;
        }
        .custom-list li:hover{
            background-color: #F3F5F7;
        }
        .custom-list li .title{
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
        }
        .custom-list li .navigation{
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
        }
        .label{
            padding: 5px 7px 5px 7px;
            border-radius: 4px;
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
    				<div class="card-body">
                        @include('flash::message')
    					@include('master_data.form_register.toolbar')
    					@if($form_register->count() > 0)
                            <ul class="custom-list">
                                @foreach($form_register as $row)
                                 <li>
                                     <div class="line" style="background-color: {{$row->color}} !important"></div>
                                     <div class="title">
                                         <h4>{{ $row->form_name }}</h4>
                                         <span>
                                             <small>{{ $row->created_at->format('d F Y') }}</small>
                                         </span>
                                     </div>
                                     <div class="navigation">
                                        <div>
                                            @if($row->is_active == 1)
                                                <label class="label bg-success">Aktif</label>
                                            @else
                                                <label class="label bg-danger">Tidak Aktif</label>
                                            @endif
                                        </div>
                                        <div>
                                             <a href="{{ route('admin.form.register.show',[$row->id]) }}" class="btn btn-warning btn-sm" data-provide="tooltip" data-original-title="Kelola Form">
                                                 <i class="ti ti-arrow-right"></i></a>
                                             <a href="{{ route('admin.form.register.edit',[$row->id]) }}" class="btn btn-info btn-sm" data-provide="tooltip" data-original-title="Ubah">
                                                 <i class="ti ti-pencil"></i></a>
                                             <a class="btn btn-danger konfirmasi btn-sm" href="{{ route('admin.form.register.delete', [$row->id,'delete']) }}" data-title="{{ $row->form_name }}" data-provide="tooltip" data-original-title="Hapus">
                                                 <i class="ti ti-trash"></i></a>
                                        </div>
                                     </div>
                                 </li>
                                @endforeach
                            </ul>
                            {!! $form_register->links() !!}
    					@else
    						<div class="alert alert-danger">
    							Belum ada Data
    						</div>
    					@endif
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
$('#search').keypress(function (e) {
 var key = e.which;
 if(key == 13) 
 {
    var value = $(this).val();
    window.location.href= "{{ url('referensi/perizinan/search') }}/"+value+"";
  }
});
</script>
@endsection
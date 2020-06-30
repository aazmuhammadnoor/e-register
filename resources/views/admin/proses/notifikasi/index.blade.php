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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
    					@if($notif->count() > 0)
    						<table class="table table-sm table-striped table-hover" data-provide="selectall selectable">
    							{{-- <thead class="thead-default">
    								<tr>
                                        <th width="200">Permohonan</th>
    								</tr>
    							</thead> --}}
    							<tbody>
    								@foreach($notif as $row)
                                    @php
                                        $data = json_decode($row->data);
                                    @endphp
                                    <tr>
                                        <td>
                                            @include('admin.proses.notifikasi.jenis_notif')
                                        </td>
                                    </tr>
                                    @endforeach
    							</tbody>
    						</table>
                            {!! $notif->appends($r->all())->links() !!}
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
@endsection

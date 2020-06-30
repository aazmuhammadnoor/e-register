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
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }} @include('page.pengumuman.toolbar')</h4>
    				<div class="card-body">
                        @include('flash::message')
                        
    					@if($rs->count() > 0)
    						<table class="table table-hover table-responsive table-bordered table-striped" data-provide="datatables" data-ordering="false">
    							<thead>
    								<tr>
    									<th>Pengumuman</th>
                                        <th class="text-center" width="80">Publish</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $r)
    								<tr>
    									<td>{{ $r->judul }}</td>
                                        <td class="text-center">{{ $r->publish }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/pengumuman', [$r->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="{{ $r->judul }}" href="{{ url('admin/pengumuman', [$r->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@endforeach
    							</tbody>
    						</table>
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
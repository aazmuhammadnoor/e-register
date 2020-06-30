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
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.pendaftar.toolbar')
    					@if($pendaftar->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Username</th>
                                        <th>Email</th>
    									<th>Tanggal Daftar</th>
                                        <th>Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($pendaftar as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{{ $rs->nama }}</td>
                                        <td>{{ $rs->username }}</td>
                                        <td>{{ $rs->email }}</td>
    									<td>{{ \Carbon\Carbon::parse($rs->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ url('admin/pendaftar/edit',[$rs->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="ti-pencil"></i> Edit
                                            </a>
                                            @if(\Auth::user()->roles()->first()->id == 1)
                                            <a data-title="{{ $rs->username }}" href="{{ url('admin/pendaftar', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi btn btn-danger btn-sm text-white">
                                                <i class="ti-trash"></i>
                                            @endif
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $pendaftar->links() }}
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
@section('scripts')
    <script type="text/javascript">
        $("#menu-pendaftar").addClass("active open");
    </script>
@endsection
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
                        @include('publik.tutorial.toolbar')
    					@if($tutorial->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Judul Tutorial</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($tutorial as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{{ $rs->judul_tutorial }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/tutorial', [$rs->id,'view']) }}" class="table-action hover-primary">
                                                <i class="ti-eye"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $tutorial->links() }}
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
        $("#menu-tutorial").addClass("active open");
    </script>
@endsection
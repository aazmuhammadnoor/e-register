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
    					@include('page.user.toolbar')
    					@if($user->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Notifikasi</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($user as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->name }}</td>
                                        <td>{{ $rs->email }}</td>
                                        <td class="text-danger">{{ $rs->username }}</td>
                                        <td class="text-success">
                                            @if($rs->is_admin)
                                                Super Administrator
                                            @else
                                                @if($rs->roles()->count() > 0)
                                                    {{ $rs->roles()->first()->name }}
                                                @else
                                                n/a
                                                @endif
                                            @endif
                                        </td>
                                        <td class="{{ ($rs->email_notif == 1) ? 'text-success' : 'text-danger' }}">
                                            {{ ($rs->email_notif == 1) ? 'Ya' : 'Tidak' }}
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/config/users', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            @if($rs->id != 1)
                                            <a data-title="{{ $rs->name }}" href="{{ url('admin/config/users', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                            @endif
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $user->links() }}
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

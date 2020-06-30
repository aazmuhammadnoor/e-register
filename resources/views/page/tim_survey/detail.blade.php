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
    					@include('page.tim_survey.toolbar_detail')
    					@if($user->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
    									<th>Instansi</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($user as $rs)
                                      @if($rs->tim == true)
        								<tr>
        									<td class="text-center">{{ $no }}</td>
                                            <td>{{ $rs->name }}</td>
                                            @php
                                                $num_tim_survey = App\Models\TimSurvey::userBy($rs->id)->count();
                                                $tim_survey = App\Models\TimSurvey::userBy($rs->id)->first();
                                            @endphp
                                            @if($num_tim_survey == 0)
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td class="text-center table-actions">
                                                    <a href="#!" class="table-action hover-primary addTimSurvey" title="Tambah ke Tim Survey" data-user="{{ $rs->id }}">
                                                        <i class="ti-plus"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td>{{ $tim_survey->nip }}</td>
                                                <td>{{ $tim_survey->jabatan }}</td>
                                                <td>{{ $tim_survey->instansi }}</td>
                                                <td class="text-center table-actions">
                                                    <a href="#!" class="table-action hover-primary editTimSurvey" title="Edit Tim Survey" data-user="{{ $rs->id }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </td>
                                            @endif
        								</tr>
                                        @php $no++; @endphp
                                      @endif
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

    <!-- Modal -->
    <div class="modal fade" id="timSurveyModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
        </div>
      </div>
    </div>
</main>
@endsection

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

            <div class="col-6">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="card-body">
                        {{ Form::open(['url' => 'konsultasi/map','id'=>'konsultasi-form']) }}
                        
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Konsultasi *</label>
                            <div class="col-sm-8">
                                <select name="jenis_konsultasi" class="form-control form-control-sm"
                                 data-provide="loader" data-url="{{url('konsultasi/kategori')}}" data-target="#loader-konsultasi" id="konsultasi" required="required">
                                    <option value="">Jenis Konsultasi </option>
                                    <option value="izin">Izin</option>
                                    <option value="investasi">Investasi</option>
                                </select>
                            </div>
                        </div>
                        <div id='izin-cat'>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kategori Izin</label>
                                <div class="col-sm-8"  id="loader-konsultasi">
                                    <select name="kategori_izin" class="form-control form-control-sm" data-provide="loader" data-url="{{url('konsultasi/izin')}}" data-target="#loader-izin" id="izin" required="required">
                                    </select>
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jenis Izin </label>
                                <div class="col-sm-8" id="loader-izin">
                                    <select name="izin" class="form-control form-control-sm" required="required">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="invest-cat">
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kecamatan *</label>
                            <div class="col-sm-8">
                                <select name="kecamatan" class="form-control form-control-sm" data-provide="loader" data-url="{{url('konsultasi/kelurahan')}}" data-target="#loader-kelurahan" id="kecamatan" required="required">
                                    <option value="">Kecamatan</option>
                                    @foreach($kecamatan as $kc)
                                        <option value="{{ $kc->id }}">{{$kc->name}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kelurahan</label>
                            <div class="col-sm-8" id="loader-kelurahan">
                                <select name="kelurahan" class="form-control form-control-sm" data-provide="loader" data-url="{{url('konsultasi/padukuhan')}}" data-target="#loader-padukuhan"  id="kelurahan" required="required">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Padukuhan</label>
                            <div class="col-sm-8" id="loader-padukuhan">
                                <select name="padukuhan" class="form-control form-control-sm" id="padukuhan" required="required">
                                </select>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm proses-btn-custom">
                            <label><i class="ti-loop"></i></label> 
                            Proses
                        </button>
                    </footer>
                        {{ Form::close() }}
                </div>
            </div>

            <!-- mapping -->
            <div class="col-6">
                <div class="card custom-card-mapping">
                    <h4 class="card-title">Peta
                        <button type="button" class="btn btn-sm btn-primary pull-right button-add-konsultasi" data-toggle="modal" style="display: none" data-target="#modal-add-konsultasi"><i class="ti ti-plus"></i> Tambah Data Pemohon</button>
                    </h4>
                    <div class="card-body">
                        <div class="alert alert-info" role="alert" id="alert-custom-info">
                            <h5><i class="ti-info-alt"></i> Info</h5><hr/>
                            Untuk menampilkan peta anda, harus mengisi form yang ada disebelah ini.
                        </div>
                    </div>

                </div>
            </div>
            <!-- end mapping -->

    		<div class="col-12">
    			<div class="card">
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.konsultasi.toolbar')
    					@if($rs->count() > 0)
    						@php $no=1; @endphp
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Nama </th>
                                        <th>Jenis Konsultasi</th>
    									<!-- <th>Resume</th> -->
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $dt)
                                        @php
                                            $unser = (object) unserialize($dt->detail_konsultasi);
                                        @endphp
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{{ $unser->nama_pemohon }}</td>
                                        <td>{{ $dt->jenis }}</td>
    									<!-- <td>{{ str_limit($dt->rangkuman,150, ' (...)') }}</td> -->
                                        <td class="text-center table-actions">     
                                            <a href="{{ url('konsultasi/edit',[$dt->id]) }}" class="table-action hover-info ">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a href="{{ url('konsultasi/print',[$dt->id]) }}" class="table-action hover-info " target="_blank">
                                                <i class="ti-printer"></i>
                                            </a>
                                            <a data-title="{{ $dt->jenis }}" href="{{ url('konsultasi/delete', [$dt->id]) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $rs->links() }}
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

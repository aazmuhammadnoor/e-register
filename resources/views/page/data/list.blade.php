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
    				<h4 class="card-title"><span class="fs-16 text-success">Semua Permohonan </span> {{ $title }} </h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.data.toolbar')
                        {!! Form::open(['url'=>'dinas/data-perizinan','method'=>'get','class'=>'form-inline pull-right']) !!}
                        <div class="form-group">
                            {!! Form::text('nama_pemohon',$r['nama_pemohon'],['class'=>'form-control','placeholder'=>'Nama Pemohon']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('nik',$r['nik'],['class'=>'form-control','placeholder'=>'NIK/No Identitas']) !!}
                        </div>
                        <!--<div class="form-group">
                            {!! Form::text('nomor_sk',$r['nomor_sk'],['class'=>'form-control','placeholder'=>'Nomor SK']) !!}
                        </div>-->
                        <div class="form-group">
                            {!! Form::text('ket_badan_usaha',$r['ket_badan_usaha'],['class'=>'form-control','placeholder'=>'Nama Badan/Usaha']) !!}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari Data</button>
                        </div>
                        {!! Form::close() !!}
                        <div style="clear:both;"></div>
                        <hr/>
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th>Permohonan</th>
                                        <th>No SK</th>
                                        <th>Tgl SK</th>
    									<th width="150" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->nama_pemohon }}</strong><br/><small>NIK : {{ $row->nik }}</small></td>
                                        <td>
                                                {{ ($row->izin !=99)  ? $row->getIzin->name : "N/A" }}
                                                {!! (!is_null($row->ket_badan_usaha)) ? "<br/><small class='text-info'>".$row->badan_usaha."/".$row->ket_badan_usaha."</small>" : "" !!}
                                        </td>
                                        <td>{{ $row->getFinal->nomor_sk }}</td>
                                        <td>{{ $row->getFinal->tgl_penetapan->format('d/m/Y') }}</td>
                                        <td class="text-center table-actions">
                                            @can('view-detail-pendaftaran')
                                            <a href="#" class="hover-primary btn btn-sm btn-default"
                                                data-url="{{ url('perizinan/perndaftaran/view',[$row->id]) }}"
                                                data-title="Detail Data Pendaftaran" data-type="fill" data-size="lg"
                                                data-provide="tooltip modaler" data-original-title="View Data Pendaftaran">
                                                <i class="ti-layers"></i> Lihat
                                            </a>
                                            @endcan
                                        </td>
    								</tr>
    								@php $no++ @endphp
    								@endforeach
    							</tbody>
    						</table>
                            {!! $rs->appends($r->all())->links() !!}
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

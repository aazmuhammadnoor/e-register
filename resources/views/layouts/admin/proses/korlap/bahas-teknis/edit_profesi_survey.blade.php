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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/korlap') }}">Daftar Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Permohonan</td>
								<td>: {{ $per->getIzin ? $per->getIzin->nama : "N/A" }}</td>
							</tr>
							<tr>
								<td>Nomor Pendaftaran Sementara</td>
								<td>: <strong class='text-danger'>{{ $per->no_pendaftaran_sementara }}</strong></td>
							</tr>
							<tr>
								<td>Nomor Pendaftaran</td>
								<td>: {{ $per->no_pendaftaran }}</td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="200">N I K</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->nik : '' }}</td>
								<td width="200">Nama Lengkap</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->nama : '' }}</td>
							</tr>
							<tr>
								<td width="200">Gelar Depan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->gelar_depan : '' }}</td>
								<td width="200">Gelar Belakang</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->gelar_belakang : '' }}</td>
							</tr>
							<tr>
								<td width="200">Tempat Lahir</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->tempat_lahir : '' }}</td>
								<td width="200">Tanggal Lahir</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->tanggal_lahir : '' }}</td>
							</tr>
							<tr>
								<td width="200">Jenis Kelamin</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->jenis_kelamin : '' }}</td>
								<td width="200">Agama</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->getAgama->name : '' }}</td>
							</tr>
							<tr>
								<td width="200">Status Perkawinan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->status_perkawinan : '' }}</td>
								<td width="200">Pekerjaan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->pekerjaan : '' }}</td>
							</tr>
							<tr>
								<td width="200">Email</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->email : '' }}</td>
								<td width="200">Nomor Telepon</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->no_telp : '' }}</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->alamat : '' }}</td>
								<td>Kelurahan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->getKelurahan->name : '' }} RT {{ $per->getPemohon ? $per->getPemohon->rt : '' }} RW {{ $per->getPemohon ? $per->getPemohon->rw : '' }}</td>

							</tr>
							<tr>
								<td>Kecamatan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->getKecamatan->name : '' }}</td>
								<td>Kabupaten / Kota</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->getKabupaten->name : '' }}</td>
							</tr>
							<tr>
								<td>Provinsi</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->getProvinsi->name : '' }}</td>
								<td>Kode Pos</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->kode_pos : '' }}</td>
							</tr>
							<tr>
								<td width="200">Kewarganegaraan</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->kewarganegaraan : '' }}</td>
								<td width="200">Nomor Passpor</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->nomor_passpor : '' }}</td>
							</tr>
							<tr>
								<td width="200">Tempat Terbit Passpor</td>
								<td>: {{ $per->getPemohon ? $per->getPemohon->tempat_terbit_passpor : '' }}</td>
								<td width="200"></td>
								<td></td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PROFESI</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Profesi</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->profesi->nama : '' }}</td>
								<td width="200">Nomor STR</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->nomor_str : '' }}</td>
							</tr>
							<tr>
								<td width="200">Penerbit</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->penerbit : '' }}</td>
								<td width="200">Berlaku Sampai</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->berlaku_sampai : '' }}</td>
							</tr>
							<tr>
								<td width="200">Kota Terbit</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->kota_terbit : '' }}</td>
								<td width="200">Jenis Cetakan STR</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->jenis_cetakan_str : '' }}</td>
							</tr>
							<tr>
								<td width="200">Jenis PT</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->jenis_pt : '' }}</td>
								<td width="200">Nama PT</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->nama_pt : '' }}</td>
							</tr>
							<tr>
								<td width="200">Tahun Lulus</td>
								<td>: {{ $per->getProfesi ? $per->getProfesi->tahun_lulus : '' }}</td>
								<td width="200"></td>
								<td></td>
							</tr>
						</table>
						<div class="divider text-primary">LOKASI PERIZINAN</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Lokasi Perizinan</td>
								<td>: {{ $per->alamat_permohonan }}, {{ $per->lokasi_kel }}, {{ $per->lokasi_kec }}, Kota Palembang</td>
							</tr>
							<tr>
								<td>Koordinat Lokasi Perizinan</td>
								<td>: {{ $per->koordinat }}</td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PERMOHONAN</div>
						<table class="table-dot table-sm">
							@foreach($meta as $key=>$val)
								<tr>
									<td width="200">{{ title_case(str_replace("_"," ",$key)) }}</td>
									<td>:
										@if(is_array($val))
											{{ join($val,",") }}
										@else
											{{ $val }}
										@endif
									</td>
								</tr>
							@endforeach							
						</table>
						<div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
						<table class="table table-sm">
							<thead>
								<tr>
									<th>Persyaratan</th>
									<th>Lampiran</th>
									<th>Sesuai/Tidak</th>
								</tr>
							</thead>
							<tbody>
							@foreach($per->getVerifikasi as $ver)
								<tr>
									<td>{{ $ver->getSyarat->name }}</td>
									<td class="text-center">
										{!! ($ver->ada_tidak) ? "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" : "-" !!}
									</td>									
									<td class="text-center">
										{!! Form::checkbox('sesuai_tidak['.$ver->id.']', 1, ($ver->sesuai_tidak) ? true : false,['class'=>'cek-file']) !!}
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="divider text-primary">HISTORI CATATAN</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Catatan Pendaftaran</td>
								<td>: {{ $per->catatan_pemeriksaan }}</td>
							</tr>
							<tr>
								<td width="200">Catatan KASI</td>
								<td>: {{ $per->catatan_kasi_approval_berkas }}</td>
							</tr>
						</table>
						<div class="divider text-primary">INPUT DATA SURVEY</div>
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-6">
		                            <div class="form-group{{ $errors->has('tanggal_survey') ? ' has-error' : '' }} row">
		                                <label class="col-sm-3 control-form-label require">Tanggal Survey</label>
		                                <div class="col-sm-5">
			                                <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_survey" value="{{ $survey ? $survey->tgl_survey : '' }}">
			                                @if ($errors->has('tanggal_survey'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('tanggal_survey') }}</strong>
			                                    </span>
			                                @endif		                                	
		                                </div>
		                                <div class="col-sm-4">
				                            <button class="btn btn-label btn-secondary" type="submit"><label><i class="ti-save"></i></label> Simpan</button>
		                                </div>
		                            </div>													
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label class="control-label require">Tim Survey</label>
								</div>
							</div>
							<div class="col-12">
								<div class="btn-toolbar float-right">
									<div class="btn-group btn-group-sm">
										<button class="btn" title="" data-provide="tooltip"  data-original-title="Tambah" id="modal-tambah" data-toggle="modal" data-target="#modal-survey"><i class="ti-plus"></i> Tambah</button>
									</div>
								</div>									
							</div>
							<div class="col-12">
								@if(!empty($surveyUser) && $surveyUser->count() > 0)
	    						<table class="table table-sm table-striped small">
	    							<thead class="thead-default">
	    								<tr>
	                                        <th class="text-center" width="32">No</th>
	                                        <th width="200">Tim Survey</th>
	                                        <th width="120" class="text-center">Status</th>
	    									<th width="50" class="text-center">Aksi</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								@php $no = 1; @endphp
	    								@foreach($surveyUser as $row)	    								
	    								<tr>
	    									<td class="text-right">{{ $no }}</td>
	    									<td>{{ $row->getUser->name }}</td>
	    									<td class="text-center">{{ $row->status == 1 ? 'Ketua Tim' : 'Anggota Tim' }}</td>
	    									<td class="text-center">
												<a href="{{ url('admin/proses/korlap/delete',[$row->id,$per->id]) }}"
	                                                class="table-action hover-primary"
    	                                            data-provide="tooltip" data-original-title="Hapus">
        	                                        <i class="ti-trash"></i>
                                            	</a>	    										
	    									</td>
	    								</tr>
	    								@php $no++; @endphp
	    								@endforeach	    								
									</tbody>
								</table>       
		    					@else
		    						<div class="alert alert-danger mt-10">
		    							Belum ada tim survey
		    						</div>
		    					@endif
							</div>								
						</div>
						<div class="form-group">
                            <a href="{{ url('admin/proses/korlap/submit',[$per->id]) }}" class='btn btn-label btn-primary'><label><i class="ti-check"></i></label> Submit</a>
                            <a href="{{ url('admin/proses/korlap') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Tutup</a>
						</div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal modal-center fade" id="modal-survey" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><span class="icon ti-plus"></span> Tambah Tim Survey</h5>
	        <button type="button" class="close" data-dismiss="modal">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
	        {{ csrf_field() }}
	        <div class="modal-body px-30">
                <div class="form-group">
                    <label for="id_user" class="control-label require">Nama</label>
                    <select id="id_user" class="form-control show-tick" data-provide="selectpicker" title="Pilih Tim..." name="id_user" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>                                        
                </div>
	            <div class="form-group">
					<label for="email">Status</label>
                    <select id="status" class="form-control show-tick" data-provide="selectpicker" title="Pilih Status..." name="status" required>
                        <option value="1">Ketua Tim</option>
                        <option value="2">Anggota Tim</option>
                    </select>                                        
	            </div>
	        </div>
	        <div class="modal-footer p-30">
	            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
	            <button class="btn btn-label btn-danger" data-dismiss="modal"><label><i class="ti-close"></i></label> Batal</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

@include('layouts.footer')
@endsection
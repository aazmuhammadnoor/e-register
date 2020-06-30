@if($per->izin_lama)
	<div class="alert alert-warning">
		Data dari Aplikasi Perizinan Lama
	</div>
@endif
<table class="table table-sm">
	<tr>
		<td width="200">Permohonan</td>
		<td>: {{ ($per->izin!= 99) ? $per->getIzin->nama : "N/A" }}</td>
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
<div class="divider text-primary">DATA PENDAFTARAN</div>
<table class="table table-sm">
	<tr>
		<td width="200">Nama Pemohon</td>
		<td>: {{ $per->nama_pemohon }}</td>
	</tr>
	<tr>
		<td>N I K</td>
		<td>: {{ $per->nik }}</td>
	</tr>
	<tr>
		<td>Nomor Telepon</td>
		<td>: {{ $per->no_telepon }}</td>
	</tr>
	<tr>
		<td>Alamat Pemohon</td>
		<td>: {{ $per->alamat_pemohon }}</td>
	</tr>
	<tr>
		<td>Lokasi Perizinan</td>
		<td>: {{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }} Palembang</td>
	</tr>
	<tr>
		<td>Koordinat Lokasi Perizinan</td>
		<td>: {{ $per->koordinat }}</td>
	</tr>
@if(!$per->izin_lama)
@foreach($meta as $key=>$val)
	<tr>
		<td>{{ title_case(str_replace("_"," ",$key)) }}</td>
		<td>:
			@if(is_array($val))
				{{ join($val,",") }}
			@else
				{{ $val }}
			@endif
		</td>
	</tr>
@endforeach
@endif
</table>
@if(!$per->izin_lama)
	<div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
	<table class="table table-sm">
	<thead>
		<tr>
			<th>Persyaratan</th>
			<th>Ada/Tidak</th>
			<th>Sesuai/Tidak</th>
		</tr>
	</thead>
	<tbody>
	@foreach($per->getVerifikasi as $ver)
		<tr>
			<td>{{ $ver->getSyarat->name }}</td>
			<td class="text-center">{!! ($ver->ada_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
			<td class="text-center">{!! ($ver->lengkap_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
		</tr>
	@endforeach
	</tbody>
	</table>
@endif
	<div class="divider text-primary">HASIL PEMERIKSAAN</div>
	<div class="form-group">
		<div class="form-check form-check-inline">
		  <label class="form-check-label">
		    <input class="form-check-input" type="radio" name="hasil_pemeriksaan" id="inlineRadio1" value="1"> Lolos
		  </label>
		</div>
		<div class="form-check form-check-inline">
		  <label class="form-check-label">
		    <input class="form-check-input" type="radio" name="hasil_pemeriksaan" id="inlineRadio2" value="-1"> Perlu Perbaikan
		  </label>
		</div>
	</div>
	<div class="form-group">
    	<label for="alamat" class="control-label require">Catatan</label>
    	<textarea class="form-control" name="catatan_pemeriksaan"></textarea>
	</div>

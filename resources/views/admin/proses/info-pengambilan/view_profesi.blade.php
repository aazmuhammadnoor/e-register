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
						<td>Nomor Pendaftaran</td>
						<td>: <strong>{{ $per->no_pendaftaran_sementara }}</strong></td>
					</tr>
				</table>
				<div class="divider text-primary">DATA PEMOHON</div>
					@include('admin.proses.partial.data_pemohon')
				<div class="divider text-primary">DATA PROFESI</div>
					@include('admin.proses.partial.data_profesi')
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
						</tr>
					</thead>
					<tbody>
					@foreach($per->getVerifikasi as $ver)
						<tr>
							<td>{{ $ver->getSyarat->name }}</td>
							<td class="text-center">
								{!! ($ver->ada_tidak) ? "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" : "-" !!}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="divider text-primary">HISTORI CATATAN</div>
				<table class="table-dot table-sm">
					<tr>
						<td width="300">Catatan Pendaftaran</td>
						<td>: {{ $per->catatan_pemeriksaan }}</td>
					</tr>
					<tr>
						<td>Catatan KASI (Persetujuan Berkas)</td>
						<td>: {{ $per->catatan_kasi_approval_berkas }}</td>
					</tr>
					<tr>
						<td>Catatan Korlap (Pembahasan Teknis)</td>
						<td>: {{ $per->catatan_pembahasan_teknis }}</td>
					</tr>
					<tr>
						<td>Catatan KASI (Persetujuan Draft SK)</td>
						<td>: {{ $per->catatan_kasi_approval_draft }}</td>
					</tr>
					<tr>
						<td>Catatan KABID (Persetujuan Draft SK)</td>
						<td>: {{ $per->catatan_kabid_approval_draft }}</td>
					</tr>
					<tr>
						<td>Catatan KADIN (Tanda Tangan Draft SK)</td>
						<td>: {{ $per->catatan_kadin_approval_draft }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
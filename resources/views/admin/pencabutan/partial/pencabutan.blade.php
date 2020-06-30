<table class="table-dot table-sm">
	<tr>
		<td width="20%">Permohonan</td>
		<td>: {{ $per->getIzin ? $per->getIzin->nama : "N/A" }}</td>
	</tr>
	<tr>
		<td>Nomor Pendaftaran Pencabutan</td>
		<td class="text-danger">: {{ $pen->no_pencabutan }}</td>
	</tr>
	<tr>
		<td>SK Izin</td>
		<td>: 
			<a href="{{ url('admin/proses/pengambilan/sk',[$per->id]) }}"
                class="table-action hover-danger p-1 text-white btn btn-info btn-sm"
                data-provide="tooltip" data-original-title="SK" target="_blank">
                <i class="ti-download"></i> Download SK
            </a> 
		</td>
	</tr>
	<tr>
		<td colspan="2" style="background-color: #999"></td>
	</tr>
	@if($pen->no_sk)
	<tr>
		<td>Nomor SK Pencabutan</td>
		<td>: {{ $pen->no_sk }}</td>
	</tr>
	@endif
	@if($pen->tgl_penetapan)
	<tr>
		<td>Tanggal Penetapan</td>
		<td>: {{ date_id($pen->tgl_penetapan) }}</td>
	</tr>
	@endif
	@if($pen->posisi == "selesai")
		<tr>
			<td>SK Pencabutan</td>
			<td>: 
				<a href="{{ url('admin/pencabutan/download-sk',[$pen->id]) }}"
	                class="table-action hover-danger p-1 text-white btn btn-danger btn-sm"
	                data-provide="tooltip" data-original-title="SK" target="_blank">
	                <i class="ti-download"></i> Download SK Pencabutan
	            </a> 
			</td>
		</tr>
	@endif
</table>
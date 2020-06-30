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
				{!! 
					(file_exists(storage_path('app/'.$ver->file))) ?
						($ver->file) ? 
							($ver->ada_tidak) ?
								"<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" 
							: "-"
						: "-"
					: "-"
				 !!}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
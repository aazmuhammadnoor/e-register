@if($kbli)
	<table id="tabel-kecil" data-provide='datatables' data-ordering='false'>
		<thead>
			<tr>
				<th>#</th>
				<th>Kode</th>
				<th>Nama</th>
			</tr>
		</thead>
		<tbody>
			@foreach($kbli as $kb)
				<tr>
					<td align="center"><input type="radio" class="pilihan-kbli" value="{{ $kb->kelompok }} {{ $kb->deskripsi}}"></td>
					<td align="center">{{ $kb->kelompok }}</td>
					<td>{{ $kb->deskripsi }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endif
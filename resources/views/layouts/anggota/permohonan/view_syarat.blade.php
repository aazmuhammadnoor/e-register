<table>
	<tr>
		<td width="150">Kode</td>
		<td> : <strong class="text-success">{{ $id->kode }}</strong></td>
	</tr>
	<tr>
		<td>Lama Proses</td>
		<td>: <strong class="text-success">{{ $id->lama_proses }} Hari Kerja</strong></td>
	</tr>
	<tr>
		<td>Kategori Prosedur</td>
		<td>: <strong class="text-success">{{ $id->kategoriProsedur ? $id->kategoriProsedur->nama : '' }}</strong></td>
	</tr>
	@if(!is_null($id->template_pendaftaran))
		<tr>
			<td width="150">Formulir</td>
			<td> : <a href="{{ url('download-formulir',[$id->id]) }}">{{ $id->template_pendaftaran }}</a></td>
		</tr>
	@endif
</table>
<hr/>
@if(!empty($id->jenisIzin->dasar_hukum))
	<h6>Dasar Hukum</h6>
	{!! $id->jenisIzin->dasar_hukum !!}
	<hr/>
@endif

<h6>Persyaratan</h6>
@if($id->syarat()->count() > 0)
	<ol>
	@foreach($id->syarat()->get() as $sy)
		<li>{{ $sy->name }}</li>
	@endforeach
	</ol>
@endif
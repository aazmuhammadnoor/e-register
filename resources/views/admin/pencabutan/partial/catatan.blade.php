<div class="divider text-primary">CATATAN</div>
<table class="table-dot table-sm">
	@if($pen->catatan != '' && $pen->catatan != null)
		<tr>
			<td width="200">Catatan Pemohon</td>
			<td>: {{ $pen->catatan }}</td>
		</tr>
	@endif
	@if($pen->catatan_pendaftaran != '' && $pen->catatan_pendaftaran != null)
		<tr>
			<td width="200">Catatan Pendaftaran</td>
			<td>: {{ $pen->catatan_pendaftaran }}</td>
		</tr>
	@endif
	@if($pen->catatan_kasi != '' && $pen->catatan_kasi != null)
		<tr>
			<td width="200">Catatan Kasi</td>
			<td>: {{ $pen->catatan_kasi }}</td>
		</tr>
	@endif
	@if($pen->catatan_kabid != '' && $pen->catatan_kabid != null)
		<tr>
			<td width="200">Catatan Kabid</td>
			<td>: {{ $pen->catatan_kabid }}</td>
		</tr>
	@endif
	@if($pen->catatan_kadin != '' && $pen->catatan_kadin != null)
		<tr>
			<td width="200">Catatan Kadin</td>
			<td>: {{ $pen->catatan_kadin }}</td>
		</tr>
	@endif
	@if($pen->catatan_pengambilan != '' && $pen->catatan_pengambilan != null)
		<tr>
			<td width="200">Catatan Pengambilan</td>
			<td>: {{ $pen->catatan_pengambilan }}</td>
		</tr>
	@endif
	@if($pen->catatan_arsip != '' && $pen->catatan_arsip != null)
		<tr>
			<td width="200">Catatan Arsip</td>
			<td>: {{ $pen->catatan_arsip }}</td>
		</tr>
	@endif
</table>
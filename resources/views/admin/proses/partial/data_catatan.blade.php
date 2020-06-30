@if($per->catatan_pemeriksaan != '' && $per->catatan_pemeriksaan != null)
	<tr>
		<td width="200">Catatan Pendaftaran</td>
		<td>: {{ $per->catatan_pemeriksaan }}</td>
	</tr>
@endif

@if($per->catatan_kasi_approval_berkas != '' && $per->catatan_kasi_approval_berkas != null)
	<tr>
		<td width="200">Catatan Kasi Approval Berkas</td>
		<td>: {{ $per->catatan_kasi_approval_berkas }}</td>
	</tr>
@endif

@if($per->catatan_pembahasan_korlap != '' && $per->catatan_pembahasan_korlap != null)
	<tr>
		<td width="200">Catatan Pembahasan Korlap</td>
		<td>: {{ $per->catatan_pembahasan_korlap }}</td>
	</tr>
@endif

@if($per->catatan_bap_korlap != '' && $per->catatan_bap_korlap != null)
	<tr>
		<td width="200">Catatan BAP Korlap</td>
		<td>: {{ $per->catatan_bap_korlap }}</td>
	</tr>
@endif

@if($per->catatan_pembahasan_teknis != '' && $per->catatan_pembahasan_teknis != null)
	<tr>
		<td width="200">Catatan Pembahasan Teknis</td>
		<td>: {{ $per->catatan_pembahasan_teknis }}</td>
	</tr>
@endif

@if($per->catatan_spm != '' && $per->catatan_spm != null)
	<tr>
		<td width="200">Catatan SPM</td>
		<td>: {{ $per->catatan_spm }}</td>
	</tr>
@endif

@if($per->catatan_pembayaran != '' && $per->catatan_pembayaran != null)
	<tr>
		<td width="200">Catatan Pembayaran</td>
		<td>: {{ $per->catatan_pembayaran }}</td>
	</tr>
@endif

@if($per->catatan_hasil_pembayaran != '' && $per->catatan_hasil_pembayaran != null)
	<tr>
		<td width="200">Catatan Hasil Pembayaran</td>
		<td>: {{ $per->catatan_hasil_pembayaran }}</td>
	</tr>
@endif

@if($per->catatan_kasi_approval_draft != '' && $per->catatan_kasi_approval_draft != null)
	<tr>
		<td width="200">Catatan Kasi Approval SK</td>
		<td>: {{ $per->catatan_kasi_approval_draft }}</td>
	</tr>
@endif

@if($per->catatan_kabid_approval_draft != '' && $per->catatan_kabid_approval_draft != null)
	<tr>
		<td width="200">Catatan Kabid Approval SK</td>
		<td>: {{ $per->catatan_kabid_approval_draft }}</td>
	</tr>
@endif

@if($per->catatan_kadin_approval_draft != '' && $per->catatan_kadin_approval_draft != null)
	<tr>
		<td width="200">Catatan Kadin Approval SK (Tanda Tangan SK)</td>
		<td>: {{ $per->catatan_kadin_approval_draft }}</td>
	</tr>
@endif

@if($per->catatan_pengambilan != '' && $per->catatan_pengambilan != null)
	<tr>
		<td width="200">Catatan Pengambilan</td>
		<td>: {{ $per->catatan_pengambilan }}</td>
	</tr>
@endif

@if($per->catatan_arsip != '' && $per->catatan_arsip != null)
	<tr>
		<td width="200">Catatan Arsip</td>
		<td>: {{ $per->catatan_arsip }}</td>
	</tr>
@endif


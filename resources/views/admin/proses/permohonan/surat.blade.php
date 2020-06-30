@if($surat->count() > 0)
	<table class="table small table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center" width="32">NO</th>
				<th>Tanggal</th>
				<th>Surat</th>
				<th class="text-center">Download</th>
			</tr>
		</thead>
		<tbody>
			@php $no=1 @endphp
			@foreach($surat as $srt)
				<tr>
					<td style="padding:2px;" class="text-center">{{ $no }}</td>
					<td style="padding:2px 4px;">{{ $srt->created_at->format('d/m/Y')}}</td>
					<td style="padding:2px 4px;">{{ $srt->jenis }}</td>
					<td class="text-center" style="padding:2px;">
						<a href="/perizinan/download-surat/{{ $srt->id }}">Download Surat</a>
					</td>
				</tr>
				@php $no++ @endphp
			@endforeach
		</tbody>
	</table>
@else
<p>Tidak ada Surat Tercatat</p>
@endif
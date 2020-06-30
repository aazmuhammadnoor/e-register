@php
    $survey = Survey::where('id_permohonan', $per->id)->first();
    $surveyUser = SurveyUser::where('id_permohonan',$per->id)->get();
    $hasilSurvey = HasilSurvey::where('id_permohonan',$per->id)->get();    
@endphp


@if(!empty($surveyUser) && $surveyUser->count() > 0)
<div class="divider text-primary">TIM SURVEY</div>
<p>Survey pada tanggal <b>{{ date_id($per->tgl_survey) }}</b></p>
<table class="table table-sm table-striped small">
	<thead class="thead-default">
		<tr>
            <th class="text-center" width="32">No</th>
            <th width="200">Tim Survey</th>
            <th width="120" class="text-center">Status</th>
		</tr>
	</thead>
	<tbody>
		@php $no = 1; @endphp
		@foreach($surveyUser as $row)
		<tr>
			<td class="text-right">{{ $no }}</td>
			<td>{{ $row->getUser->name }}</td>
			<td class="text-center">{{ $row->status == 1 ? 'Ketua Tim' : 'Anggota Tim' }}</td>
		</tr>
		@php $no++; @endphp
		@endforeach
	</tbody>
</table>
@endif

@if(!empty($hasilSurvey) && $hasilSurvey->count() > 0)
<div class="divider text-primary">HASIL SURVEY</div>
<table class="table table-sm table-striped small">
	<thead class="thead-default">
		<tr>
            <th class="text-center" width="32">No</th>
            <th width="200">Catatan</th>
            <th width="120" class="text-center">Dokumen</th>
		</tr>
	</thead>
	<tbody>
		@php $no = 1; @endphp
		@foreach($hasilSurvey as $row)
		<tr>
			<td class="text-right">{{ $no }}</td>
			<td>{{ $row->catatan }}</td>
			<td class="text-center">
				{!! "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($row->file)])."'><i class='ti-link'></i></a>" !!}
			</td>
		</tr>
		@php $no++; @endphp
		@endforeach
	</tbody>
</table>
@endif
{{-- workflow --}}
@php
	$workflow_start = \App\Models\Task::where("workflow",$per->workflow)
									->where("sub_task",$initial[$posisi]['workflow_start'])
									->where("event","mulai")
                                    ->orderBy("created_at","desc")
									->first();

	$workflow_end = \App\Models\Task::where("workflow",$per->workflow)
									->where("sub_task",$initial[$posisi]['workflow_end'])
									->where("event","selesai")
                                    ->orderBy("created_at","desc")
									->first();
@endphp
<tr>
	<td width="200">Posisi</td>
	<td>: {!! $initial[$posisi]['title'] !!}</td>
</tr>
<tr>
	<td width="200">Dari</td>
	<td>: {!! $workflow_start ? $workflow_start->executor : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="200">Diproses oleh</td>
	<td>: {!! $workflow_end ? $workflow_end->executor : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="200">Tanggal Masuk</td>
	<td>: {!! $workflow_start ? ($workflow_start->created_at) : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="200">Tanggal Selesai</td>
	<td>: {!! $workflow_end ? ($workflow_end->created_at) : "<i style='color:red'>-</i>" !!}</td>
</tr>
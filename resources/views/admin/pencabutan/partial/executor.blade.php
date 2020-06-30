{{-- workflow --}}
@php
	//dd($initial[$posisi]['workflow_start']);
	$workflow_start = \App\Models\Task::where("workflow",$pen->workflow)
									->where("sub_task",$initial[$posisi]['workflow_start'])
									->where("event","selesai")
                                    ->orderBy("created_at","desc")
									->first();

	$workflow_end = \App\Models\Task::where("workflow",$pen->workflow)
									->where("sub_task",$initial[$posisi]['workflow_end'])
									->where("event","selesai")
                                    ->orderBy("created_at","desc")
									->first();
@endphp
<tr>
	<td width="20%">Posisi</td>
	<td>: {!! $initial[$posisi]['title'] !!}</td>
</tr>
<tr>
	<td width="20%">Dari</td>
	<td>: {!! $workflow_start ? $workflow_start->executor : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="20%">Diproses oleh</td>
	<td>: {!! $workflow_end ? $workflow_end->executor : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="20%">Tanggal Masuk</td>
	<td>: {!! $workflow_start ? ($workflow_start->created_at) : "<i style='color:red'>-</i>" !!}</td>
</tr>
<tr>
	<td width="20%">Tanggal Selesai</td>
	<td>: {!! $workflow_end ? ($workflow_end->created_at) : "<i style='color:red'>-</i>" !!}</td>
</tr>
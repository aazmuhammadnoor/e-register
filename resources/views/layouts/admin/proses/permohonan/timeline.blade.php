<a href="{{ url('admin/proses/permohonan/timeline',[$per->id,'cetak']) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak </a>
<ol class="timeline timeline-activity timeline-point-sm timeline-content-right w-100 py-20 pr-20">
    @foreach($per->getWorkflowStatus->getSubtaskTimeline()->get() as $rs)
        <li class="timeline-block">
            <div class="timeline-point {{ ($rs->event == 'mulai') ? 'timeline-point-danger' : 'timeline-point-success' }}">
                <span class="badge badge-ring {{ ($rs->event == 'mulai') ? 'badge-danger' : 'badge-success' }}"></span>
            </div>
            <div class="timeline-content">
                <time datetime=""> <span class='fs-16 w-20px pe-7s-stopwatch'></span> {{ $rs->created_at->format('d/m/Y H:i') }}</time>
                <p>
                    <i class="fs-16 w-20px pe-7s-users"></i> {{ $rs->executor }} <br/>
                    <i class="fs-16 w-20px pe-7s-shuffle"></i> {{ $rs->event}}<br/>
                    <i class="fs-16 w-20px pe-7s-note2"></i>
						{{ text_status_permohonan($rs->sub_task) ? text_status_permohonan($rs->sub_task) : '' }}
						@if($rs->sub_task != $rs->next_task && $rs->executor != 'online' && $rs->event == 'selesai')
							<br/>
							<em class="text-info">{{ strip_tags($rs->next_task) }}</em>
						@else

						@endif
				</p>
            </div>
        </li>
    @endforeach
</ol>

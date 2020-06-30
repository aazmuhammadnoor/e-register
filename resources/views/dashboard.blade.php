<div class="col-12 col-lg-3">
    <div class="card card-body text-success">
        <div class="flexbox">
            <span class="ti-id-badge text-success fs-40"></span>
            <a href="{{ url('admin/inbox/total') }}"><span class="text-success fs-40">{{ $total_daftar }}</span></a>
        </div>
        <div class="text-right">
            <a href="{{ url('admin/inbox/total') }}"><span class="text-success">Total Permohonan</span></a>
        </div>
    </div>
</div>
<div class="col-12 col-lg-3">
    <div class="card card-body text-info">
        <div class="flexbox">
            <span class="ti-user text-info fs-40"></span>
            <a href="{{ url('admin/inbox/today') }}"><span class="text-info fs-40">{{ $total_daftar_hari_ini }}</span></a>
        </div>
        <div class="text-right">
            <a href="{{ url('admin/inbox/today') }}"><span class="text-info">Total Permohonan Hari Ini</span></a>
        </div>
    </div>
</div>
@if($status)
@foreach($status as $key=>$items)
<div class="col-12 col-lg-3">
    <div class="card card-body {{ $items->color }}">
        <div class="flexbox">
            <span class="{{ $items->icon }} {{ $items->color }} fs-40"></span>
            <a href="{{ url('admin/inbox',[$items->posisi]) }}"><span class="{{ $items->color }} fs-40">{{ $items->total}}</span></a>
        </div>
        <div class="text-right">
            <a href="{{ url('admin/inbox',[$items->posisi]) }}"><span class="{{ $items->color }}">{{ $items->keterangan }}</span></a>
        </div>
    </div>
</div>
@endforeach
@endif
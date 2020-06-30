{!! Form::open(['url'=>'admin/proses/cetak-spm/filter','id'=>'form-filter']) !!}
    <div class="form-group">
    <label class="require">Jenis Perizinan</label>
    <select name="jenis_permohonan_izin" data-live-search="true" class="form-control" title="Pilih Jenis Permohonan Izin" data-provide="selectpicker">
        <option value="all" selected>Semua</option>
        @foreach($list_izin as $rs)
            <option value="{{ $rs->id }}">{{ $rs->nama }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <label>Tanggal Permohonan</label>
        <div class="input-group" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <span class="input-group-addon">Dari</span>
            <input type="text" class="form-control" name="dari">
            <span class="input-group-addon">Sampai</span>
            <input type="text" class="form-control" name="sampai">
        </div>
    </div>
{!! Form::close() !!}
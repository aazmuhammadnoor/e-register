{!! Form::open(['url'=>'verifikasi/filter','id'=>'form-filter']) !!}
    <div class="form-group">
    <label class="require">Jenis Perizinan</label>
    <select name="jenis_izin" data-live-search="true" class="form-control" title="Pilih Jenis Perizinan" data-provide="selectpicker">
        <option value="all">Semua</option>
        @foreach($list_izin as $rs)
            <option value="{{ $rs->id }}">{{ $rs->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <label>Tanggal Pendaftaran</label>
        <div class="input-group" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <span class="input-group-addon">Dari</span>
            <input type="text" class="form-control" name="dari">
            <span class="input-group-addon">Sampai</span>
            <input type="text" class="form-control" name="sampai">
        </div>
    </div>
{!! Form::close() !!}
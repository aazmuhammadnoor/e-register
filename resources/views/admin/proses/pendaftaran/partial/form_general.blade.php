<div class="form-group">
	<label for="alamat" class="control-label require">Catatan</label>
	<textarea class="form-control" name="catatan_pemeriksaan">{{ $per->catatan_pemeriksaan }}</textarea>
</div>
<div class="form-group">
    <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
    <a href="{{ url('admin/proses/pendaftaran/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
</div>
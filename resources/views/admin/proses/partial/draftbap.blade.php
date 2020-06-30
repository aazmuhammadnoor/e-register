<div class="form-group">
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="hasil_bap_korlap" value="1"> Sesuai
    </label>
  </div>
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="hasil_bap_korlap" value="-1"> Perlu Perbaikan
    </label>
  </div>
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="hasil_bap_korlap" value="2"> Simpan Sebagai Draft
    </label>
  </div>
</div>
<div class="form-group">
  <label for="alamat" class="control-label require">Catatan</label>
  <textarea class="form-control" name="catatan_bap_korlap">{{ $per->catatan_bap_korlap }}</textarea>
</div>

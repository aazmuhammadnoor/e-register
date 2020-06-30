<div class="form-group">
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="hasil_pemeriksaan" value="1" checked> Lanjutkan Proses
    </label>
  </div>
  <div class="form-check form-check-inline">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="hasil_pemeriksaan" value="2"> Simpan Sebagai Draft
    </label>
  </div>
  @if(isset($isKasi))
    <div class="form-check form-check-inline">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="hasil_pemeriksaan" value="-1"> Perlu Perbaikan
      </label>
    </div>
  @endif
</div>

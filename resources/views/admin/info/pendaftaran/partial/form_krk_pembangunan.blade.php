			<div class="form-group">
				<label for="alamat" class="control-label require">Catatan Pemeriksaan</label>
				<textarea class="form-control" name="catatan_pemeriksaan">{{ $per->catatan_pemeriksaan }}</textarea>
			</div>
			<div id="spm">
				<div class="divider text-primary">INPUT DATA PEMBAYARAN</div>
                <hr/>
                <div class="form-row">
                  <div class="form-group col-3">
                      <label class="control-label require">Biaya Ukur</label>
                      {{ Form::text('kode_biaya_ukur',$ret->kode_biaya_ukur,['class'=>'krk form-control','placeholder'=>'KODE REKENING']) }}<br/>
                      {{ Form::text('biaya_ukur',$ret->biaya_ukur,['class'=>'krk rupiah form-control','placeholder'=>'JUMLAH']) }}
                  </div>
                  <div class="form-group col-3">
                      <label class="control-label require">Blanko KRK</label>
                      {{ Form::text('kode_blanko_krk',$ret->kode_blanko_krk,['class'=>'krk form-control','placeholder'=>'KODE REKENING']) }}<br/>
                      {{ Form::text('blanko_krk',$ret->blanko_krk,['class'=>'krk rupiah form-control','placeholder'=>'JUMLAH']) }}
                  </div>
                  <div class="form-group col-3">
                      <label class="control-label require">Peta KRK</label>
                      {{ Form::text('kode_peta_krk',$ret->kode_peta_krk,['class'=>'krk form-control','placeholder'=>'KODE REKENING']) }}<br/>
                      {{ Form::text('peta_krk',$ret->peta_krk,['class'=>'krk rupiah form-control','placeholder'=>'JUMLAH']) }}
                  </div>
                  <div class="form-group col-3">
                      <label class="control-label require">Denda</label>
                      {{ Form::text('kode_denda_krk',$ret->kode_denda_krk,['class'=>'krk form-control','placeholder'=>'KODE REKENING']) }}<br/>
                      {{ Form::text('denda_krk',$ret->denda_krk,['class'=>'krk rupiah form-control','placeholder'=>'JUMLAH']) }}
                  </div>
                  <div class="form-group col-12">
  									<label for="alamat" class="control-label require">Alasan Perubahan</label>
  									<textarea class="krk form-control" name="alasan_perubahan">{{ $ret->alasan_perubahan }}</textarea>
  								</div>
                </div>
                <div class="form-row">
                  <div class="form-group col-4">
                    <a href="#" id="save-spm-krk" class="btn btn-sm btn-success"><i class="ti-save"></i> Simpan SPM</a>
                    <a href="#" id="print-spm-krk" class="btn btn-sm btn-default"><i class="ti-printer"></i> Cetak SPM</a>
                  </div>
                </div>
                <hr/>
			</div>
			<div class="form-group">
                <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
                <a href="{{ url('admin/proses/pendaftaran/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
			</div>
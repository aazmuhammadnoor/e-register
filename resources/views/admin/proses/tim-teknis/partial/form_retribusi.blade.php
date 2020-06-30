			<div class="form-group">
				<label for="alamat" class="control-label require">Catatan</label>
				<textarea class="form-control" name="catatan_pembahasan_teknis">{{ $per->catatan_pembahasan_teknis }}</textarea>
			</div>
			<div id="spm">
				<div class="divider text-primary">INPUT DATA PEMBAYARAN</div>
                <hr/>
                  <div class="form-row">
                    <div class="form-group col-3">
                        <label class="control-label require">Retribusi</label>
                        {{ Form::text('kode_rekening',$ret->kode_rekening,['class'=>'retribusi form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('jumlah_pembayaran',$ret->jumlah_pembayaran,['class'=>'retribusi rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label require">Denda</label>
                        {{ Form::text('kode_denda',$ret->kode_denda,['class'=>'retribusi form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('jumlah_denda',$ret->jumlah_denda,['class'=>'retribusi rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-4">
                      <a href="#" id="save-spm-retribusi" class="btn btn-sm btn-success"><i class="ti-save"></i> Simpan Retribusi</a>
                      {{-- <a href="#" id="print-spm-retribusi" class="btn btn-sm btn-default"><i class="ti-printer"></i> Cetak SPM</a> --}}
                    </div>
                  </div>
                <hr/>
			</div>
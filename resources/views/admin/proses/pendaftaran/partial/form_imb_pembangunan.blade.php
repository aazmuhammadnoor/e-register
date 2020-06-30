			<div class="form-group">
				<label for="alamat" class="control-label require">Catatan Pemeriksaan</label>
				<textarea class="form-control" name="catatan_pemeriksaan">{{ $per->catatan_pemeriksaan }}</textarea>
			</div>
			<div id="spm">
				<div class="divider text-primary">INPUT DATA PEMBAYARAN</div>
                <hr/>
                  <div class="form-row">
                    <div class="form-group col-3">
                        <label class="control-label require">Retribusi IMB</label>
                        {{ Form::text('kode_retribusi_imb',$ret->kode_retribusi_imb,['class'=>'imb form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('retribusi_imb',$ret->retribusi_imb,['class'=>'imb rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label require">Papan Proyek</label>
                        {{ Form::text('kode_papan_proyek',$ret->kode_papan_proyek,['class'=>'imb form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('papan_proyek',$ret->papan_proyek,['class'=>'imb rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label require">Plat IMB</label>
                        {{ Form::text('kode_plat_imb',$ret->kode_plat_imb,['class'=>'imb form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('plat_imb',$ret->plat_imb,['class'=>'imb rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label require">Denda</label>
                        {{ Form::text('kode_denda_imb',$ret->kode_denda_imb,['class'=>'imb form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('denda_imb',$ret->denda_imb,['class'=>'imb rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-4">
                      <a href="#" id="save-spm-imb" class="btn btn-sm btn-success"><i class="ti-save"></i> Simpan SPM</a>
                      <a href="#" id="print-spm-imb" class="btn btn-sm btn-default"><i class="ti-printer"></i> Cetak SPM</a>
                    </div>
                  </div>
                <hr/>
			</div>
			<div class="form-group">
                <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
                <a href="{{ url('admin/proses/pendaftaran/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
			</div>
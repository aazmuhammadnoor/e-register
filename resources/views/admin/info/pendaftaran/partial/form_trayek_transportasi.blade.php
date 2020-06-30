            <div class="form-group">
                <label for="alamat" class="control-label require">Catatan Pemeriksaan</label>
                <textarea class="form-control" name="catatan_pemeriksaan">{{ $per->catatan_pemeriksaan }}</textarea>
              </div>
                <div id="spm">
                  <div class="divider text-primary">INPUT PEMBAYARAN</div>
                  <div class="form-row">
                    <div class="form-group col-4">
                        <label class="control-label require">Biaya Retribusi</label>
                        {{ Form::text('kode_retribusi_trayek',$ret->kode_retribusi_trayek,['class'=>'trayek form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('retribusi_trayek',$ret->retribusi_trayek,['class'=>'trayek rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-4">
                        <label class="control-label require">Biaya Kartu Pengawasan</label>
                        {{ Form::text('kode_kartu_pengawasan_trayek',$ret->kode_kartu_pengawasan_trayek,['class'=>'trayek form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('kartu_pengawasan_trayek',$ret->kartu_pengawasan_trayek,['class'=>'trayek rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                    <div class="form-group col-4">
                        <label class="control-label require">Denda</label>
                        {{ Form::text('kode_denda_trayek',$ret->kode_denda_trayek,['class'=>'trayek form-control','placeholder'=>'KODE REKENING']) }}<br/>
                        {{ Form::text('denda_trayek',$ret->denda_trayek,['class'=>'trayek rupiah form-control','placeholder'=>'JUMLAH']) }}
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-4">
                      <a href="#" id="save-spm-trayek" class="btn btn-sm btn-success"><i class="ti-save"></i> Simpan SPM</a>
                      <a href="#" id="print-spm-trayek" class="btn btn-sm btn-default"><i class="ti-printer"></i> Cetak SPM</a>
                    </div>
                  </div>
                  <hr/>
                </div>
              <div class="form-group">
                              <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
                              <a href="{{ url('admin/proses/pendaftaran') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
              </div>

                                <div class='col-md-12'>
                                    <div class='divider'>ALAMAT / LOKASI PERMOHONAN PERIZINAN </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class='form-group'>
                                                <label class='required'>Lokasi Permohonan</label>
                                                <input id="alamat_permohonan" type="text" class="form-control" name="alamat_permohonan" value="{{ old('alamat_permohonan') }}" required>
                                            </div>
                                            <div class='form-group'>
                                                <label>Kecamatan</label>
                                                <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Kecamatan..." name="lokasi_kec" data-url="{{ url('ajax/kelurahan') }}" id="kecamatan-ajax" required="">
                                                    @foreach($kecamatan as $kc)
                                                        <option value="{{ $kc->name }}">{{ $kc->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Kelurahan</label>
                                                <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Kelurahan..." name="lokasi_kel" id="kelurahan-ajax" required=""></select>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>RT</label>
                                                <input id="lokasi_rt" type="text" class="form-control" name="lokasi_rt" value="{{ old('lokasi_rt') }}" required>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>RW</label>
                                                <input id="lokasi_rw" type="text" class="form-control" name="lokasi_rw" value="{{ old('lokasi_rw') }}" required>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label class='required'>Koordinat Perizinan</label>
                                                <div id='frm_peta_default' style='height:350px;'></div>
                                                <div class='input-group'>
                                                    <span class='input-group-addon'><i class='ti-pin2'></i> Titik Koordinat Lokasi</span>
                                                    <input id="koordinat_value" type="text" class="form-control" name="koordinat" value="" required readonly="">
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                                Contoh : <br>
                                                TITIK LOKASI (LATITUDE,LONGITUDE)<br>
                                                -2.97784, 104.75011
                                            </div>
                                        </div>
                                    </div>
                                </div>
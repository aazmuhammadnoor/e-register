
{!! Form::open(['url'=>'sertifikat/add/'.$nik.'','class'=>'card form-type-fill','id'=>'form-sertifikat']) !!}
    {!! Form::hidden('nik', $nik,['id'=>'nikfrm']) !!}
    <div class="card-body">
        <h6 class="text-light fw-300">Sertifikat</h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-6">
                    <label>Jenis Sertifikat</label>
                    <select name="jenis" class='form-control' data-provide="selectpicker">
                        @foreach($jenis as $jns)
                            <option value="{{ $jns }}">{{ $jns }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6">
                    <label>Nomor</label>
                    {!! Form::text('nomor',old('nomor'),['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Lokasi yang tercantum dalam Sertifikat</h6>
        <div class="form-groups-attached">
           <div class="row">
                <div class="form-group col-4">
                    <label>Kecamatan</label>
                    {!! Form::select('kecamatan',$kecamatan,null,['data-provide'=>'selectpicker','id'=>'kecamatan-ajax-modal','data-url'=>url('ajax/kelurahan')]) !!}
                </div>
                <div class="form-group col-4">
                    <label>Kelurahan/Desa</label>
                    {!! Form::select('kelurahan',[],null,['data-provide'=>'selectpicker','id'=>'kelurahan-ajax-modal','data-url'=>url('ajax/padukuhan')]) !!}
                </div>
                <div class="form-group col-4">
                    <label>xxx</label>
                    {!! Form::select('desa',[],null,['data-provide'=>'selectpicker','id'=>'padukuhan-ajax-modal']) !!}
                </div>
           </div>
        </div>
        <h6 class="text-light fw-300">Surat Ukur/Gambar Situasi</h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-4">
                    <label class='require'>Jenis</label>
                    @php $jenis = ['Surat Ukur'=>'Surat Ukur','Gambar Situasi'=>'Gambar Situasi','Surat Ukur/Gambar Ukur'=>'Surat Ukur/Gambar Ukur'] @endphp
                    {!! Form::select('surat_ukur',$jenis,old('surat_ukur'),['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                </div>
                <div class="form-group col-4">
                    <label>Nomor Surat</label>
                    {!! Form::text('no_surat_ukur',old('no_surat_ukur'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-4">
                    <label>Tanggal Surat</label>
                    {!! Form::text('tgl_surat_ukur',old('tgl_surat_ukur'),['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy']) !!}
                </div>
                <div class="form-group col-4">
                    <label>Persil</label>
                    {!! Form::text('persil',old('persil'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-4">
                    <label>Kelas</label>
                    {!! Form::text('kelas',old('kelas'),['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-4">
                    <label class="require">Luas Dalam M<sup>2</sup></label>
                    {!! Form::text('luas',old('luas'),['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label>Kondisi Tanah</label>
                    {!! Form::select('keadaan_tanah',$kondisi,null,['data-provide'=>'selectpicker','class'=>'form-control']) !!}
                </div>
                <div class="form-group col-6">
                    <label>Atas Nama</label>
                    {!! Form::text('atas_nama',old('atas_nama'),['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <footer class="card-footer text-left">
        <button class="btn btn-primary" id="btn-simpan-sertifikat" type="button">Simpan Sertifikat</button>
    </footer>
{!! Form::close() !!}

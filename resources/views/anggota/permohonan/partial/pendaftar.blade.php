                                <div class='col-md-12'>
                                    <div class='divider'>DATA PEMOHON</div>
                                </div>
                                <div class="col-md-12 text-center mb-3">
                                    <img src="{{ url('storage', [$pendaftar->pas_foto]) }}" class="img-thumbnail mx-auto" style="width: 151px !important">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nik" class="control-label require">N I K</label>
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ $pendaftar != null ? $pendaftar->nik : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama" class="control-label require">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $pendaftar != null ? $pendaftar->nama : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_depan" class="control-label">Gelar Depan</label>
                                        <input id="gelar_depan" type="text" class="form-control" name="gelar_depan" value="{{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_belakang" class="control-label">Gelar Belakang</label>
                                        <input id="gelar_belakang" type="text" class="form-control" name="gelar_belakang" value="{{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="control-label require">Jenis Kelamin</label>
                                        <input id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin" value="{{ $pendaftar->jenis_kelamin == "1" ? 'Laki-Laki' : 'Perempuan' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="agama" class="control-label require">Agama</label>
                                        <input id="agama" type="text" class="form-control" name="agama" value="{{ $pendaftar != null ? $pendaftar->getAgama ? $pendaftar->getAgama->name : '' : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status_perkawinan" class="control-label require">Status Perkawinan</label>
                                        <input id="status_perkawinan" type="text" class="form-control" name="status_perkawinan" value="{{ $pendaftar != null ? $pendaftar->status_perkawinan : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pekerjaan" class="control-label require">Pekerjaan</label>
                                        <input id="pekerjaan" type="text" class="form-control" name="pekerjaan" value="{{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tempat_lahir" class="control-label require">Tempat Lahir</label>
                                        <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="control-label require">Tanggal Lahir</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_lahir" value="{{ $pendaftar != null ? $pendaftar->tanggal_lahir : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="provinsi" class="control-label require">Provinsi</label>
                                        <input id="provinsi" type="text" class="form-control" name="provinsi" value="{{ $pendaftar != null ? $pendaftar->getProvinsi ? $pendaftar->getProvinsi->name : '' : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kabupaten" class="control-label require">Kabupaten/Kota</label>
                                        <input id="kabupaten" type="text" class="form-control" name="kabupaten" value="{{ $pendaftar != null ? $pendaftar->getKabupaten ? $pendaftar->getKabupaten->name : '' : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kecamatan" class="control-label require">Kecamatan</label>
                                        <input id="kecamatan" type="text" class="form-control" name="kecamatan" value="{{ $pendaftar != null ? $pendaftar->getKecamatan ? $pendaftar->getKecamatan->name : '' : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kelurahan" class="control-label require">Kelurahan</label>
                                        <input id="kelurahan" type="text" class="form-control" name="kelurahan" value="{{ $pendaftar != null ? $pendaftar->getKelurahan ? $pendaftar->getKelurahan->name : '' : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="rt" class="control-label require">RT</label>
                                        <input id="rt" type="text" class="form-control" name="rt" value="{{ $pendaftar != null ? $pendaftar->rt : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="rw" class="control-label require">RW</label>
                                        <input id="rw" type="text" class="form-control" name="rw" value="{{ $pendaftar != null ? $pendaftar->rw : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="kode_pos" class="control-label require">Kode Pos</label>
                                        <input id="kode_pos" type="text" class="form-control" name="kode_pos" value="{{ $pendaftar != null ? $pendaftar->kode_pos : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat" class="control-label require">Alamat</label>
                                        <textarea class="form-control" name="alamat" readonly>{{ $pendaftar != null ? $pendaftar->alamat : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_telp" class="control-label require">Nomor Telp</label>
                                        <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ $pendaftar != null ? $pendaftar->no_telp : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="kewarganegaraan" class="control-label require">Kewarganegaraan</label>
                                        <input id="kewarganegaraan" type="text" class="form-control" name="kewarganegaraan" value="{{ $pendaftar != null ? $pendaftar->kewarganegaraan : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nomor_passpor" class="control-label">Nomor Passpor</label>
                                        <input id="nomor_passpor" type="text" class="form-control" name="nomor_passpor" value="{{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tempat_terbit_passpor" class="control-label">Tempat Terbit Passpor</label>
                                        <input id="tempat_terbit_passpor" type="text" class="form-control" name="tempat_terbit_passpor" value="{{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}" readonly>
                                    </div>
                                </div>
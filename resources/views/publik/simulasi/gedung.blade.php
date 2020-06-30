<h4 class="text-muted fs-16">Sumulasi Perhitungan Biaya Retribusi Izin Mendirikan Bangunan</h4>
{!! Form::open(['url'=>'publik/simulasi/gedung','class'=>'card form-type-combine','id'=>'form-simulasi']) !!}
    <div class="card-body">
        <h6 class="text-light fw-300">Data Banguna Gedung</h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label class="require">Luas Bangunan Dalam M<sup>2</sup></label>
                    {!! Form::text('luas',null,['class'=>'form-control','required'=>'required']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Lingkup Pembangunan</label>
                    <select name="list_lingkup" data-provide="selectpicker">
                        <option value="1">Bangunan belum dibangun - 1.00</option>
                        <option value="1.25">Bangunan sedang dibangun - 1.25</option>
                        <option value="1.50">Bangunan sudah selesai dibangun - 1.50</option>
                        <option value="0.65">Pelestarian pratama - 0.65</option>
                        <option value="0.45">Pelestarian madya - 0.45</option>
                        <option value="0.30">Pelestarian utama - 0.30</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Fungsi Bangunan</label>
                    <select name="list_fungsi" data-provide="selectpicker">
                        <option value="0.30">Fungsi Hunian Rumah Tinggal Tunggal - 0.30</option>
                        <option value="0.50">Fungsi Hunian Selain Rumah Tinggal Tunggal - 0.50</option>
                        <option value="0">Fungsi Keagamaan - 0.00</option>
                        <option value="1" selected>Fungsi Usaha - 1.00</option>
                        <option value="0">Fungsi Sosial dan Budaya Milik Negara - 0.00</option>
                        <option value="1">Fungsi Sosial dan Budaya Selain Milik Negara - 1.00</option>
                        <option value="1.50">Fungsi Ganda / Campuran - 1.50</option>
                    </select>
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Klasifikasi</h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Komplektisitas</label>
                    <select name="list_komplektisitas" data-provide="selectpicker">
                        <option value="0.40">Sederhana - 0.40</option>
                        <option value="0.70">Tidak Sederhana - 0.70</option>
                        <option value="1">Khusus - 1.00</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Permanensi - 0.20</label>
                    <select name="list_permanensi" data-provide="selectpicker">
                        <option value="0.40">Darurat - 0.40</option>
                        <option value="0.70">Semi Permanen - 0.70</option>
                        <option value="1">Permanen - 1.00</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Risiko Kebakaran - 0.15</label>
                    <select name="list_kebakaran" data-provide="selectpicker">
                        <option value="0.40">Rendah - 0.40</option>
                        <option value="0.70">Sedang - 0.70</option>
                        <option value="1">Tinggi - 1.00</option>
                    </select>
                </div> 
            </div>
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>	Zonasi Gempa - 0.15</label>
                    <select name="list_gempa" data-provide="selectpicker">
                        <option value="0.10">Zona I / Rendah - 0.10</option>
                        <option value="0.30">Zona II / Sedang - 0.30</option>
                        <option value="0.70">Zona III / Tinggi - 0.70</option>
                        <option value="1">Zona IV / Sangat Tinggi - 1.00</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Lokasi (Kepadatan BG) - 0.10</label>
                    <select name="list_kepadatan" data-provide="selectpicker">
                        <option value="0.40">Renggang (kawasan KDB &lt; 40%) - 0.40</option>
                        <option value="0.70">Sedang (kawasan KDB  40% - 60%) - 0.70</option>
                        <option value="1">Padat (kawasan KDB &gt; 60%) - 1.00</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Ketinggian Bangunan Gedung - 0.10</label>
                    <select name="list_ketinggian" data-provide="selectpicker">
                        <option value="0.40">Rendah (1 lantai) - 0.40</option>
                        <option value="0.70">Sedang (2 lantai – 4 lantai) - 0.70</option>
                        <option value="1">Tinggi (lebih dari 4 lantai) - 1.00</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Kepemilikan - 0.05</label>
                    <select name="list_kepemilikan" data-provide="selectpicker">
                        <option value="0.40">Negara/Yayasan - 0.40</option>
                        <option value="0.70">Perorangan - 0.70</option>
                        <option value="1">Badan Usaha - 1.00</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>WAKTU PENGGUNAAN</label>
                    <select name="list_waktu" data-provide="selectpicker">
                        <option value="1">Tetap - 1.00</option>
                        <option value="0.70">Jangka Menengah (Maks 3 Tahun) - 0.70</option>
                        <option value="0.40">Jangka Pendek (Maks 6 bulan) - 0.40</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>BASEMENT</label>
                    <select name="list_basement" data-provide="selectpicker">
                        <option value="1">Tidak Ada basement - 1.00</option>
                        <option value="1.30">Ada basement - 1.30</option>
                    </select>
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Pembatas/Penahan/Pengaman <code>Rp 2.000,00 / m</code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Pagar</label>
                    {!! Form::text('pagar',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Tanggul / retaining wall</label>
                    {!! Form::text('tanggul',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Turap batas kavling/persil</label>
                    {!! Form::text('turap',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Penanda Masuk Lokasi <code>Rp 10.000,00 / unit</code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Gapura</label>
                    {!! Form::text('gapura',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Gerbang</label>
                    {!! Form::text('gerbang',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Perkerasan <code>Rp 2.000,00 / m<sup>2</sup></code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Jalan</label>
                    {!! Form::text('jalan',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Lapangan parkir</label>
                    {!! Form::text('lapangan_parkir',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Lapangan upacara</label>
                    {!! Form::text('lapangan_upacara',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Lapangan olah raga terbuka</label>
                    {!! Form::text('lapangan_olahraga',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Penimbunan barang dll</label>
                    {!! Form::text('penimbunan_barang',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Penghubung <code>Rp 5.000,00 / m<sup>2</sup></code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Jembatan</label>
                    {!! Form::text('jembatan',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Box culvert</label>
                    {!! Form::text('box_cluvert',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label>Dueker, gorong-gorong drainase</label>
                    {!! Form::text('gorong_gorong',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Kolam/Reservoir Bawah Tanah <code>Rp 5.000,00 / m<sup>2</sup></code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Kolam renang</label>
                    {!! Form::text('kolam_renang',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Kolam pengolahan air</label>
                    {!! Form::text('kolam_air',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Reservoir</label>
                    {!! Form::text('reservoir',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Waste water teatment plant</label>
                    {!! Form::text('waste_water',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Menara <code>Rp 100.000,00 / m</code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Menara antena</label>
                    {!! Form::text('menara_antena',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Menara air/reservoir</label>
                    {!! Form::text('menara_air',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Cerobong</label>
                    {!! Form::text('cerobong',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Tower</label>
                    {!! Form::text('tower',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Konstruksi monumen</label>
                    {!! Form::text('monumen',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Tugu</label>
                    {!! Form::text('tugu',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Patung</label>
                    {!! Form::text('patung',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Instalasi <code>Rp 4.000,00 / m<sup>2</sup></code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Instalasi listrik</label>
                    {!! Form::text('instalasi_listrik',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Instalasi Pengolahan</label>
                    {!! Form::text('instalasi_pengolahan',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Jaringan gas bawah tanah</label>
                    {!! Form::text('instalasi_gas',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Konstruksi pondasi mesin</label>
                    {!! Form::text('instalasi_pondasi_mesin',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-sm-12">
                    <label>Jembatan atau lift</label>
                    {!! Form::text('jembatan_lift',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <h6 class="text-light fw-300">Konstruksi Reklame/Papan Nama <code>Rp 100.000,00 / m<sup>2</sup></code></h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Billboard</label>
                    {!! Form::text('billboard',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-3 col-sm-12">
                    <label>Papan iklan</label>
                    {!! Form::text('papan_iklan',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label>Papan nama berdiri sendiri</label>
                    {!! Form::text('papan_nama',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <footer class="card-footer text-left">
        <button type="submit" class="btn btn-primary">Hitung Retribusi</button>
    </footer>
{!! Form::close() !!}
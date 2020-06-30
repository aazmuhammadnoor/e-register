<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js" integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log==" crossorigin=""></script>
<script src="{{ asset('js/leaflet.ajax.min.js') }}"></script>

<script>
    var mymap = L.map('mapid').setView([-7.706707, 110.387787], 11);
    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c']
    }).addTo( mymap );

    function popUp(f,l){
        l.bindPopup(f.properties.popupContent);
        var jsonGroup = new L.FeatureGroup(f); 
        mymap.fitBounds(l.getBounds());
    }
    var jsonTest = new L.GeoJSON.AJAX(["{{ $assets }}"],{onEachFeature:popUp}).addTo(mymap);
    

        var markers = [
            {!!$marker!!}
         ];

         for (var i=0; i<markers.length; i++) {
           
            var lon = markers[i][0];
            var lat = markers[i][1];
            var popupText = markers[i][2];
            
             var markerLocation = new L.LatLng(lat, lon);
             var marker = new L.Marker(markerLocation);
             mymap.addLayer(marker);
         
             marker.bindPopup(popupText);
         
         }

</script>

<style>
	#mapid{
		display:inline-block;
		border:0px solid red;
		width:100%;
		height:350px;
	}
</style>
<div id="mapid"></div>
<hr/ style="margin-top:0;margin-bottom: 15px">
@if($pemohon->count() > 0)
    Di {{ $kec->name.',' }} {{ $kel->name.',' }} {{ $pad->name }} terdapat {{ $pemohon->count() }} data {{$r->jenis_konsultasi }} <a hre="#"data-toggle="modal" data-target="#modal-view-all-location" class="text-info" style="cursor:pointer;">lihat data yang ada dilokasi ini.</a>
@else
    belum ada data didaerah ini.
@endif

<div class="modal modal-center fade" id="modal-view-all-location" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- table -->

                <table class="table table-striped table-bordered" id="myTable"  cellspacing="0"  style="min-width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Izin</th>
                            <th>Badan Usaha</th>
                            <th>Nama Badan Usaha</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach( $pemohon as $pmn)
                            <tr>
                                <td>{{$pmn->nama_pemohon}}</td>
                                <td>{{$pmn->getIzin->name}}</td>
                                <td>{{$pmn->badan_usaha}}</td>
                                <td>{{$pmn->ket_badan_usaha}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>

                <button type="button" class="btn btn-bold btn-pure btn-secondary pull-right" data-dismiss="modal">Close</button>
                <!-- end table -->

            </div>
        </div>
    </div>
</div>

<!-- modal add form -->
<div class="modal modal-fill fade" id="modal-add-konsultasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Data Pemohon Advice Planing</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'konsultasi/add','id'=>'konsultasi-form']) }}
                    {{ csrf_field() }}
                    {!! Form::hidden('jenis_konsultasi',$r->jenis_konsultasi,['class'=>'form-control form-control-sm']) !!}

                    @if($r->jenis_konsultasi == 'izin')
                        {!! Form::hidden('kategori_izin',$r->kategori_izin,['class'=>'form-control form-control-sm']) !!}
                        {!! Form::hidden('izin',$r->izin,['class'=>'form-control form-control-sm']) !!}
                    @else

                    @endif
                    {!! Form::hidden('kecamatan',$r->kecamatan,['class'=>'form-control form-control-sm']) !!}
                    {!! Form::hidden('kelurahan',$r->kelurahan,['class'=>'form-control form-control-sm']) !!}
                    {!! Form::hidden('padukuhan',$r->padukuhan,['class'=>'form-control form-control-sm']) !!}
                    <div class="row form-type-combine">
                        <div class="col-sm-12">
                            <b>DATA PEMOHON </b>
                            <hr/ style="margin:5px 0px;padding:0">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama_pemohon">Nama</label>
                                <input type="text" name="nama_pemohon" class="form-control" id="nama_pemohon">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_telp_pemohon">Nomor Telp. </label>
                                <input type="text" name="no_telp_pemohon" class="form-control" id="no_telp_pemohon">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="alamat_pemohon">Alamat</label>
                                <input type="text" name="alamat_pemohon" class="form-control" id="alamat_pemohon">
                            </div>
                        </div>                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bukti_hak_tanah">Bukti Hak Atas Tanah/No.</label>
                                <input type="text" name="bukti_hak_tanah" class="form-control" id="bukti_hak_tanah">
                            </div>
                        </div>                    
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fungsi_bangunan">Fungsi Bangunan</label>
                                <input type="text" name="fungsi_bangunan" class="form-control" id="fungsi_bangunan">
                            </div>
                        </div>              
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="luas_tanah">Luas Tanah (Persil) /M<sup>2</sup></label>
                                <input type="text" name="luas_tanah" class="form-control" id="luas_tanah">
                            </div>
                        </div>                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="letak_tanah">Letak Tanah</label>
                                <input type="text" name="letak_tanah" class="form-control" id="letak_tanah">
                            </div>
                        </div>     
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label">KETENTUAN TATA RUANG *</label>
                                <textarea class="form-control form-control-sm" rows="6" name="resume" data-provide="summernote" data-min-height="150" data-toolbar="full" required="required"></textarea>
                            </div>
                        </div>
                    </div>

                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-label btn-primary btn-sm">
                    <label><i class="ti-save"></i></label> 
                    Save
                </button>
            {{ Form::close() }}
            </div>
       </div>
    </div>
</div>



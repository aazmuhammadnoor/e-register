@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <asside class="aside aside-lg aside-expand-md">
        <div class="aside-body">
            <div class="aside-block">
                <p><small class="text-uppercase">Basemap</small></p>
                <div class="custom-controls-stacked mb-40">
                    <label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input basemap" name="basemap" value="default" checked>
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Default</span>
                    </label>
                    <!--<label class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input basemap" name="basemap" value="sleman">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Pola Ruang Kabupaten Sleman</span>
                    </label>-->
                </div>
                <div class="divider">WILAYAH SEBARAN PERIZINAN</div>
                <div class="form-type-combine">
                    <div class="form-groups-attached">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="form-control" title="Pilih Kecamatan" id="kecamatan">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($kec as $rs)
                                    <option value="{{ $rs->name }}">{{ $rs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <select class="form-control" id="kelurahan">
                            </select>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label>Padukuhan</label>
                            <select class="form-control" id="padukuhan">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Perizinan</label>
                            <select class="form-control" id="perizinan">
                                 <option value="all">Semua Jenis Izin</option>
                                 @foreach($izin as $z)
                                    <option value="{{ $z->id }}">{{ $z->name }}</option>
                                 @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </asside>
    <div class="main-content">
        <div class="card">
            <h4 class="card-title"><strong>{{ $title }}</strong></h4>
            <div class="card card-body">
                <div id="mapid" style="height: 460px;"></div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
   <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
   <script src="{{ asset('js/leaflet.ajax.min.js') }}"></script>
   <script src="{{ asset('js/customlayer.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.9/d3.min.js"></script>
   <script src="{{ asset('js/L.D3SvgOverlay.js') }}"></script>
   <script>
        var layersx;
        var mymap = L.map('mapid').setView([-2.990822, 104.756608], 10);
        var marker = [];

        L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a','b','c']
        }).addTo( mymap );

        $('.basemap').on('click', function() {
            if($(this).is(":checked")){
               gantiBasemap($(this).val());
            }
        });

        function gantiBasemap(layer)
        {
           if(layer == 'default'){
               window.location.reload();
           }else if(layer == 'sleman'){
                var alamat = "http://gis.jogjaprov.go.id/geoserver/ows?";
                L.tileLayer.betterWms(alamat, {
                layers: 'geonode:sleman_budidaya_geo',
                transparent: true,
                format: 'image/png'
                }).addTo(mymap);

                var legend = L.control({position: 'bottomright'});
                legend.onAdd = function (mymap) {
                    var div = L.DomUtil.create('div', 'info legend');
                    div.innerHTML = "<img src='http://gis.jogjaprov.go.id/geoserver/wms?request=GetLegendGraphic&format=image/png&WIDTH=10&HEIGHT=10&LAYER=geonode:sleman_budidaya_geo&legend_options=fontAntiAliasing:true;fontSize:11;forceLabels:on'/>";
                    return div;
                };

                legend.addTo(mymap);
           }
        }


        $("#kecamatan").change(function(){
            var kec = $(this).val();
            loadLayer('kecamatan', kec);
            loadKelurahan(kec);
            loadKoordinat(kec,'','')
        })

        $("#kelurahan").change(function(){
            var kel = $(this).val();
            var kec = $("#kecamatan").val();
            loadLayer('kelurahan', kel);
            loadPadukuhan(kel);
            loadKoordinat(kec,kel,'')
        })

        $("#perizinan").change(function(){
            var izin = $(this).val();
            var kel  = $("#kelurahan").val();
            var kec  = $("#kecamatan").val();
            loadKoordinat(kec,kel,izin)
        })

        function loadKelurahan(kec)
        {
            $.ajax({
                type    :'get',
                url     :"{{ url('ajax/kelurahan') }}/"+kec+"/1",
                beforeSend:function(){
                    console.log('loading...');
                },success:function(rs)
                {
                    $("#kelurahan").html(rs);
                }
            });
        }

        function loadPadukuhan(kel)
        {
            $.ajax({
                type    :'get',
                url     :"{{ url('ajax/padukuhan') }}/"+kel+"/1",
                beforeSend:function(){
                    console.log('loading...');
                },success:function(rs)
                {
                    $("#padukuhan").html(rs);
                }
            });
        }

        function loadKoordinat(kec, kel, izin)
        {
            $.ajax({
                type    :'get',
                url     :"peta-sebaran-koordinat/?kec="+kec+"&kel="+kel+"&izin="+izin+"",
                beforeSend:function(){
                    removeMarker();
                },success:function(rs)
                {
                    loadResults(rs);
                }
            });
        }

        function loadResults (data) {
            var items, markers_data = [];
            if (data.length > 0) {
                items = data;
                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    if (item.lat != undefined && item.lng != undefined) {
                        var content = '<p><strong>'+item.perizinan+'</strong><br/>Nomor '+item.no_sk+'<br/>Pemohon '+item.nama_pemohon+'</p>';
                        var popup = L.popup()
                            .setContent(content);
                        var LamMarker = new L.marker([item.lat,item.lng]);
                        LamMarker.addTo(mymap).bindPopup(content).openPopup();
                        marker.push(LamMarker);
                    }
                }
            }
        }

        function loadLayer(mode, name)
        {
            $.ajax({
                url     :'get',
                url     :"{{ url('ajax/geojson') }}/"+mode+"/"+name+"",
                beforeSend:function(){},
                success:function(rs){
                    createLayer(rs);
                }
            });
        }

        function createLayer(url)
        {
            if(layersx)
                mymap.removeLayer(layersx);

            function popUp(f,l){
                l.bindPopup(f.properties.popupContent);
                l.setStyle({fillColor :f.properties.fill,color:f.properties.stroke}) 
                mymap.fitBounds(l.getBounds());
            }
            layersx = new L.GeoJSON.AJAX([url],{onEachFeature:popUp});
            layersx.addTo(mymap);
        }


        function removeMarker()
        {
            for(i=0;i<marker.length;i++) {
                mymap.removeLayer(marker[i]);
            } 
        }

   </script>
@endsection
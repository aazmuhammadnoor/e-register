@extends('layouts.app')

@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Contoh Peta</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
                <div id="mapid" style="height: 520px;"></div>
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
   <script>
        var mymap = L.map('mapid').setView([-7.706707, 110.387787], 10);
        L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a','b','c']
        }).addTo( mymap );
        
        var basemaps = {
            Pola_Ruang: L.tileLayer.betterWms('http://gis.jogjaprov.go.id/geoserver/ows?', {
                layers: 'geonode:sleman_budidaya_geo',
                transparent: true,
                format: 'image/png'
            }),

            Rawan_Bencana: L.tileLayer.betterWms('http://103.255.15.12:8910/geoserver/jmc/wms?', {
                layers: 'jmc:peta_non_series_gempa',
                transparent: true,
                format: 'image/png'
            })
        };
        L.control.layers(basemaps, {}, {collapsed: false}).addTo(mymap);
        basemaps.Rawan_Bencana.addTo(mymap);
   </script>
@endsection
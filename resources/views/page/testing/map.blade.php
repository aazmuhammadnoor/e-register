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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
   integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
   crossorigin=""/>
   <!--<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script>-->
   <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
   integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
   crossorigin=""></script>
   <!--<script src="{{ asset('js/leaflet-bing-layer.js') }}"></script>-->
   <script src="{{ asset('js/leaflet.ajax.min.js') }}"></script>
   <script src="{{ asset('js/customlayer.js') }}"></script>

   <script>
        var mymap = L.map('mapid').setView([-7.706707, 110.387787], 10);

        L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            subdomains: ['a','b','c']
        }).addTo( mymap );

        /*var wmsLayer = L.tileLayer.wms('http://gis.jogjaprov.go.id/geoserver/ows?', {
            layers: 'geonode:sleman_budidaya_geo',
            transparent: true,
            format: 'image/png'
        }).addTo(mymap);
        */


        //L.tileLayer.bing("AjhjBwsm6RurseEpi66ieT19fYn33cXfc7604k6QqNbv8tiSGauNVt6Jap5w-pWS").addTo(mymap)
        /*function popUp(f,l){
            l.bindPopup(f.properties.popupContent);
            mymap.fitBounds(l.getBounds());
        }*/
        //var jsonTest = new L.GeoJSON.AJAX(["{{ $assets }}"],{onEachFeature:popUp}).addTo(mymap);
        var alamat = "http://gis.jogjaprov.go.id/geoserver/ows?";
        L.tileLayer.betterWms(alamat, {
        layers: 'geonode:sleman_budidaya_geo',
        transparent: true,
        format: 'image/png'
        }).addTo(mymap);

        var legend = L.control({position: 'bottomright'});
        legend.onAdd = function (mymap) {
            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML = "<img src='http://gis.jogjaprov.go.id/geoserver/wms?request=GetLegendGraphic&format=image/png&WIDTH=20&HEIGHT=20&LAYER=geonode:sleman_budidaya_geo&legend_options=fontAntiAliasing:true;fontSize:12;forceLabels:on'/>";
            return div;
        };

        legend.addTo(mymap);
   </script>
@endsection
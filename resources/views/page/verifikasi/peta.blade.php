<div id="view_map" style="height: 380px;"></div>
<script>
    var peta = L.map('view_map').setView([{{ $koordinat[0]}}, {{ $koordinat[1]}}], 18);
    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c']
    }).addTo( peta );

    L.marker([{{ $koordinat[0]}}, {{ $koordinat[1]}}]).addTo(peta)
        .bindPopup('Lokasi.')
        .openPopup();

</script>
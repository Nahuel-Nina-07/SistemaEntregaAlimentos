@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<body>
    <div id="coordinates">Coordenadas: </div>
    <select name="select-location" id="select-location">
        <option value="-1">Seleccione un lugar:</option>
        <option value="6.636254,-73.223129">Barichara-Santander</option>
        <option value="12.19602,-72.147218">Cabo de la Vela-La Guajira</option>
        <option value="10.42278,-75.539217">
            Castillo San Felipe Cartagena-Bolivar
        </option>
        <option value="2.265124,-73.794523">Caño Cristales-Meta</option>
        <option value="3.233851,-75.168934">Desierto de Tatacoa-Huila</option>
        <option value="6.233825,-75.167062">Guatape-Antioquia</option>
        <option value="4.945885,-73.825740">Guatavita-Cundinamarca</option>
        <option value="2.135151,-76.410226">Parque Purace-Cauca</option>
        <option value="1.888593,-76.295127">San Agustín-Huila</option>
        <option value=" -17.39483754707626, -66.28108620643604">Plaza Bolivar</option>
    </select>
    <div id="map"></div>

</body>
@stop

@section('css')
<style>
    #map {
        height: 85vh;
        width: 100vw;
    }
</style>
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>


<script>
    var map = L.map('map').setView([4.5993, -74.0805], 18);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    var coordinatesDiv = document.getElementById("coordinates");
    var marker;
    var myLocationMarker;

    // Define un icono personalizado para "pedido".
    var pedidoIcon = L.divIcon({
        className: 'custom-icon',
        html: '<i class="fa-solid fa-dumpster-fire" style="color: #000000;"></i>',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    document.getElementById("select-location").addEventListener("change", function(e) {
        var selectedOption = e.target.options[e.target.selectedIndex];
        if (selectedOption.value !== "-1") {
            var coords = selectedOption.value.split(",");
            map.flyTo(coords, 18);
            coordinatesDiv.textContent = "Coordenadas: " + coords.join(", ");

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker(coords, { icon: pedidoIcon }).addTo(map);
        } else {
            coordinatesDiv.textContent = "Coordenadas: ";

            if (marker) {
                map.removeLayer(marker);
            }
        }
    });

    // Agregar el botón "Mi ubicación" para mostrar la ubicación actual.
    L.easyButton('fa-location-arrow', function() {
        if (myLocationMarker) {
            map.removeLayer(myLocationMarker);
        }
        map.locate({ setView: true, maxZoom: 18 });
    }).addTo(map);

    // Evento cuando se encuentra la ubicación actual.
    map.on('locationfound', function(e) {
        coordinatesDiv.textContent = "Coordenadas: " + e.latlng.lat + ", " + e.latlng.lng;

        if (myLocationMarker) {
            map.removeLayer(myLocationMarker);
        }

        myLocationMarker = L.marker(e.latlng).addTo(map);
    });
</script>
@stop
@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<body>
    <div id="map"></div>
</body>
@stop

@section('css')
<style>
    #map {
        height: 30vh;
        width: 30vw;
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

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Definir las coordenadas para el rango de Quillacollo
    var GoVinBounds = L.latLngBounds(
        L.latLng(-17.373888, -66.324205), // Esquina superior izquierda
        L.latLng(-17.413861, -66.270561) // Esquina inferior derecha
    );

    // Inicializar el mapa y establecer la vista y el zoom
    var mymap = L.map('map').setView([-17.395643, -66.301203], 13);

    // Añadir un mapa base (puedes usar otros proveedores de mapas)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mymap);

    // Configurar los límites para ocultar el resto del mapa
    mymap.setMaxBounds(GoVinBounds);

    var marker;

    // Añadir evento de clic al mapa
    function onMapClick(e) {
        // Eliminar el marcador existente (si lo hay)
        if (marker) {
            mymap.removeLayer(marker);
        }

        // Verificar si la ubicación está dentro de los límites de Govin
        if (GoVinBounds.contains(e.latlng)) {
            // Añadir un nuevo marcador en la posición del clic
            marker = L.marker(e.latlng).addTo(mymap)
                .bindPopup('Coordenadas: ' + e.latlng.toString())
                .openPopup();
        } else {
            alert('Su ubicacion esta fuera del rango de nuestro servicio');
        }
    }

    mymap.on('click', onMapClick);
</script>
@stop
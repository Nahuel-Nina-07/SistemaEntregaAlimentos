@extends('adminlte::page')


@section('content')
<div id="map"></div>
@stop

@section('css')
<style>
    #map {
        height: 89vh;
        width: 94vw;
    }

    .custom-icon {
        text-align: center;
        line-height: 100px;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@stop

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    var map = L.map('map').setView([-17.3895, -66.1568], 12); // Coordenadas de Cochabamba, Bolivia y nivel de zoom

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    var repartidores = <?php echo json_encode($repartidores); ?>;

    repartidores.forEach(function(repartidor) {
        var icon = L.divIcon({
            className: 'custom-icon',
            html: '<i class="fas fa-person-biking" style="font-size: 20px; color: #f95395;"></i>',
            iconSize: [20, 20],
            iconAnchor: [10, 20],
            popupAnchor: [0, -20]
        });

        var marker = L.marker([repartidor.ultima_latitud, repartidor.ultima_longitud], {
            icon: icon
        });

        var popupContent = '<b>' + repartidor.user.name + '</b><br>' +
            '<img src="http://127.0.0.1:8000/storage/' + repartidor.user.profile_photo_path + '" alt="' + repartidor.user.name + '" style="width: 50px; height: 50px; border-radius: 50%;">' +
            '<br><button onclick="mostrarDetalles(\'' + repartidor.user.name + '\', \'' + repartidor.user.profile_photo_path + '\')">Ver perfil</button>';

        marker.addTo(map).bindPopup(popupContent);
    });

    function mostrarDetalles(nombreRepartidor, fotoRepartidor) {
        alert('Detalles del repartidor: ' + nombreRepartidor);
    }
</script>
@stop
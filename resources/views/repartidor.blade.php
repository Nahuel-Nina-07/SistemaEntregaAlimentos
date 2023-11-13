@extends('adminlte::page')

@section('content')
<div>
    <div id="map"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

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
@stop

@section('js')
<script>
    // Inicializar el mapa
    var mymap = L.map('map').setView([0, 0], 11.5);

    // Añadir un mapa base (puedes usar otros proveedores de mapas)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mymap);

    // Añadir un marcador para la ubicación en tiempo real con un ícono personalizado
    var customIcon = L.divIcon({
        className: 'custom-icon',
        html: '<i class="fa-solid fa-person-biking fa-2xl" style="color: #2465d6;"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    var marker = L.marker([0, 0], {
        icon: customIcon
    }).addTo(mymap);

    // Obtener la ubicación en tiempo real usando la API de geolocalización del navegador
    function onLocationFound(e) {
        var latlng = e.latlng;
        marker.setLatLng(latlng);
        mymap.setView(latlng, 11.5);
    }

    function onLocationError(e) {
        alert(e.message);
    }

    mymap.on('locationfound', onLocationFound);
    mymap.on('locationerror', onLocationError);

    mymap.locate({
        watch: true,
        setView: true,
    });
</script>

<?php
// Esto debería ir dentro de la sección js
$pedidosJson = json_encode($pedidos);
echo "<script> var pedidos = {$pedidosJson}; </script>";
?>

<script>
    // Cambia el ícono del marcador
    var iconoPendiente = L.divIcon({
        className: 'custom-icon',
        html: '<i class="fa-solid fa-circle-user fa-2xl" style="color: #fb0909;"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    var iconoAceptado = L.divIcon({
        className: 'custom-icon',
        html: '<i class="fa-solid fa-circle-check fa-2xl" style="color: #28a745;"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    // Itera sobre los pedidos y agrega marcadores al mapa solo si el estado es "Pendiente"
    pedidos.forEach(function(pedido) {
        var marker;
        if (pedido.estado === 'pendiente') {
            marker = L.marker([pedido.latitud, pedido.longitud], {
                icon: iconoPendiente
            });
        } else if (pedido.estado === 'aceptado') {
            marker = L.marker([pedido.latitud, pedido.longitud], {
                icon: iconoAceptado
            });
        }

        // Agrega un pop-up con los botones "Aceptar" y "Rechazar"
        marker.bindPopup(`
        <b>Pedido ${pedido.id}</b><br>
        <button onclick="aceptarPedido(${pedido.id}, ${pedido.latitud}, ${pedido.longitud})">Aceptar</button>
        <button onclick="rechazarPedido(${pedido.id})">Rechazar</button>
    `);

        marker.addTo(mymap);
    });

    var routingControl; 

    function aceptarPedido(pedidoId, latitudPedido, longitudPedido) {
    // Realiza una solicitud AJAX para cambiar el estado del pedido
    fetch(`/repartidor/aceptar-pedido/${pedidoId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);

        // Limpia las capas anteriores de la ruta si existen
        if (routingControl) {
            mymap.removeControl(routingControl);
        }

        // Traza la ruta desde tu ubicación hasta la ubicación del pedido
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(0, 0),  // Tu ubicación (actualízala con la ubicación del repartidor)
                L.latLng(latitudPedido, longitudPedido)  // Ubicación del pedido
            ],
            routeWhileDragging: true
        }).addTo(mymap);
    })
    .catch(error => {
        console.error('Error al aceptar el pedido:', error);
    });
}
</script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
@stop
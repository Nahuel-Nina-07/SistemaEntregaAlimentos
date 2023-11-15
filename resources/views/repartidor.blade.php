@extends('adminlte::page')

@section('content')
<div>
    <div id="map"></div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>
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
    document.addEventListener('DOMContentLoaded', function() {
        var mymap = L.map('map').setView([0, 0], 11.5);
        var rutaControl; // Guardar referencia al control de ruta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(mymap);

        var marker = L.marker([0, 0], {
            icon: L.divIcon({
                className: 'custom-icon',
                html: '<i class="fa-solid fa-person-biking fa-2xl" style="color: #2465d6;"></i>',
                iconSize: [30, 30],
                iconAnchor: [15, 30]
            }),
            draggable: true
        }).addTo(mymap);

        mymap.on('locationfound', function(e) {
            var latlng = e.latlng;
            marker.setLatLng(latlng);
            mymap.setView(latlng, 11.5);
        });

        mymap.on('locationerror', function(e) {
            alert(e.message);
        });

        mymap.locate({
            watch: true,
            setView: true,
        });

        // Obtener los pedidos pendientes desde el servidor
        $.ajax({
            url: '/repartidor/pedidos-pendientes',
            method: 'GET',
            success: function(response) {
                var pedidos = response.pedidos;

                pedidos.forEach(function(pedido) {
                    var iconColor = pedido.estado === 'aceptado' ? '#00cc00' : '#ff5733';

                    var pedidoMarker = L.marker([pedido.latitud, pedido.longitud], {
                        icon: L.divIcon({
                            className: 'custom-icon',
                            html: '<i class="fa-solid fa-shopping-bag fa-2xl" style="color: ' + iconColor + ';"></i>',
                            iconSize: [30, 30],
                            iconAnchor: [15, 30]
                        }),
                        draggable: false,
                        aceptado: pedido.estado === 'aceptado',
                        rutaControl: null,
                    }).addTo(mymap);

                    var actualizarBoton = function() {
                        if (pedidoMarker.options.aceptado) {
                            // Después de aceptar el pedido
                            pedidoMarker.setIcon(L.divIcon({
                                className: 'custom-icon',
                                html: '<i class="fa-solid fa-shopping-bag fa-2xl" style="color: #00cc00;"></i>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 30]
                            }));

                            // Crear la ruta y guardar referencia al control de ruta
                            pedidoMarker.options.rutaControl = L.Routing.control({
                                waypoints: [
                                    L.latLng(marker.getLatLng().lat, marker.getLatLng().lng),
                                    L.latLng(pedido.latitud, pedido.longitud)
                                ],
                                routeWhileDragging: true,
                                createMarker: function() {
                                    return null;
                                }
                            }).addTo(mymap);

                            // Actualizar el contenido del botón en el Popup
                            popup.setContent(cancelarEntregaBtn);
                        } else {
                            // Después de cancelar la entrega
                            pedidoMarker.setIcon(L.divIcon({
                                className: 'custom-icon',
                                html: '<i class="fa-solid fa-shopping-bag fa-2xl" style="color: #ff5733;"></i>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 30]
                            }));

                            // Borrar la ruta y referencia al control de ruta
                            if (pedidoMarker.options.rutaControl) {
                                mymap.removeControl(pedidoMarker.options.rutaControl);
                                pedidoMarker.options.rutaControl = null;
                            }

                            // Actualizar el contenido del botón en el Popup
                            popup.setContent(aceptarBtn);
                        }
                    };

                    // Verificar si el pedido está aceptado al cargar la página
                    if (pedido.estado === 'aceptado') {
                        pedidoMarker.options.aceptado = true;
                        actualizarBoton();
                    }

                    var aceptarBtn = document.createElement('button');
                    aceptarBtn.innerHTML = 'Aceptar';
                    aceptarBtn.onclick = function() {
                        // Cambiar el estado del pedido a "aceptado"
                        var nuevoEstado = 'aceptado';

                        pedidoMarker.options.aceptado = true;
                        actualizarBoton();

                        // Realizar la solicitud AJAX para aceptar el pedido con el nuevo estado
                        $.ajax({
                            url: '/repartidor/aceptar-pedido/' + pedido.id,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                estado: nuevoEstado
                            },
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    };


                    var cancelarEntregaBtn = document.createElement('button');
                    cancelarEntregaBtn.innerHTML = 'Cancelar Entrega';
                    cancelarEntregaBtn.onclick = function() {
                        pedidoMarker.options.aceptado = false;
                        actualizarBoton();
                        $.ajax({
                            url: '/repartidor/cancelar-pedido/' + pedido.id,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Borrar la ruta y referencia al control de ruta
                                if (pedidoMarker.options.rutaControl) {
                                    mymap.removeControl(pedidoMarker.options.rutaControl);
                                    pedidoMarker.options.rutaControl = null;
                                }

                                actualizarBoton();
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    };

                    var popup = L.popup().setContent(aceptarBtn);

                    pedidoMarker.on('click', function() {
                        popup.setLatLng(pedidoMarker.getLatLng());
                        mymap.openPopup(popup);
                    });
                });

            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
@stop
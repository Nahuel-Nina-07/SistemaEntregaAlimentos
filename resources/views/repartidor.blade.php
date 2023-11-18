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
        var pedidoAceptado = false; // Bandera para verificar si ya se aceptó un pedido

        // Verificar si hay información sobre el pedido aceptado en el almacenamiento local
        var pedidoAceptadoStorage = localStorage.getItem('pedidoAceptado');
        if (pedidoAceptadoStorage) {
            pedidoAceptado = JSON.parse(pedidoAceptadoStorage);
        }

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
                            pedidoMarker.setIcon(L.divIcon({
                                className: 'custom-icon',
                                html: '<i class="fa-solid fa-shopping-bag fa-2xl" style="color: #00cc00;"></i>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 30]
                            }));

                            if (!pedidoMarker.options.rutaControl) {
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
                            }

                            popup.setContent(cancelarEntregaBtn);
                        } else {
                            pedidoMarker.setIcon(L.divIcon({
                                className: 'custom-icon',
                                html: '<i class="fa-solid fa-shopping-bag fa-2xl" style="color: #ff5733;"></i>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 30]
                            }));

                            if (pedidoMarker.options.rutaControl) {
                                mymap.removeControl(pedidoMarker.options.rutaControl);
                                pedidoMarker.options.rutaControl = null;
                            }

                            popup.setContent(aceptarBtn);
                        }
                    };

                    if (pedido.estado === 'aceptado') {
                        pedidoMarker.options.aceptado = true;
                        actualizarBoton();

                        // Crear la ruta automáticamente si el pedido está aceptado
                        trazarRutaAutomaticamente(marker.getLatLng(), L.latLng(pedido.latitud, pedido.longitud), pedidoMarker);
                    }

                    var aceptarBtn = document.createElement('button');
                    aceptarBtn.innerHTML = 'Aceptar';
                    aceptarBtn.onclick = function() {
                        // Verificar si el repartidor ya ha aceptado un pedido
                        if (pedidoAceptado) {
                            alert('Ya has aceptado un pedido. No puedes aceptar otro.');
                            return;
                        }

                        // Verificar si el pedido ya está aceptado
                        if (pedidoMarker.options.aceptado) {
                            alert('Este pedido ya ha sido aceptado.');
                            // Recargar la página solo cuando el pedido ya está aceptado
                            location.reload();
                            return;
                        }

                        var nuevoEstado = 'aceptado';

                        pedidoMarker.options.aceptado = true;
                        actualizarBoton();
                        pedidoAceptado = true;

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
                                pedidoMarker.options.aceptado = true;
                                actualizarBoton();
                                // No recargar la página aquí para evitar recargas innecesarias
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
                        pedidoAceptado = false;

                        $.ajax({
                            url: '/repartidor/cancelar-pedido/' + pedido.id,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
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

        // Función para trazar la ruta automáticamente
        function trazarRutaAutomaticamente(origen, destino, pedidoMarker) {
            // Crear la ruta desde la ubicación actual del repartidor hasta el pedido aceptado
            pedidoMarker.options.rutaControl = L.Routing.control({
                waypoints: [
                    origen,
                    destino
                ],
                routeWhileDragging: true,
                createMarker: function() {
                    return null;
                }
            }).addTo(mymap);
        }

        // Función para actualizar el estado del botón y almacenar la información en el almacenamiento local
        var actualizarBoton = function() {
            // Resto de tu código...

            // Almacenar la información sobre el pedido aceptado en el almacenamiento local
            localStorage.setItem('pedidoAceptado', JSON.stringify(pedidoAceptado));
        };
    });
</script>

<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
@stop
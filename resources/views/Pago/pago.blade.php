@extends('adminlte::page')


@section('content')
@if(!Request::is('realizarPago'))
@php
config(['adminlte.right_sidebar' => false]);
@endphp
@endif
<div class="container">
    <br>
    <div class="row flex-row align-items-start"> <!-- Agregamos flex-row y align-items-start -->
        <div class="col-md-6 order-md-1" style="margin-left: -30px;">
            <table class="table ml-3 text-left">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                    <tr>
                        <td class="product-cell">{{ $detalle->producto->nombre }}</td>
                        <td class="product-cell">{{ $detalle->cantidad }}</td>
                        <td class="product-cell">BOB {{ number_format($detalle->precio_unitario, 2) }}</td>
                    </tr>
                    @endforeach
                    @if ($descuento > 0)
                    <tr>
                        <td></td>
                        <td><b>Descuento:</b></td>
                        <td>(3.00%)</td>
                    </tr>
                    @endif
                    <tr>
                        <td></td>
                        <td><b>Total:</b></td>
                        <td id="total" class="product-cell">BOB {{ number_format($total, 2) }}</td>
                    </tr>
                    @if (isset($totalEnDolares))
                    <tr>
                        <td></td>
                        <td><b>Total (USD):</b></td>
                        <td class="product-cell">${{ number_format($totalEnDolares, 2) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <form id="paymentForm" method="POST" action="{{ route('marcar.pendiente') }}">
                @csrf
                <h3 class="title" style="text-align: center;">Información de Pago</h3>
                <div id="sectionCard" class="hidden p-4 bg-gray-100"></div>
            </form>
            <h3 class="title" style="text-align: center;">Selecciona tu ubicacion</h3>
            <div id="map"></div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/PasarelaPago/styles.css') }}">
@stop

@section('js')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Definir las coordenadas para el rango de Quillacollo
    var GoVinBounds = L.latLngBounds(
        L.latLng(-17.423888, -66.354205), // Esquina superior izquierda ampliada
    L.latLng(-15.353861, -66.240561) // Esquina inferior derecha
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
    var lugarMarcado = false;

    // Añadir evento de clic al mapa
    function onMapClick(e) {
        if (marker) {
            mymap.removeLayer(marker);
        }

        if (GoVinBounds.contains(e.latlng)) {
            marker = L.marker(e.latlng).addTo(mymap);
            lugarMarcado = true;

            // Guardar las coordenadas en el servidor
            guardarCoordenadas(e.latlng);
        } else {
            alert('Su ubicación está fuera del rango de nuestro servicio');
            lugarMarcado = false;
        }
    }

    function guardarCoordenadas(latlng) {
        // Realizar una llamada AJAX para actualizar las coordenadas en el servidor
        $.ajax({
            url: "{{ route('actualizar.coordenadas', ['pedidoId' => $pedido->id]) }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                latitud: latlng.lat,
                longitud: latlng.lng
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }



    mymap.on('click', onMapClick);
</script>

<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&components=buttons,funding-eligibility&locale=es_BO"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Script de PayPal
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                },
                payer: {
                    email_address: '{{ auth()->user()->email }}',
                    name: {
                        given_name: '{{ auth()->user()->name }}',
                        surname: '{{ auth()->user()->apellido }}'
                    },
                },
                purchase_units: [{
                    amount: {
                        value: '{{ number_format($totalEnDolares, 2) }}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            if (lugarMarcado) {
                return actions.order.capture().then(function(details) {
                    alert(details.payer.name.given_name + ', gracias por tu compra!');

                    marcarPedidoComoPendiente();

                    window.history.replaceState({}, document.title, "{{ route('categoriasProducto.indexlistado') }}");
                    window.location.href = "{{ route('categoriasProducto.indexlistado') }}";
                });
            } else {
                alert('Por favor, marque su ubicación en el mapa antes de realizar el pago.');
            }
        },
        onError: function(err) {
            console.log(err);
        }
    }).render('#sectionCard');

    function marcarPedidoComoPendiente() {
        // Hacer una llamada AJAX para notificar al servidor y marcar el pedido como pendiente
        $.ajax({
            url: "{{ route('marcar.pendiente') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>
@stop
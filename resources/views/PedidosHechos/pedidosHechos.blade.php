@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="content">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes"><i class="fas fa-clock"></i> Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="camino-tab" data-toggle="tab" href="#camino"><i class="fas fa-truck"></i> En camino</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="completado-tab" data-toggle="tab" href="#completado"><i class="fas fa-check-circle"></i> Completados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cancelados-tab" data-toggle="tab" href="#cancelados"><i class="fas fa-times-circle"></i> Cancelados</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="pendientes" class="tab-pane fade show active">
            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número del Pedido</th>
                            <th>Fecha</th>
                            <th>Precio Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendientes as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>BOB {{ number_format($pedido->totalPedido, 2, '.', '') }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td><a href="{{ route('pedidos-hechos.detalles-productos', ['pedidoId' => $pedido->id]) }}" class="btn btn-primary">Detalles</a></td>
                            <td>

                                <form action="{{ route('cancelar.pedido', ['pedidoId' => $pedido->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH') <!-- Utiliza el método PATCH para enviar la solicitud de cancelación -->

                                    <button type="submit" class="btn btn-danger">Cancelar Pedido</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div id="completado" class="tab-pane fade">
            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número del Pedido</th>
                            <th>Fecha</th>
                            <th>Precio Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completados as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>BOB {{ number_format($pedido->totalPedido, 2, '.', '') }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <a href="{{ url('/pedidos-hechos/detalles/' . $pedido->id) }}" class="btn btn-primary">Ver Detalles</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="camino" class="tab-pane fade">
            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número del Pedido</th>
                            <th>Fecha</th>
                            <th>Precio Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enCamino as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>BOB {{ number_format($pedido->totalPedido, 2, '.', '') }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td><a href="{{ url('/pedidos-hechos/detalles/' . $pedido->id) }}" class="btn btn-primary">Ver Detalles</a></td>
                            <td>
                                <form id="cancelarForm{{ $pedido->id }}" action="{{ url('/pedidos-hechos/cancelar/' . $pedido->id) }}" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-danger" onclick="confirmarCancelacion('{{ $pedido->id }}', '{{ $pedido->fecha_hora_pedido }}')">Cancelar Pedido</button>


                                    <input type="hidden" name="fecha_hora_pedido" value="{{ $pedido->fecha_hora_pedido }}">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="cancelados" class="tab-pane fade">
            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número del Pedido</th>
                            <th>Fecha</th>
                            <th>Precio Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cancelados as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>BOB {{ number_format($pedido->totalPedido, 2, '.', '') }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td><a href="{{ route('pedidos-hechos.detalles-productos', ['pedidoId' => $pedido->id]) }}" class="btn btn-primary">Detalles</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmarCancelacion(pedidoId, fechaHoraPedido) {
        var fechaPedido = new Date(fechaHoraPedido.replace(/-/g, '/'));

        var fechaLimite = new Date(fechaPedido);
        fechaLimite.setMinutes(fechaLimite.getMinutes() + 7);

        var ahora = new Date();

        if (ahora > fechaLimite) {
            var confirmacionSinReembolso = confirm("Han pasado más de 7 minutos. Si cancelas el pedido ahora, no recibirás reembolso. ¿Estás seguro de que deseas continuar?");

            if (!confirmacionSinReembolso) {
                return;
            }
        } else {
            var confirmacion = confirm("¿Estás seguro de que deseas cancelar este pedido?");

            if (!confirmacion) {
                return;
            }
        }

        document.getElementById("cancelarForm" + pedidoId).submit();
    }
</script>


@stop

@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/Listado/listWorks.css') }}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/Listado/listWorks.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Escuchar eventos de clic en las pestañas
        $('.nav-link').click(function() {
            var tabId = $(this).attr('href').substring(1); // Obtener el ID de la pestaña
            mostrarSolicitudes(tabId);
        });

        // Función para mostrar u ocultar las solicitudes
        function mostrarSolicitudes(tabId) {
            $('.tab-pane').hide(); // Ocultar todas las solicitudes
            $('#' + tabId).show(); // Mostrar las solicitudes de la pestaña seleccionada
        }
    });
</script>

<script>
    console.log('Hi!');
</script>
@stop
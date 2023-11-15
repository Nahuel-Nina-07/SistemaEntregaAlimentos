<!-- resources/views/PedidosHechos/pedidosHechos.blade.php -->

@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="content">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes"><i class="fas fa-clock"></i> Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="aceptados-tab" data-toggle="tab" href="#aceptados"><i class="fas fa-check-circle"></i> Aceptados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rechazados-tab" data-toggle="tab" href="#rechazados"><i class="fas fa-times-circle"></i> Rechazados</a>
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
                            <td>
                                <?php
                                $precioTotal = 0;
                                foreach ($pedido->detalles as $detalle) {
                                    $precioTotal += $detalle->precio_unitario;
                                }
                                echo number_format($precioTotal, 2, '.', ''); // Mostrar con 2 decimales
                                ?>
                            </td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <button class="btn btn-primary">Detalles</button>
                                @if($pedido->estado == 'pendiente')
                                <button class="btn btn-danger">Cancelar Pedido</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="aceptados" class="tab-pane fade">
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
                        @foreach($aceptados as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>
                                <?php
                                $precioTotal = 0;
                                foreach ($pedido->detalles as $detalle) {
                                    $precioTotal += $detalle->precio_unitario;
                                }
                                echo number_format($precioTotal, 2, '.', ''); // Mostrar con 2 decimales
                                ?>
                            </td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                            <a href="{{ url('/pedidos-hechos/detalles/' . $pedido->id) }}" class="btn btn-primary">Ver Detalles</a>
                                <button class="btn btn-danger">Cancelar Pedido</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="rechazados" class="tab-pane fade">
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
                        @foreach($rechazados as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->fecha_hora_pedido }}</td>
                            <td>
                                <?php
                                $precioTotal = 0;
                                foreach ($pedido->detalles as $detalle) {
                                    $precioTotal += $detalle->precio_unitario;
                                }
                                echo number_format($precioTotal, 2, '.', ''); // Mostrar con 2 decimales
                                ?>
                            </td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <button class="btn btn-primary">Detalles</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
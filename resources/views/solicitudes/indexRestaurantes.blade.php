@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="content">
<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="todos-tab" data-toggle="tab" href="#todos"><i class="fas fa-list"></i> Todas las Solicitudes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="aceptados-tab" data-toggle="tab" href="#aceptados"><i class="fas fa-check-circle"></i> Aceptados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes"><i class="fas fa-clock"></i> Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="rechazados-tab" data-toggle="tab" href="#rechazados"><i class="fas fa-times-circle"></i> Rechazados</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="todos" class="tab-pane fade show active">
            <ul class="team">
                @foreach($solicitudes as $solicitud)
                <!-- Mostrar todas las solicitudes aquí -->
                <li class="member">
                    <div class="thumb"><img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
                    <div class="description">
                        <h3>{{ $solicitud->nombre_solicitante }}</h3>
                        <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.show', $solicitud->id) }}">Ver detalles</a></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div id="aceptados" class="tab-pane fade">
            <ul class="team">
                @foreach($aceptados as $solicitud)
                <!-- Mostrar las solicitudes aceptadas aquí -->
                <li class="member">
                    <div class="thumb"><img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
                    <div class="description">
                        <h3>{{ $solicitud->nombre_solicitante }}</h3>
                        <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.aceptadas', $solicitud->id) }}">Ver detalles</a></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div id="pendientes" class="tab-pane fade">
            <ul class="team">
                @foreach($pendientes as $solicitud)
                <!-- Mostrar las solicitudes pendientes aquí -->
                <li class="member">
                    <div class="thumb"><img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
                    <div class="description">
                        <h3>{{ $solicitud->nombre_solicitante }}</h3>
                        <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.show', $solicitud->id) }}">Ver detalles</a></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div id="rechazados" class="tab-pane fade">
            <ul class="team">
                @foreach($rechazados as $solicitud)
                <!-- Mostrar las solicitudes rechazadas aquí -->
                <li class="member">
                    <div class="thumb"><img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
                    <div class="description">
                        <h3>{{ $solicitud->nombre_solicitante }}</h3>
                        <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.show', $solicitud->id) }}">Ver detalles</a></p>
                    </div>
                </li>
                @endforeach
            </ul>
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
    $(document).ready(function () {
        // Mostrar todas las solicitudes al cargar la página
        mostrarSolicitudes('todos');

        // Escuchar eventos de clic en las pestañas
        $('.nav-link').click(function () {
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

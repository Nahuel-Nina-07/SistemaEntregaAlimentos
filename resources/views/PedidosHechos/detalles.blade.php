@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container mt-4">
    <br><br>
    <!-- Detalles del Repartidor -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header" style="background-color: #3498db; color: #ffffff; text-align: center;">
                        <h3 class="mb-0">Datos del Repartidor</h3>
                    </div>
                    <div class="card-body d-md-flex align-items-center" style="background-color: #ecf0f1;">
                        @if($repartidor)
                        <div class="row g-0">
                            <div class="col-md-4 mb-md-0 mb-3">
                                <div class="profile-image-container">
                                    <img src="{{ $repartidor->profile_photo_url }}" alt="Imagen del Repartidor" class="rounded profile-image img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="mb-2">
                                        <p><b>Id:</b> {{ $repartidor->detalleRepartidor->repartidor_id }}</p>
                                        <p><b>Nombre:</b> {{ $repartidor->name }} {{ $repartidor->apellido }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <p><b>Teléfono:</b> {{ $repartidor->telefono }}</p>
                                        <p><b>Nro Placa:</b> {{ $repartidor->detalleRepartidor->Placa_vehiculo }}</p>
                                    </div>
                                    <!-- Agrega más detalles del repartidor según sea necesario -->
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="text-muted">No hay repartidor asignado para este pedido.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <h3 style="text-align: center;">Productos</h3>

    <!-- Detalles de los Productos -->
    <div class="row mt-4" style="border-radius: 25px;">
        @foreach($detallesProductos as $detalle)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="height: 210px;"> <!-- Ajusta la altura según tus necesidades -->
                        <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}" class="img-fluid h-100 w-100" style="object-fit: cover; background-color: #ddd; padding: 10px; text-align: center;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="font-size: 18px;">
                            <h2 class="card-title"><b>{{ $detalle->producto->nombre }}</b></h2><br><br>
                            <p class="card-text"><b>Cantidad:</b> {{ $detalle->cantidad }}</p>
                            <p class="card-text"><b>Precio Unitario:</b> BOB {{ number_format($detalle->precio_unitario, 2, '.', '') }}</p>
                            <p class="card-text"><b>Subtotal:</b> BOB {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2, '.', '') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        <h4>Total del Pedido: BOB {{ number_format($totalPedido, 2, '.', '') }}</h4>
    </div>
</div>
@stop

@section('css')
<style>
    .profile-image-container {
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 10px;
        /* Ajusta el valor según lo desees */
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
        font-size: 16px;
        /* Ajusta el tamaño del texto según lo desees */
    }

    .mb-2 {
        margin-bottom: 10px;
        /* Ajusta el espacio entre los elementos según lo desees */
    }
</style>
@stop

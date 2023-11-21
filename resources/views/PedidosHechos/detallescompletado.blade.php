@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container mt-4">
    <br><br>
    <!-- Detalles del Repartidor -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2" style="height: 250px;">
                    <div class="card-header" style="background-color: #3498db; color: #ffffff; text-align: center;">
                        <h3 class="mb-0">Datos del Repartidor</h3>
                    </div>
                    <div class="card-body d-flex align-items-center" style="background-color: #ecf0f1;">
                        @if($repartidor)
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="profile-image-container">
                                    <img src="{{ $repartidor->profile_photo_url }}" alt="Imagen del Repartidor" class="rounded profile-image" style="max-height: 100%; max-width: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column justify-content-center" style="font-size: 16px; text-align: center;">
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

                        @php
                        $usuarioYaReporto = \App\Models\Reporte::where('user_id', auth()->user()->id)
                        ->where('repartidor_id', $repartidor->id)
                        ->exists();
                        @endphp
                        @if($usuarioYaReporto)
                        <button class="btn btn-warning" disabled>Reportado</button>
                        @else
                        <button class="btn btn-danger" data-toggle="modal" data-target="#reportarModal">Reportar</button>
                        @endif
                        @else
                        <p>No hay repartidor asignado para este pedido.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>
    <h3 style="text-align: center;">Productos</h3>
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

<div class="modal fade" id="reportarModal" tabindex="-1" role="dialog" aria-labelledby="reportarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportarModalLabel">Reportar al Repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para el reporte -->
                <form method="POST" action="{{ route('reportar.repartidor') }}">
                    @csrf
                    <input type="hidden" name="repartidor_id" value="{{ $repartidor->id }}">
                    <div class="form-group">
                        <label for="motivo">Motivo del reporte</label>
                        <textarea class="form-control" name="motivo" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Reporte</button>
                </form>
            </div>
        </div>
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
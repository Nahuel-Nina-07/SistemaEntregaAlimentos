@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container mt-4">

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="mb-0">Repartidor</h3>
        </div>
        <div class="card-body">
            @if($repartidor)
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $repartidor->profile_photo_url }}" alt="Imagen del Repartidor" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                <div>
                    <p class="mb-2">Nombre: {{ $repartidor->name }} {{ $repartidor->apellido }}</p>
                    <p class="mb-2">Teléfono: {{ $repartidor->detalleRepartidor->telefono }}</p>
                    <p class="mb-2">Nro Placa: {{ $repartidor->detalleRepartidor->Placa_vehiculo }}</p>
                    <!-- Agrega más detalles del repartidor según sea necesario -->
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

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Productos</h3>
        </div>
        <div class="card-body">
            @foreach($detallesProductos as $detalle)
            <p class="mb-2">Producto: {{ $detalle->producto->nombre }}</p>
            <p class="mb-2">Cantidad: {{ $detalle->cantidad }}</p>
            <p class="mb-2">Precio: BOB {{ $detalle->precio_unitario }}</p>
            <!-- Agrega más detalles del producto según sea necesario -->
            @endforeach
        </div>
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
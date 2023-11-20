@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container mt-4">
    <h2 style="text-align: center;">Productos del Pedido</h2>
    <h6>Fecha del Pedido: {{ $pedido->fecha_hora_pedido }}</h6>

    <!-- Mostrar detalles de los productos -->
    <div class="row mt-4" style="border-radius: 25px;">
        @foreach($detallesProductos as $detalle)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="height: 200px;"> <!-- Ajusta la altura según tus necesidades -->
                        <img src="{{ asset($detalle->producto->imagen) }}" alt="{{ $detalle->producto->nombre }}" class="img-fluid h-100 w-100" style="object-fit: cover; background-color: #ddd; padding: 10px; text-align: center;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><b>{{ $detalle->producto->nombre }}</b></h3><br><br>
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

    <!-- Mostrar el total del pedido -->
    <div class="mt-4">
        <h4>Total del Pedido: BOB {{ number_format($totalPedido, 2, '.', '') }}</h4>
    </div>

</div>
@stop
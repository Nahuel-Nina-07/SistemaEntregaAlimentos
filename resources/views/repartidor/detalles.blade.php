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
                        <h3 class="mb-0">Datos del Usuario</h3>
                    </div>
                    <div class="card-body d-md-flex align-items-center" style="background-color: #ecf0f1;">
                        
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="profile-image-container">
                                    <img src="{{ $pedidoAceptado->usuario->adminlte_image() }}" alt="Imagen del Repartidor" class="rounded profile-image img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="mb-2">
                                        <p><b>Nombre:</b> {{ $pedidoAceptado->usuario->name }} {{ $pedidoAceptado->usuario->apellido }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <p><b>Teléfono:</b> {{ $pedidoAceptado->usuario->telefono }}</p>
                                        <p><b>Correo:</b> {{ $pedidoAceptado->usuario->email }}</p>
                                    </div>
                                    <!-- Add more details of the user if needed -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <h3 style="text-align: center;">Productos</h3>

    <!-- Detalles de los Productos -->
    <div class="row mt-4" style="border-radius: 25px;">
        @foreach($pedidoAceptado->productos as $producto)
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4" style="height: 210px;"> <!-- Ajusta la altura según tus necesidades -->
                        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="img-fluid h-100 w-100" style="object-fit: cover; background-color: #ddd; padding: 10px; text-align: center;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" style="font-size: 18px;">
                            <h2 class="card-title"><b>{{ $producto->nombre }}</b></h2><br><br>
                            <p class="card-text"><b>Cantidad:</b> {{ $producto->pivot->cantidad }}</p>
                            <p class="card-text"><b>Precio Unitario:</b> BOB {{ $producto->precio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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

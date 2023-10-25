@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="row">
        @foreach ($restaurantes as $restaurante)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $restaurante->imagen }}" alt="Imagen del restaurante">
                    <div class="card-body">
                        <h3 >{{ $restaurante->nombre }}</h3>
                        <p class="card-subtitle text-muted">Dirección: {{ $restaurante->CiudadNegocio }} / {{ $restaurante->CalleNegocio }}</p>
                        <p class="card-subtitle text-muted">Teléfono: {{ $restaurante->telefono }}</p><br>
                        <p class="card-text">{{ $restaurante->descripcion }} en este restaurante</p>
                        <a href="{{ route('productos.index', ['restaurante_id' => $restaurante->id]) }}" class="btn btn-success btn-sm">Ver productos</a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="far fa-heart"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop

@section('css')

@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
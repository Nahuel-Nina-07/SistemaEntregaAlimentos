@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Detalles del Reporte</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Motivo del Reporte</h4>
                        <div class="border p-3 mb-3">
                            {{ $reporte->motivo }}
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                    <h4><b>Repartidor</b></h4>
                        <img src="{{ $reporte->repartidor->profile_photo_url }}" alt="{{ $reporte->repartidor->name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <h4><b>{{ $reporte->repartidor->name }} {{ $reporte->repartidor->apellido }}</b></h4>
                        <p><b>{{ $reporte->repartidor->email }}</b></p>
                        <a href="{{ route('user.details', ['id' => $reporte->repartidor->id]) }}" class="btn btn-primary">Ir al Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
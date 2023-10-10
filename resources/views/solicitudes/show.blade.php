@extends('layouts.apps')

@section('content')
    <div class="container">
        <h1>Información de la Solicitud de Trabajo</h1>
        <div class="card">
            <div class="card-body">
                <h2>{{ $solicitud->nombre_solicitante }}</h2>
                <img src="{{ $solicitud->image }}" alt="{{ $solicitud->nombre }}" width="200">
                <!-- Mostrar otros detalles de la solicitud de trabajo aquí -->
            </div>
        </div>
    </div>
@endsection

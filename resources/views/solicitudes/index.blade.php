@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Solicitudes de Trabajo</h1>

    @if($solicitudes->isEmpty())
        <p>No hay solicitudes de trabajo disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Edad</th>
                    <th>Vehículo Propio</th>
                    <th>Tipo de Vehículo</th>
                    <th>Imagen Propiedad Vehículo</th>
                    <th>CI Número</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->id }}</td>
                        <td>{{ $solicitud->nombre_solicitante }}</td>
                        <td>{{ $solicitud->apellido_solicitante }}</td>
                        <td>{{ $solicitud->correo_electronico_solicitante }}</td>
                        <td>{{ $solicitud->telefono_solicitante }}</td>
                        <td>{{ $solicitud->edad ? 'Sí' : 'No' }}</td>
                        <td>{{ $solicitud->vehiculoPropio ? 'Sí' : 'No' }}</td>
                        <td>{{ $solicitud->tipo_vehiculo }}</td>
                        <td>
                            <img src="{{ asset($solicitud->imagen_propiedad_vehiculo) }}" alt="Imagen Vehículo"
                                width="100">
                        </td>
                        <td>{{ $solicitud->ci_numero }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@extends('solicitudesRestaurantes.index')

@section('contenido')
<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Negocio</th>
        <th scope="col">Dueño</th>
        <th scope="col">Correo</th>
        <th scope="col">Fecha</th>
        <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitudes as $solicitud)
        <tr>
            <td>{{$solicitud->id}}</td>
            <td>{{$solicitud->NombreNegocio}}</td>
            <td>{{$solicitud->nombrePropietario}}</td>
            <td>{{$solicitud->CorreoNegocio}}</td>
            <td>{{$solicitud->created_at}}</td>
            <td>
                <a class="btn btn-info" data-toggle="modal" data-target="#modal{{$solicitud->id}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
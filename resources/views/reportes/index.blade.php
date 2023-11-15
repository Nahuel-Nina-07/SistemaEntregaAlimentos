@extends('adminlte::page')


@section('content')
<div class="container">
        <h2>Reportes de Repartidores</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Fecha de Reporte</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->id }}</td>
                        <td>{{ $reporte->usuario->email }}</td>
                        <td>{{ $reporte->fecha_solicitud }}</td>
                        <td>
                            <a href="{{ route('reportes.detalle', $reporte->id) }}" class="btn btn-primary">Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
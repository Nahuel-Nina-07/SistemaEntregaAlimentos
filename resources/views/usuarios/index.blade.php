@extends('adminlte::page')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>
                    <img src="{{ $usuario->adminlte_image() }}" alt="{{ $usuario->name }}" width="50" height="50">
                </td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>
                    @foreach($usuario->roles as $rol)
                    {{ $rol->name }}
                    @endforeach
                </td>
                <td>
                    <a href="" class="btn btn-primary">Detalles</a>
                    <button class="btn btn-danger">Eliminar</button>
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
<script>
    console.log('Hi!');
</script>
@stop
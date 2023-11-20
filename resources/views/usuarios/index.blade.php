@extends('adminlte::page')

@section('content')
<div class="container mt-4">
    <div class="form-group">
        <label for="roleFilter">Filtrar por Rol:</label>
        <select id="roleFilter" class="form-control">
            <option value="todos">Todos</option>
            <option value="repartidor">Repartidor</option>
            <option value="usuario">Usuario</option>
            <option value="revisor">Revisor</option>
        </select>
    </div>
    <div class="form-group">
        <label for="search">Buscar por Email:</label>
        <input type="text" class="form-control" id="search" placeholder="Ingrese el correo electrónico">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Email</th>
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
                <td>{{ $usuario->email }}</td>
                <td>
                    @foreach($usuario->roles as $rol)
                    {{ $rol->name }}
                    @endforeach
                </td>
                <td>
                <a href="{{ route('usuarios.detalles', ['id' => $usuario->id]) }}" class="btn btn-primary">Detalles</a>
                <td>
                    <form action="{{ route('usuarios.toggleStatus', ['id' => $usuario->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-{{ $usuario->status ? 'success' : 'danger' }}">
                            {{ $usuario->status ? 'Activo' : 'Suspendido' }}
                        </button>
                    </form>
                </td>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#roleFilter, #search').on('input', function() {
            // Obtener el valor del filtro de rol
            var roleFilter = $('#roleFilter').val().toLowerCase();
            
            // Obtener el valor del campo de búsqueda
            var searchValue = $('#search').val().toLowerCase();

            // Filtrar la tabla según el valor del filtro de rol y búsqueda
            $('tbody tr').filter(function() {
                var roles = $(this).find('td:nth-child(4)').text().toLowerCase(); // Ajusta el índice según tu estructura HTML
                var hasRole = roleFilter === 'todos' || roles.indexOf(roleFilter) > -1;
                var hasSearchText = $(this).text().toLowerCase().indexOf(searchValue) > -1;
                $(this).toggle(hasRole && hasSearchText);
            });
        });
    });
</script>
@stop
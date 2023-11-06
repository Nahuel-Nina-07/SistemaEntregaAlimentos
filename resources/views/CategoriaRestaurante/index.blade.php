@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<br><br>
<div class="container">
    <h2>Categorías de Restaurantes</h2>
    <a class="btn btn-primary" data-toggle="modal" data-target="#createCategoria">Crear Categoría</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriasRestaurantes as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td><img src="{{ asset($categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="img-thumbnail custom-image-size"></td>
                <td>
                    <a href="{{ route('categoriasRestaurantes.destroy', $categoria) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCategoria{{ $categoria->id }}">Editar</a>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoria{{ $categoria->id }}">Eliminar</button>
                </td>
            </tr>

            <!-- Modal para editar -->
            <div class="modal fade" id="editCategoria{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoriaLabel{{ $categoria->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoriaLabel{{ $categoria->id }}">Editar Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('categoriasRestaurantes.update', $categoria) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $categoria->nombre }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" class="form-control" name="imagen" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para eliminar -->
            <div class="modal fade" id="deleteCategoria{{ $categoria->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoriaLabel{{ $categoria->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCategoriaLabel{{ $categoria->id }}">Confirmar Eliminación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar la categoría "{{ $categoria->nombre }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('categoriasRestaurantes.destroy', $categoria) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="modal fade" id="createCategoria" tabindex="-1" role="dialog" aria-labelledby="createCategoriaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoriaLabel">Crear Categoría</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('categoriasRestaurantes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" class="form-control" name="imagen" accept="image/*" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </tbody>
    </table>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    h2 {
        text-align: center;
    }

    tr {
        text-align: center;
    }

    .custom-image-size {
        width: 100px;
        /* Define el ancho deseado */
        height: 100px;
        /* Define la altura deseada */
    }

    .table td,
    .table th {
        vertical-align: middle;
    }
</style>
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
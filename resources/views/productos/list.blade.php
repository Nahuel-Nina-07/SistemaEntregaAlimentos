@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="todos-tab" data-toggle="tab" href="#todos"><i class="fas fa-list"></i>Crear Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="aceptados-tab" data-toggle="tab" href="#aceptados"><i class="fas fa-check-circle"></i>Lista de Productos</a>
        </li>
    </ul>

    <div class="tab-content">
        <br>
        <div id="todos" class="tab-pane fade show active">
            <div class="container">
                <h2>Crear Producto</h2>
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Columna para la imagen del producto -->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="productoImg">Imagen del Producto:</label>
                                <input type="file" class="form-control-file" id="productoImg" name="imagen" accept="image/*">
                                <br><br>
                                <img id="preview" src="#" alt="Vista previa de la imagen" style="display: none; width: 500px; height: 400px;">
                            </div>
                        </div>

                        <!-- Columna para el formulario de datos -->
                        <div class="col-md-6">

                            <!-- Campo para el nombre del producto -->
                            <div class="form-group">
                                <label for="nombre">Nombre del Producto:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <!-- Campo para la descripción del producto -->
                            <div class="form-group">
                                <label for="descripcion">Descripción del Producto:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                            </div>

                            <div class="row">
                                <!-- Columna para el precio del producto -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio">Precio del Producto:</label>
                                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                                    </div>
                                </div>

                                <!-- Columna para la cantidad del producto -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad del Producto:</label>
                                        <input type="number" class="form-control" id="cantidad" name="stock" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <!-- Columna para la categoría del producto -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoria">Categoría del Producto:</label>
                                        <select class="form-control" id="categoria" name="categoria_id" required>
                                            @foreach($categorias as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Columna para el restaurante del producto -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="restaurante">Restaurante del Producto:</label>
                                        <select class="form-control" id="restaurante" name="restaurante_id" required>
                                            @foreach($restaurantes as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar Producto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="aceptados" class="tab-pane fade">
            <h2>Lista de Productos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Restaurante</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producto as $productos)
                    <tr>
                        <td><img src="{{ asset($productos->imagen) }}" alt="{{ $productos->nombre }}" class="img-thumbnail custom-image-size"></td>
                        <td>{{ $productos->nombre }}</td>
                        <td>BOB {{ $productos->precio }}</td>
                        <td>{{ $productos->categoria->nombre }}</td>
                        <td>{{ $productos->restaurante->nombre }}</td>
                        <td>{{ $productos->stock }}</td>
                        <td class="descripcion">{{ $productos->descripcion }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarModal{{ $productos->id }}">Editar</button>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal{{ $productos->id }}">Eliminar</button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @foreach($producto as $productos)
        <div class="modal fade" id="editarModal{{ $productos->id }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $productos->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel{{ $productos->id }}">Editar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('productos.update', ['producto' => $productos->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $productos->nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $productos->precio }}">
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Categoría:</label>
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                    @foreach($categorias as $categoriaId => $categoriaNombre)
                                    <option value="{{ $categoriaId }}" {{ $categoriaId == $productos->categoria_id ? 'selected' : '' }}>{{ $categoriaNombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="restaurante_id">Restaurante:</label>
                                <select class="form-control" id="restaurante_id" name="restaurante_id">
                                    @foreach($restaurantes as $restauranteId => $restauranteNombre)
                                    <option value="{{ $restauranteId }}" {{ $restauranteId == $productos->restaurante_id ? 'selected' : '' }}>{{ $restauranteNombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen">
                            </div>

                            <div class="form-group">
                                <label for="stock">cantidad:</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $productos->stock }}">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion">{{ $productos->descripcion }}</textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Modal de Eliminación -->
        @foreach($producto as $productos)
        <div class="modal fade" id="eliminarModal{{ $productos->id }}" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel{{ $productos->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel{{ $productos->id }}">Eliminar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar el producto: <strong>{{ $productos->nombre }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('productos.destroy', ['producto' => $productos->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .nav-tabs .nav-item {
        width: 50%;
        /* Divide el ancho en 4 partes iguales para las 4 opciones */
    }

    .nav-tabs .nav-link {
        text-align: center;
        /* Centra el texto horizontalmente */
    }

    .tab-pane {
        display: flex;
        justify-content: center;
        /* Centra horizontalmente el contenido en cada pestaña */
        align-items: center;
        /* Centra verticalmente el contenido en cada pestaña */
        text-align: center;
        /* Alinea el texto en el centro horizontalmente */
    }

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

    .table {
        width: 100%;
    }

    .table th,
    .table td {
        vertical-align: middle;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .descripcion {
        max-width: 200px;
        /* Ajusta el valor de acuerdo a tu preferencia */
        word-wrap: break-word;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Mostrar todas las solicitudes al cargar la página
        mostrarSolicitudes('todos');

        // Escuchar eventos de clic en las pestañas
        $('.nav-link').click(function() {
            var tabId = $(this).attr('href').substring(1); // Obtener el ID de la pestaña
            mostrarSolicitudes(tabId);
        });

        // Función para mostrar u ocultar las solicitudes
        function mostrarSolicitudes(tabId) {
            $('.tab-pane').hide(); // Ocultar todas las solicitudes
            $('#' + tabId).show(); // Mostrar las solicitudes de la pestaña seleccionada
        }
    });
</script>
<script>
    // Función para mostrar una vista previa de la imagen seleccionada
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview')
                    .attr('src', e.target.result)
                    .show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Cuando se cambia el archivo, llamar a la función de vista previa
    $("#productoImg").change(function() {
        previewImage(this);
    });
</script>
<script>
    console.log('Hi!');
</script>
@stop
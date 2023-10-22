@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
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
                                @foreach($productos as $id => $nombre)
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

@stop
@section('js')
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
@stop
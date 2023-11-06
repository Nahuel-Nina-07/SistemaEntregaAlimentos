@extends('adminlte::page')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="ruta/a/jquery.min.js"></script>
<script src="ruta/a/bootstrap.min.js"></script>
<link rel="stylesheet" href="ruta/a/bootstrap.min.css">

<script>
    $(document).ready(function() {
        // Abre el modal automáticamente al cargar la página
        $('#miModal').modal('show');
    });
</script>

<div class="modal fade" id="solicitudModal" tabindex="-1" role="dialog" aria-labelledby="solicitudModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitudModalLabel">Ingresar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guardarNombreCi') }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Aquí coloca los campos para nombre_solicitante, apellido_solicitante, edad y ci_numero -->
                    <div class="form-group">
                        <label for="nombre_solicitante">Nombre</label>
                        <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_solicitante">Apellido</label>
                        <input type="text" class="form-control" id="apellido_solicitante" name="apellido_solicitante" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>
                    <div class="form-group">
                        <label for="ci_numero">Número de CI</label>
                        <input type="number" class="form-control" id="ci_numero" name="ci_numero" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
@stop
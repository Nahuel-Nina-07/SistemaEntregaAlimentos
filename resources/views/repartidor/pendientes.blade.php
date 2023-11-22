@extends('adminlte::page')

@section('content')
<div class="container text-center mt-5">
    <!-- Mostrar el pedido aceptado si existe -->
    <br><br>
    @if(isset($pedidoAceptado))
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Pedido Aceptado</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha del Pedido</th>
                        <th class="text-center">Ubicación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ $pedidoAceptado->usuario->adminlte_image() }}" alt="Foto de Perfil" class="img-thumbnail" width="50">
                        </td>
                        <td>{{ $pedidoAceptado->fecha_hora_pedido }}</td>
                        <td>
                            <a href="{{ route('pedidosrepartidor.index') }}" class="text-success">
                                <i class="fas fa-map-marker-alt" style="font-size: 30px;"></i>
                            </a>
                        </td>
                        <td>{{ $pedidoAceptado->estado }}</td>
                        <td>
                            @if(isset($pedidoAceptado))
                            <a href="{{ route('pedidos.detalles-aceptado') }}" class="btn btn-primary">Detalles</a>
                            <button class="btn btn-danger" onclick="cancelarPedido('{{ $pedidoAceptado->id }}')">Cancelar</button>
                            @if ($pedidoAceptado->estado === 'en camino' && $distanciaAlDestino >= 1 && $distanciaAlDestino <= 15) <button class="btn btn-success" data-toggle="modal" data-target="#capturaModal">Entregar Pedido</button>
                                @endif
                                @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <br>
    <!-- Mostrar la lista de pedidos pendientes -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">Pedidos Pendientes</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha del Pedido</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidosPendientes as $pedido)
                    <tr>
                        <td>
                            <img src="{{ $pedido->usuario->adminlte_image() }}" alt="Foto de Perfil" class="img-thumbnail" width="50">
                        </td>
                        <td>{{ $pedido->fecha_hora_pedido }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>
                            <form action="{{ route('pedidos.aceptar', $pedido->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para la captura de la foto -->
<div class="modal fade" id="capturaModal" tabindex="-1" role="dialog" aria-labelledby="capturaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="capturaModalLabel">Captura de Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="mensajeValidacion">Para confirmar la entrega, captura una foto con la cámara.</p>
                <div id="camaraSection">
                    <video id="camera" width="100%" height="auto" autoplay></video>

                </div>
                <div id="fotoCapturadaSection" style="display: none;">
                    <img id="fotoCapturada" width="100%" height="auto">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="capturar">Capturar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning" id="volverASacarFoto" style="display: none;">Volver a Sacar Foto</button>
                <button type="button" class="btn btn-success" id="enviar" style="display: none;">Enviar</button>
            </div>
        </div>
    </div>
</div>




<!-- ... (código existente) ... -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... (código existente) ...

        // Modificar el evento del botón "Entregar Pedido"
        $('#capturaModal').on('show.bs.modal', function(e) {
            // Obtener el elemento de video y configurar la cámara
            const video = document.getElementById('camera');
            const fotoCapturadaElement = document.getElementById('fotoCapturada');

            // Variable para almacenar la foto capturada
            let fotoCapturada = null;

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.log("Error al acceder a la cámara: " + err);
                });

            // Manejar el evento de capturar foto
            document.getElementById('capturar').addEventListener('click', function() {
                // Ocultar la sección de la cámara y mostrar la sección de la foto capturada
                document.getElementById('camaraSection').style.display = 'none';
                document.getElementById('fotoCapturadaSection').style.display = 'block';

                // Crear un lienzo para la captura de la foto
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const context = canvas.getContext('2d');

                // Dibujar el fotograma actual en el lienzo
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convertir la captura a base64 (puedes ajustar el formato según tus necesidades)
                fotoCapturada = canvas.toDataURL('image/jpeg');

                // Mostrar la foto capturada
                fotoCapturadaElement.src = fotoCapturada;

                // Desactivar el botón de capturar y mostrar los otros botones
                document.getElementById('capturar').style.display = 'none';
                document.getElementById('mensajeValidacion').innerText = "¿La foto capturada es correcta?";
                document.getElementById('volverASacarFoto').style.display = 'inline-block';
                document.getElementById('enviar').style.display = 'inline-block';
            });

            // Manejar el evento de volver a sacar foto
            document.getElementById('volverASacarFoto').addEventListener('click', function() {
                // Restaurar la sección de la cámara y ocultar la sección de la foto capturada
                document.getElementById('camaraSection').style.display = 'block';
                document.getElementById('fotoCapturadaSection').style.display = 'none';

                // Reactivar el botón de capturar y ocultar los otros botones
                document.getElementById('capturar').style.display = 'inline-block';
                document.getElementById('volverASacarFoto').style.display = 'none';
                document.getElementById('enviar').style.display = 'none';

                // Restaurar el mensaje de validación
                document.getElementById('mensajeValidacion').innerText = "Para confirmar la entrega, captura una foto con la cámara.";
            });

            // Manejar el evento de enviar
            document.getElementById('enviar').addEventListener('click', function() {
                // Aquí puedes enviar la fotoCapturada al servidor o hacer lo que desees
                console.log("Foto capturada:", fotoCapturada);

                // Cerrar el stream de la cámara
                video.srcObject.getTracks().forEach(track => track.stop());

                // Cerrar el modal
                $('#capturaModal').modal('hide');
            });
        });

        // Manejar el evento de cerrar el modal
        $('#capturaModal').on('hide.bs.modal', function(e) {
            // Obtener el elemento de video y detener la cámara
            const video = document.getElementById('camera');
            video.srcObject.getTracks().forEach(track => track.stop());
        });
    });
</script>

<script>
    function cancelarPedido(pedidoId) {
        // Realiza una solicitud Ajax al controlador para cancelar el pedido
        $.ajax({
            url: '/repartidor/cancelar-pedido/' + pedidoId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Realiza cualquier acción adicional si es necesario
                console.log('Pedido cancelado exitosamente.');

                // Recarga la página después de cancelar el pedido
                location.reload();
            },
            error: function(error) {
                // Maneja errores si es necesario
                console.log('Error al cancelar el pedido:', error);
            }
        });
    }
</script>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('scripts')
@endsection
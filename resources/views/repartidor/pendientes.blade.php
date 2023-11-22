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
                            @if ($pedidoAceptado->estado === 'en camino' && $distanciaAlDestino >= 1 && $distanciaAlDestino <= 15) <button class="btn btn-danger" onclick="cancelarPedidoU('{{ $pedidoAceptado->id }}')">entregar pedido</button>
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





<!-- ... (código existente) ... -->



<script>
    function cancelarPedidoU(pedidoId) {
        // Realiza una solicitud Ajax al controlador para cancelar el pedido
        $.ajax({
            url: '/repartidor/aceptar-pedido/' + pedidoId,
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
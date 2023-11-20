@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="{{ $usuario->profile_photo_url }}" alt="{{ $usuario->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{ $usuario->name}} {{ $usuario->apellido}}
                    </h5>
                    <h6>
                        {{ $usuario->id}}
                    </h6>
                    <p class="proile-rating">Fecha incorporacion : <span>{{ $usuario->fecha_incorporacion }}</span></p>
                    <div class="btn-group" role="group" aria-label="Botones de navegación">
                        <button type="button" class="btn btn-primary active" data-toggle="tab" data-target="#home" onclick="changeButtonColor(this)">Datos del usuario</button>
                        <button type="button" class="btn btn-secondary" data-toggle="tab" data-target="#profile" onclick="changeButtonColor(this)">Documento privado de compra o arrendamiento vehicular </button>
                    </div>
                </div>
            </div>

            <form action="{{ route('usuariosreport.toggleStatus', ['id' => $usuario->id]) }}" method="post">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-{{ $usuario->status ? 'success' : 'danger' }} " style="max-width: 100px; height: 50px; margin-top:20px;">
                    {{ $usuario->status ? 'Activo' : 'Suspendido' }}
                </button>
            </form>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <br>
                    <h5>Datos del vehiculo</h5>
                    <br>
                    <h7>Vehiculo Propio: {{ $usuario->vehiculoPropio }}</h7>
                    <br><br>
                    <h7>Tipo de vehiculo: {{ $usuario->detalleRepartidor->tipo_vehiculo }}</h7>
                    <br><br>
                    <h7>Placa de vehiculo: {{ $usuario->Placa_vehiculo }}</h7>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="datos-usuario" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Id Usuario</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->id}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->name}} {{ $usuario->apellido }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Celular</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->detalleRepartidor->telefono }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>CI</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->detalleRepartidor->ci_numero }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Numero de reportes</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $usuario->reportes_count }}</p>
                            </div>
                        </div>
                    </div>
                    <div id="hola-mundo" style="display: none;">
                        <img src="{{ $usuario->detalleRepartidor->imagen_propiedad_vehiculo }}" alt="{{ $usuario->nombre }}" alt="" id="imagen">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/detallesPersonas/detalles.css') }}">
@stop

@section('js')
<script src="{{ asset('js/detalles.js') }}"></script>
@stop

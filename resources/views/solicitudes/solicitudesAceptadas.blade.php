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
                    <img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        {{ $solicitud->nombre_solicitante }} {{ $solicitud->apellido_solicitante }}
                    </h5>
                    <h6>
                        {{ $solicitud->id}}
                    </h6>
                    <p class="proile-rating">Fecha solicitud : <span>{{ $solicitud->fecha_solicitud }}</span></p>
                    <div class="btn-group" role="group" aria-label="Botones de navegación">
                        <button type="button" class="btn btn-primary active" data-toggle="tab" data-target="#home" onclick="changeButtonColor(this)">Datos del usuario</button>
                        <button type="button" class="btn btn-secondary" data-toggle="tab" data-target="#profile" onclick="changeButtonColor(this)">Documento privado de compra o arrendamiento vehicular </button>
                    </div>
                </div>
            </div>

            <form method="post" action="{{ route('solicitudes.show', ['id' => $solicitud->id]) }}">
    @csrf

</form>



        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <br>
                    <h5>Datos del vehiculo</h5>
                    <br>
                    <h7>Vehiculo Propio: {{ $solicitud->vehiculoPropio }}</h7>
                    <br><br>
                    <h7>Tipo de vehiculo: {{ $solicitud->tipo_vehiculo }}</h7>
                    <br><br>
                    <h7>Placa de vehiculo: {{ $solicitud->Placa_vehiculo }}</h7>
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
                                <p>{{ $solicitud->id}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $solicitud->nombre_solicitante }} {{ $solicitud->apellido_solicitante }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $solicitud->correo_electronico_solicitante }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Celular</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $solicitud->telefono_solicitante }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>CI</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $solicitud->ci_numero }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Estado Solicitud</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $solicitud->estadoSolicitud }}</p>
                            </div>
                        </div>
                    </div>
                    <div id="hola-mundo" style="display: none;">
                        <img src="{{ $solicitud->imagen_propiedad_vehiculo }}" alt="{{ $solicitud->nombre }}" alt="" id="imagen">
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Listado/listWorks.css') }}">
</head>

<body>
    <div class="content">
        <ul class="team">
            @foreach($solicitudes as $solicitud)
            <li class="member">
                <div class="thumb"><img src="{{ $solicitud->imagen_propiedad_vehiculo }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
                <div class="description">
                    <h3>{{ $solicitud->nombre_solicitante }}</h3>
                    <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.show', $solicitud->id) }}">Ver detalles</a></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
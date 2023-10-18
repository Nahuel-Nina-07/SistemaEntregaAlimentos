<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Aceptados, Rechazados y Pendientes</title>
  <!-- Agregar referencia a Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Listado/listWorks.css') }}">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="aceptados-tab" data-toggle="tab" href="#aceptados" role="tab" aria-controls="aceptados" aria-selected="true">Aceptados</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="rechazados-tab" data-toggle="tab" href="#rechazados" role="tab" aria-controls="rechazados" aria-selected="false">Rechazados</a>
      </li>
      <li class="nav-item" role of presentation">
        <a class="nav-link" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="false">Pendientes</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="aceptados" role="tabpanel" aria-labelledby="aceptados-tab">
        <h2 class="mt-3">Personas Aceptadas</h2>
        <ul class="team">
          @foreach($solicitudes as $solicitud)
          <li class="member">
            <div class="thumb"><img src="{{ $solicitud->imagen_repartidor }}" alt="{{ $solicitud->nombre_solicitante }}"></div>
            <div class="description">
              <h3>{{ $solicitud->nombre_solicitante }}</h3>
              <p>{{ $solicitud->nombre_solicitante }} es un miembro del equipo. Puede incluir detalles adicionales aquí si es necesario.<br><a href="{{ route('solicitudes.show', $solicitud->id) }}">Ver detalles</a></p>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
      <div class="tab-pane fade" id="rechazados" role="tabpanel" aria-labelledby="rechazados-tab">
        <h2 class="mt-3">Personas Rechazadas</h2>
        <!-- Puedes agregar personas rechazadas aquí si es necesario -->
      </div>
      <div class="tab-pane fade" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
        <h2 class="mt-3">Personas Pendientes</h2>
        <!-- Puedes agregar personas pendientes aquí si es necesario -->
      </div>
    </div>
  </div>

  <!-- Agregar referencia a Bootstrap JS y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

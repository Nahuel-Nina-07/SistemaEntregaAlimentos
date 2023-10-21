<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/Repartidor/form.css') }}">
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="demo-page">
    <!-- <div class="demo-page-navigation"></div> -->

    <main class="demo-page-content">
      <section>
        <!-- <div class="href-target" id="input-types"></div> -->
        <h1>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
            <line x1="21" y1="10" x2="3" y2="10" />
            <line x1="21" y1="6" x2="3" y2="6" />
            <line x1="21" y1="14" x2="3" y2="14" />
            <line x1="21" y1="18" x2="3" y2="18" />
          </svg>
          Ingresa tus datos
        </h1>
        <p>Por normas de seguridad necesitamos que lenes todos los campos.</p>
        <form method="POST" action="{{ url('/guardar-restaurante') }}" enctype="multipart/form-data">
          @csrf
          <div class="nice-form-group">
            <label>Tipo de Negocio</label>
            <select name="tipoNegocio" required>
              @foreach($categoriasRestaurantes as $id => $nombre)
              <option value="{{ $id }}">{{ $nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="nice-form-group">
            <label>Nombre del local</label>
            <input type="text" placeholder="Nombre de tu negocio" value="" name="NombreNegocio" required />
          </div>

          <div class="nice-form-group">
            <label>Número de contacto</label>
            <input type="text" placeholder="Número de contacto" value="" name="NumeroContacto" required />
          </div>

          <div class="nice-form-group">
            <label>Correo electrónico</label>
            <input type="email" placeholder="Correo electrónico" value="" name="CorreoNegocio" required />
          </div>

          <br>
          <details>
            <summary>
              <button type="submit" onclick="mostrarMensajeRequisito()">
                <div class="toggle-code">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code">
                    <polyline points="16 18 22 12 16 6" />
                    <polyline points="8 6 2 12 8 18" />
                  </svg>
                  Enviar
                </div>
              </button>
            </summary>
          </details>
          <br>
          <br>
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

        </form>
      </section>

    </main>

  </div>
</body>

</html>
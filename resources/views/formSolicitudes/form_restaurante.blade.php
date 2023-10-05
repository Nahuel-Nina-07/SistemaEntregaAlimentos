<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página con Fondo</title>
    <link rel="stylesheet" href="{{ asset('css/registerRestaurante/formRestaurante.css') }}"> <!-- Reemplaza con la ruta real de tu archivo CSS -->
</head>
<body>

<div class="demo-page">
  <div class="demo-page-navigation">
    
  </div>
  <main class="demo-page-content">
    <section>
      <div class="href-target" id="input-types"></div>
      <h1>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
          <line x1="21" y1="10" x2="3" y2="10" />
          <line x1="21" y1="6" x2="3" y2="6" />
          <line x1="21" y1="14" x2="3" y2="14" />
          <line x1="21" y1="18" x2="3" y2="18" />
        </svg>
        Ingresa tus datos
      </h1>

      <div class="nice-form-group">
        <label>Nombre del propietario</label>
        <input type="text" placeholder="Nombre del propietario" value="" />
      </div>

      <div class="nice-form-group">
        <label>Apellidos del propietario</label>
        <input type="email" placeholder="Apellidos del propietario" value="" />
      </div>

      <div class="nice-form-group">
        <label>Calle del negocio</label>
        <input type="tel" placeholder="Calle del negocio" value="" />
      </div>

      <div class="nice-form-group">
        <label>Ciudad del negocio</label>
        <input type="url" placeholder="Ciudad del negocio" value="" />
      </div>

      <div class="nice-form-group">
        <label for="categoria_restaurante">Selecciona una categoria:</label>
        <select id="categoriasRestaurante" name="categoriaR">
            <option value="0">Por favor selecciona</option>
            <option value="manzana">Manzana</option>
            <option value="pera">Pera</option>
            <option value="uva">Uva</option>
            <option value="naranja">Naranja</option>
        </select>
      </div>

      <div class="nice-form-group">
        <label for="tipoServicio">Tu negocio hace envíos a domicilio?</label>
            <select id="tipoServicio" name="tipoServicio">
                <option value="0">Por favor selecciona</option>
                <option value="1">Envío y recogida</option>
                <option value="2">Solo recogida</option>
                <option value="3">Solo envío a domicilio</option>
            </select>
      </div>
      <div class="nice-form-group" id="repDropdown" style="display: none;">
        <label for="repartidores">Tienes tus propios repartidores?</label>
        <select id="repartidores" name="repartidores" disabled>
            <option value="0">Por favor selecciona</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>
    </div>

    <script>
        // Obtén referencias a los dropdowns
        const tipoServicioDropdown = document.getElementById('tipoServicio');
        const repDropdown = document.getElementById('repDropdown');
        const repartidoresDropdown = document.getElementById('repartidores');

        // Agrega un evento de cambio al primer dropdown
        tipoServicioDropdown.addEventListener('change', function () {
            // Si se selecciona la opción 1 o 3, muestra el segundo dropdown y habilita las opciones
            if (this.value === '1' || this.value === '3') {
                repDropdown.style.display = 'block';
                repartidoresDropdown.disabled = false;
            } else {
                // De lo contrario, oculta el segundo dropdown y lo deshabilita
                repDropdown.style.display = 'none';
                repartidoresDropdown.disabled = true;
            }
        });
    </script>
      <details>
        <summary>
          <div class="sendData">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code">
              <polyline points="16 18 22 12 16 6" />
              <polyline points="8 6 2 12 8 18" />
            </svg>
            Enviar
          </div>
        </summary>
      </details>
    </section>

  </main>
</div>
</body>
</html>
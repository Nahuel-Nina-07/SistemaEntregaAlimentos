<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página con Fondo</title>
    <link rel="stylesheet" href="{{ asset('css/registerRestaurante/uneteRestaurante.css') }}"> <!-- Reemplaza con la ruta real de tu archivo CSS -->
</head>
<body>
    
<div class="demo-page">
  <div class="demo-page-navigation">
    <h2>
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
        Únete gratis
      </h1>

      <div class="nice-form-group">
      <label for="tipoNegocio">Tipo de negocio</label>
        <select id="tipoNegocio" name="tipoNegocio">
            <option value="0">Por favor selecciona</option>
            <option value="1">Restaurante</option>
            <option value="2">Alimentación</option>
        </select>
      </div>

      <div class="nice-form-group">
        <label>Nombre de tu negocio</label>
        <input type="email" placeholder="Nombre de tu negocio" value="" required />
      </div>

      <div class="nice-form-group">
        <label>Número de contacto</label>
        <input type="tel" placeholder="Número de contacto" value="" required />
      </div>

      <div class="nice-form-group">
        <label>Correo electrónico</label>
        <input type="url" placeholder="Correo electrónico" value="" required/>
      </div>
      <details>
        <summary>
        <a href="{{ route('registerRestaurante.form_restaurante') }}">
          <div class="sendData">
          
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code">
              <polyline points="16 18 22 12 16 6" />
              <polyline points="8 6 2 12 8 18" />
            </svg>
            Únete
          </div>
        </summary>
      </details>
    </section>

  </main>
</div>
    <!-- Contenido de tu página -->
</body>
</html>
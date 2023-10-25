<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html,body{
            margin:0;
            padding:0;
        }
        .navbar {
            background-color:#FF416C;
            color: #f2f2f2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            color:#f2f2f2;
            font-size: 24px;
            margin: 0;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #FF416C;
            min-width: 150px;
            z-index: 1;
            right: 0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            padding: 10px;
            text-decoration: none;
            display: block;
            color: #f2f2f2;
        }

        .dropdown-item:hover {
            background-color: #f2f2f2;
            color:#FF416C;
            
        }
        .contenedor{
          margin-top:-35%;
          display:flex;
          justify-content:space-around;
          

        }
        .texto-inicial{
          color:#f2f2f2;
          width:30%;
          font-size:40px;
        }
        .contenedor-form{
          width:30%;
          padding:1%;
          background-color:#f2f2f2;
          border-radius:15px;
          margin-right:5%;
          
        }
        .boton-subir{
          margin-top:5%;
          height:100%;
          width:100%;
        }
        .imagen1 img{
          display:flex;
          justify-content:center;
          align-items:center;
          width:100%;
          height:600px;
        }
        .btn{
          background-color:#FF416C;
          color:#f2f2f2;
        }
        .btn:hover{
          background-color:#E0E0E0;
          color:#FF416C;
        }
        .texto{
          display:column;
          align-items:center;
          margin-top:8%;
          text-align:center;
          margin-left:8%;
          margin-right:8%;
        }
        .texto-inicio{
          color:#FF416C;
        }
        .texto-sec{
          font-size:20px; 
        }
        .card {
            width: 30%; /* Ancho de la card (ajusta según tus necesidades) */
            background-color: #fff;
            border:0;
            border-radius: 5px;
            box-shadow: 0 ;
            text-align: center;
            margin-left:8%;
            margin-right:8%;
            margin-top:1%;
            align-items:center;

        }
        .logo{
          width:50%;
          height:50%;
        }
        .info{
          display:flex;
          justify-content:space-around;
        }
        .descripcion{
          font-size:20px;
        }
        .porque-unirse{
          background-color:#e0e0e0;
          display:column;
          align-items:center;
          text-align:center;
          padding-top:3%;
          padding-bottom:3%;
          padding-right:3%;
          padding-left:3%;

        }
        .card2 {
            width: 40%; /* Ancho de la card (ajusta según tus necesidades) */
            background-color: #e0e0e0;
            border:0;
            border-radius: 5px;
            box-shadow: 0 ;
            text-align: center;
            margin-left:8%;
            margin-right:8%;
            margin-top:5%;
            align-items:center;
            margin-bottom:0;

        }
        .presentation{
          width:100%;
        }
        footer{
            text-align:center;
            background-color:#FF416C;
            color: #f2f2f2;
            height:auto;
        }
        .text-footer{
            margin:0;
        }
    </style>
</head>
<body>
    

  <div class="navbar">
    <div class="navbar-brand">AlmanacProject</div>
    <div class="dropdown">
      <a class="dropdown-item" href="#">Inicio</a>
      <div class="dropdown-content">
        @auth
        <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
        @else
        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
        <a class="dropdown-item" href="{{ route('repartidor.create') }}">Solicitar Trabajo</a>
        <a class="dropdown-item" href="{{ route('welcome') }}">Home</a>
        @endauth
      </div>
    </div>
  </div>
  <div class="imagen1">
    <img src="https://static.vecteezy.com/system/resources/previews/001/900/914/non_2x/blurred-restaurant-scene-with-empty-tabletop-free-photo.jpg" alt="imagen inicial">
  </div>
  <div class="contenedor">
    <div class="texto-inicial">
        Bienvenido a AlmanacProject. Únete a nosotros y empieza a disfrutar de las ventajas.
    </div>
    <div class="contenedor-form">
      <form method="POST" action="{{ url('/guardar-restaurante') }}">
        <h4>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather">
            <line x1="21" y1="10" x2="3" y2="10" />
            <line x1="21" y1="6" x2="3" y2="6" />
            <line x1="21" y1="14" x2="3" y2="14" />
            <line x1="21" y1="18" x2="3" y2="18" />
          </svg>
          Únete Gratis
        </h4>
        @csrf
          <div class="nice-form-group">
            <label for="tipoNegocio" class="form-label">Tipo de Negocio</label>
            <select class="form-select" id="tipoNegocio" name="tipoNegocio" required>
              @foreach($categoriasRestaurantes as $id => $nombre)
              <option value="{{ $id }}">{{ $nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Nombre de tu negocio</label>
            <input class="form-control" type="text" name="NombreNegocio" placeholder="Nombre de tu negocio" value="" required />
          </div>

          <div class="mb-3">
            <label class="form-label">Número de contacto</label>
            <input class="form-control" type="tel" name="NumeroContacto" placeholder="Número de contacto" value="" required />
          </div>

          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input class="form-control" type="email" name="CorreoNegocio" placeholder="Correo electrónico" value="" required/>
          </div>
          <div class="boton-subir">
            <button type="submit" class="btn">Enviar</button>
          </div>
      </form>
    </div>
  </div>
  <div class="texto">
    <h2 class="texto-inicio">Impulsa tu negocio asociandote con el servicio de comida líder en Vinto</h2>
    <p class="texto-sec">Date de alta ahora en AlmanacProject e incrementa tu negocio de comida a domicilio. Abre un nuevo canal de venta y date a conocer diariamente a miles de nuevos clientes.</p>
  </div>
  <div class="info">
    <div class="card">  
      <img class="logo" src="https://restaurantes.just-eat.es/images/icons/daily-saving.svg" alt="imagen-delivery"> 
      <div class="presentation">
        <h4 class="presentation-text">Nuevos pedidos a domicilio</h4>
        <p class="descripcion">Aumenta tus ingresos entre un 15% - 25 % gracias a los nuevos pedidos online</p>
      </div>
    </div>
    <div class="card">  
      <img class="logo" src="https://restaurantes.just-eat.es/images/icons/innovative-tech.svg" alt="imagen-delivery"> 
      <div class="presentation">
        <h4 class="presentation-text">Tecnología Innovadora</h4>
        <p class="descripcion">Mejora el proceso de pedidos y la experiencia de tus clientes con la tecnología de AlmanacProject.</p>
      </div>
    </div>
  </div>
  <div class="porque-unirse">
    <h2 class="texto-inicio">¿Por qué unirte a AlmanacProject ?</h2>
    <p class="descripcion">Nuestro objetivo es ayudarte con las últimas innovaciones, ayudándote a alcanzar el éxito con nuevas ideas.</p>
    <div class="info">
      <div class="card2">  
        <img class="logo" src="https://restaurantes.just-eat.es/images/icons/more-orders.svg" alt="imagen-delivery"> 
        <div class="presentation">
          <h4 class="presentation-text">Consigue más pedidos</h4>
          <p class="descripcion">A través de nuestras efectivas campañas de marketing daremos a conocer tu negocio y podrás llegar a los millones de nuevos clientes que visitan Just Eat.</p>
        </div>
      </div>
      <div class="card2">  
        <img class="logo" src="https://restaurantes.just-eat.es/images/icons/more-value.svg" alt="imagen-delivery"> 
        <div class="presentation">
          <h4 class="presentation-text">Hazlo a tu manera</h4>
          <p class="descripcion">Existimos porque existen negocios como el tuyo. Ofrecemos la flexibilidad necesaria para que te beneficies de nuestros servicios con opciones de delivery y apoyo estratégico a tu medida.</p>
        </div>
      </div>
    </div> 
  </div>
  <footer>
    <p class="text-footer">Derechos de autor © 2023 AlmanacProject. Todos los derechos reservados.</p>
  </footer>
    <!-- Contenido de tu página -->
</body>
</html>
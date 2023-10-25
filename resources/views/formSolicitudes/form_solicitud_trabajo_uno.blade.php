<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Trabajo</title>
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
        .contenedor-form{
            width:30%;
            padding:1%;
            background-color:#f2f2f2;
            border-radius:15px;
            margin-right:5%;
            margin-top:-35%;
            margin-bottom:5%;
        }
        .alinear-derecha{
            width:100%;
            display:flex;
            justify-content:end;
        }
        .boton-subir{
            margin-top:3%;
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
        <a class="navbar-brand" href="{{ route('welcome') }}">AlmanacProject</a>
        <div class="dropdown">
            <a class="dropdown-item" href="#">Inicio</a>
            <div class="dropdown-content">
                @auth
                <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                <a class="dropdown-item" href="{{ route('registerRestaurante.uneteRestaurante') }}">Solicitar Restaurante</a>
                <a class="dropdown-item" href="{{ route('welcome') }}">Home</a>
                @endauth
            </div>
        </div>
    </div>
    <div class="imagen1">
        <img src="https://static.vecteezy.com/system/resources/previews/001/900/914/non_2x/blurred-restaurant-scene-with-empty-tabletop-free-photo.jpg" alt="imagen inicial">
    </div>
    <div class="alinear-derecha">
        <div class="contenedor-form">
        <!-- <div class="demo-page-navigation"></div> -->

        
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
                <p>Por normas de seguridad necesitamos que llenes todos los campos.</p>
                <form method="POST" action="{{ url('/guardar-basicos') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="nice-form-group">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" name="nombre_solicitante" placeholder="Ingrese su nombre" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label class="form-label">Apellido</label>
                        <input class="form-control" type="text" name="apellido_solicitante" placeholder="Ingrese su apellido" value="" required />
                    </div>

                    <fieldset class="nice-form-group">
                        <label class="form-label">¿Tienes más de 18 años?</label>
                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-1" value="1" />
                            <label for="r-1">Si</label>
                        </div>

                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-2" value="0" />
                            <label for="r-2">No</label>
                        </div>
                    </fieldset>

                    <div class="nice-form-group">
                        <label class="form-label">Numero de cédula o pasaporte</label>
                        <input class="form-control" type="tel" placeholder="Ingrese su cédula/pasaporte(sin guion)" value="" name="ci_numero" required />
                    </div>
                    <div class="boton-subir">
                        <button class="btn" type="submit" onclick="mostrarMensajeRequisito()">
                            Enviar
                        </button>
                    </div>
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
        </div>
    </div>
    <footer>
        <p class="text-footer">Derechos de autor © 2023 AlmanacProject. Todos los derechos reservados.</p>
  </footer>
</body>

</html>
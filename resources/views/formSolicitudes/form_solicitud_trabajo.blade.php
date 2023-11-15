<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    .boton-subir{
      margin-top:3%;
    }
    .btn{

      background-color:#FF416C;
      color:#f2f2f2;
    }
    .btn:hover{
      background-color:#E0E0E0;
      color:#FF416C;
    }
    .imagen1 img{
      display:flex;
      justify-content:center;
      align-items:center;
      width:100%;
      height:100%;
    }
    .contenedor-form{
      width:30%;
      padding:1%;
      background-color:#f2f2f2;
      border-radius:15px;
      margin-right:5%;
      margin-top:-60%;
      margin-bottom:9%;
          
    }
    .alinear-derecha{
      width:100%;
      display:flex;
      justify-content:end;
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
                <a class="dropdown-item" href="{{ route('repartidor.create') }}">Solicitar Trabajo</a>
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
                    Ingresa tus datos detallados
                </h1>
                <p>Por normas de seguridad necesitamos que llenes todos los campos.</p>
                <form method="POST" action="{{ url('/guardar-detallados') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="nice-form-group">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="correo_electronico_solicitante" placeholder="Ingrese su email" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label class="form-label">Telefono</label>
                        <input class="form-control" type="tel" name="telefono_solicitante" placeholder="Ingrese su numero" value="" required />
                    </div>
                    <div class="nice-form-group">
                        <label class="form-label">Placa vehiculo</label>
                        <input class="form-control" type="tel" name="Placa_vehiculo" placeholder="Ingrese su numero" value="" required />
                    </div>


                    <fieldset class="nice-form-group">
                        <label class="form-label">¿Tienes tu propio vehículo?</label>
                        <div class="nice-form-group">
                            <input type="radio" name="vehiculoPropio" id="r-3" value="1" />
                            <label class="form-label" for="r-3">Si</label>
                        </div>

                        <div class="nice-form-group">
                            <input type="radio" name="vehiculoPropio" id="r-4" value="0" />
                            <label class="form-label" for="r-4">No</label>
                        </div>
                    </fieldset>

                    <div class="nice-form-group">
                        <label for="tipo_vehiculo" class="form-label">Selecciona tu tipo de movilidad</label>
                        <select class="form-select" id="tipo_vehiculo" name="tipo_vehiculo" required>
                            <!-- <option>Elige tu transporte</option> -->
                            <option>Moto</option>
                            <option>Auto</option>
                        </select>
                    </div>

                    <div class="nice-form-group">
                        <label class="form-label">Documento privado de compra o arrendamiento vehicular</label>
                        <input class="form-control" type="file" name="imagen_propiedad_vehiculo" accept="image/*" required />
                    </div>
                    <div class="nice-form-group">
                        <label class="form-label">Suba una imagen de usted</label>
                        <input class="form-control" type="file" name="imagen_repartidor" accept="image/*" required />
                    </div>
                    <div class="boton-subir">
                        <button type="submit" class="btn">Enviar</button>
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
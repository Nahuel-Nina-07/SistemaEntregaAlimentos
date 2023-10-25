<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AlmanacProject</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilos para el navbar */
        html,body{
            margin:0;
            padding:0;
        }
        .navbar {
            background: #f2f2f2;
            color: #FF416C;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 24px;
            margin: 0;
            color:#FF416C;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f2f2f2;
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
            color:#FF416C;
        }

        .dropdown-item:hover {
            background-color: #FF416C;
            color:#f2f2f2;
            
        }
        .centeredElement{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .presentation {
            background-color: #FF416C;
            color: #f2f2f2;
            text-align: center;
            padding: 20px;
        }

        .presentation-text {
            font-size: 24px;
            margin: 0;
        }
        .boton1{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:1%;
        }
        .presentation-button {
            margin-top:0%;
            background-color: #f2f2f2;
            color: #000;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius:5px;
        }
        .presentation-button:hover{
            background-color: #f2f2f2;
            color:#FF416C;
        }
        .imagen1 img{
            display:flex;
            justify-content:center;
            align-items:center;
            width:100%;
            max-height:700px;
        }
        .texto-img {
            margin-top:-8%;
            background-color: rgba(0, 0, 0, 0); /* Fondo semitransparente */
            color: #FF416C; /* Texto blanco */
            padding: 10px; /* Espacio alrededor del texto */
            font-size:24px;
            text-align:center;
        }
        .card {
            width: 30%; /* Ancho de la card (ajusta según tus necesidades) */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom:3%;
            margin-top:3%;

        }

        /* Estilos para la imagen */
        .card img {
            width: 100%; /* La imagen ocupa todo el ancho de la card */
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .horizontal{
            display:flex;
            justify-content: space-around;
            
        }
        .boton{
            border:0;
            margin:0;
            height:100%;
            width:100%;

        }
        .boton:hover{
            color:#FF416C;
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
        .botones-card{
            height:100%;
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
                <a class="dropdown-item" href="{{ route('registerRestaurante.uneteRestaurante') }}">Solicitar Restaurante</a>
                @endauth
            </div>
        </div>
    </div>
    <div class="imagen1">
        <img src="{{ asset('images/hamburguesaFondo.png') }}" alt="imagen inicial">
        <div class="texto-img">
            ¡Bienvenido a AlmanacProject, tu puerta al sabor en Vinto! 
            Inicia sesión y comienza a disfrutar de los mejores platillos a solo un clic de distancia
        </div>
    </div>
    <div class="boton1">
        <a href="{{ route('login') }}">
            <button class="presentation-button">Iniciar Sesión</button>
        </a>
    </div>
    <div class="horizontal">
        <div class="card">   
            <img src="https://img.freepik.com/fotos-premium/chef-cocinando-cocina_152625-10442.jpg" alt="Imagen restaurante">
            <div class="presentation">
                <p class="presentation-text">Eres dueño de un Restaurante y deseas unirte a nosotros? Envía tu solicitud y empieza a disfrutar de las ventajas.</p>
            </div>
            <div class="botones-card">
                <a href="{{ route('registerRestaurante.uneteRestaurante') }}">
                    <button class="boton">Solicitar</button>
                </a>
            </div>
        </div>
        <div class="card">  
            <img src="https://media.istockphoto.com/id/1253501430/es/foto/motociclista-de-reparto-llegando-a-destino-motogirl.jpg?s=612x612&w=0&k=20&c=NxJroMBDx0fXT-31m8Wa2WEbnjCb2nxAXqsd2Iw_1AM=" alt="imagen-delivery"> 
            <div class="presentation">
                <p class="presentation-text">Quieres formar parte del equipo de envíos de AlmanacProject? Solicita tu puesto y empieza a trabajar.</p>
            </div>
            <div class="botones-card">
                <a href="{{ route('repartidor.create') }}">
                    <button class="boton">Solicitar</button>
                </a>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-footer">Derechos de autor © 2023 AlmanacProject. Todos los derechos reservados.</p>
    </footer>
</body>

</html>

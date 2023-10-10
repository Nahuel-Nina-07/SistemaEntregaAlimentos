<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Aplicación</title>
    <!-- Agrega aquí tus enlaces a hojas de estilo CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Agrega aquí la barra de navegación si es necesario -->
    </nav>

    <div class="container">
        <!-- Contenido principal de la página -->
        @yield('content')
    </div>

    <!-- Agrega aquí tus scripts JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

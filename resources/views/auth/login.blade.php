<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/login.css') }}">
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>


</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Crear cuenta</h1>
                <div class="social-container">
                    <a href="/auth/redirect" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="/google-auth/redirect" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="{{ route('trabajando') }}" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>o usa tu correo electrónico para registrarte</span>
                <input type="text" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus />
                <input type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required />
                <input type="password" placeholder="Contraseña" name="password" required />
                <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" required />
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Iniciar sesión</h1>
                <div class="social-container">
                    <a href="/auth/redirect" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="/google-auth/redirect" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="{{ route('trabajando') }}" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>o usa tu cuenta</span>
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus />
                <input type="password" name="password" placeholder="Contraseña" required autocomplete="current-password" />
                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
                    <button class="ghost" id="signIn">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>¡Hola, Amigo!</h1>
                    <p>Ingrese sus datos personales y comience su viaje con nosotros</p>
                    <button class="ghost" id="signUp">Registrarse</button>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
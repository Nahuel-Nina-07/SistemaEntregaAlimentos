<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background: url(https://as01.epimg.net/diarioas/imagenes/2021/11/13/actualidad/1636798497_047662_1636798568_noticia_normal_recorte1.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'HelveticaNeue', 'Arial', sans-serif;

        }

        a {
            color: #58bff6;
            text-decoration: none;
        }

        a:hover {
            color: #aaa;
        }

        .pull-right {
            float: right;
        }

        .pull-left {
            float: left;
        }

        .clear-fix {
            clear: both;
        }

        div.logo {
            text-align: center;
            margin: 20px 20px 30px 20px;
            fill: #566375;
        }

        div.logo svg {
            width: 180px;
            height: 100px;
        }

        .logo-active {
            fill: #44aacc !important;
        }

        #formWrapper {
            background: rgba(0, 0, 0, .2);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transition: all .3s ease;
        }

        .darken-bg {
            background: rgba(0, 0, 0, .5) !important;
            transition: all .3s ease;
        }

        div#form {
            position: absolute;
            width: 360px;
            height: 320px;
            height: auto;
            background-color: #fff;
            margin: auto;
            border-radius: 5px;
            padding: 20px;
            left: 50%;
            top: 50%;
            margin-left: -180px;
            margin-top: -200px;
        }

        div.form-item {
            position: relative;
            display: block;
            margin-bottom: 20px;
        }

        input {
            transition: all .2s ease;
        }

        input.form-style {
            color: #8a8a8a;
            display: block;
            width: 90%;
            height: 44px;
            padding: 5px 5%;
            border: 1px solid #ccc;
            -moz-border-radius: 27px;
            -webkit-border-radius: 27px;
            border-radius: 27px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background-color: #fff;
            font-family: 'HelveticaNeue', 'Arial', sans-serif;
            font-size: 105%;
            letter-spacing: .8px;
        }

        div.form-item .form-style:focus {
            outline: none;
            border: 1px solid #58bff6;
            color: #58bff6;
        }

        div.form-item p.formLabel {
            position: absolute;
            left: 26px;
            top: 2px;
            transition: all .4s ease;
            color: #bbb;
        }

        .formTop {
            top: -22px !important;
            left: 26px;
            background-color: #fff;
            padding: 0 5px;
            font-size: 14px;
            color: #58bff6 !important;
        }

        .formStatus {
            color: #8a8a8a !important;
        }

        input[type="submit"].login {
            float: right;
            width: 112px;
            height: 37px;
            -moz-border-radius: 19px;
            -webkit-border-radius: 19px;
            border-radius: 19px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background-color: #55b1df;
            border: 1px solid #55b1df;
            border: none;
            color: #fff;
            font-weight: bold;
        }

        input[type="submit"].login:hover {
            background-color: #fff;
            border: 1px solid #55b1df;
            color: #55b1df;
            cursor: pointer;
        }

        input[type="submit"].login:focus {
            outline: none;
        }
        h1{
            font-family: 'Pacifico', cursive;
            font: 60px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div id="formWrapper">
        <div id="form">
            <div class="logo">
                <h1>GoVin</h1>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-style" value="{{ $request->email }}" required autofocus readonly/>
                </div>

                <div class="form-item">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-style" required />
                </div>

                <div class="form-item">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-style" required />
                </div>

                <div class="form-item">
                    <input type="submit" class="login pull-right" value="Continuar">
                    <div class="clear-fix"></div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
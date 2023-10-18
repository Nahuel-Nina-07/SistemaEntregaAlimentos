@extends('adminlte::page')

@section('title', 'Solicitudes Trabajo')

@section('content_header')
    <h1>Solicitudes</h1>
@stop

@section('content')
    <!doctype html>
    <html lang="es" >
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

        <title>CRUD</title>
    </head>
    <body>
        <h1 class="bg-primary text-white text-center">CRUD Restaurantes</h1>
        <div class="container">
            @yield('contenido')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    </body>
    </html>
@stop
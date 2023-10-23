@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

<body>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        @foreach ($categorias as $categoria)
        <div class="col-md-3">
            <br>
            <div class="card-sl">
                <div class="card-image">
                    <div class="image-container">
                        <img class="categoria-image" src="{{ $categoria->imagen }}" />
                    </div>
                </div>
                <a class="card-action" href="#"><i class="fa fa-heart"></i></a>
                <div class="card-heading">
                    {{ $categoria->nombre }}
                </div>
                <div class="card-text">
                    {{ $categoria->descripcion }}
                </div>
                <a href="{{ route('restaurantes.index', ['categoria_id' => $categoria->id]) }}" class="card-button">Ver Restaurantes</a>

            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
    /*  Helper Styles */
    body {
        font-family: Varela Round;
        background: #f1f1f1;
    }

    a {
        text-decoration: none;
    }

    .categoria-image {
    width: 270px; /* Establece el ancho deseado */
    height: 160px; /* Establece la altura deseada */
}

    /* Card Styles */

    .card-sl {
        border-radius: 8px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }


    .card-action {
        position: relative;
        float: right;
        margin-top: -25px;
        margin-right: 20px;
        z-index: 2;
        color: #E26D5C;
        background: #fff;
        border-radius: 100%;
        padding: 15px;
        font-size: 15px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
    }

    .card-action:hover {
        color: #fff;
        background: #E26D5C;
        -webkit-animation: pulse 1.5s infinite;
    }

    .card-heading {
        font-size: 18px;
        font-weight: bold;
        background: #fff;
        padding: 10px 15px;
    }

    .card-text {
        padding: 10px 15px;
        background: #fff;
        font-size: 14px;
        color: #636262;
    }

    .card-button {
        display: flex;
        justify-content: center;
        padding: 10px 0;
        width: 100%;
        background-color: #1F487E;
        color: #fff;
        border-radius: 0 0 8px 8px;
    }

    .card-button:hover {
        text-decoration: none;
        background-color: #1D3461;
        color: #fff;

    }


    @-webkit-keyframes pulse {
        0% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
        }

        70% {
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1);
            box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
        }

        100% {
            -moz-transform: scale(0.9);
            -ms-transform: scale(0.9);
            -webkit-transform: scale(0.9);
            transform: scale(0.9);
            box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
        }
    }
    </style>
@stop


@extends('detalles')

@section('title', 'Dashboard')

@section('content')

<body>
    <div class="container" style="margin-top: 50px;">
        <div class="container1" style="margin-top: 50px;">
            <h4 style="text-align: center;">Categoria Restaurantes</h4>
            <div class="row" style="margin-top: -70px;">

                <section class="regular slider">
                    @foreach ($categorias as $categoria)
                    <div>
                        <img class="categoria-image" src="{{ $categoria->imagen }}" class="categoria-image" />
                        <p class="nombre"><b>{{ $categoria->nombre }}</b></p>
                        <div class="entrar">
                            <a style="color: #fff;" href="{{ route('restaurantes.por-categoria', ['categoria_id' => $categoria->id]) }}">Ver</a>
                        </div>
                    </div>
                    @endforeach
                </section>
            </div>
        </div>
        <br>
        <h4><b>Restaurantes</b></h4>
        <div class="row">
            @foreach ($listado as $restaurante)
            <div class="col-md-3 col-sm-6">
                <br>
                <div class="card-sl">
                    <div class="card-image">
                        <div class="image-container">
                            <img class="categoria-image" src="{{ $restaurante->imagen }}" />
                            <a class="card-action" href="#"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="card-heading">
                        {{ $restaurante->nombre }}
                    </div>
                    <a href="#" class="card-button">Ver Menu</a>
                    <!-- <a href="{{ route('restaurantes.por-categoria', ['categoria_id' => $categoria->id]) }}" class="card-button">Ver Menu</a> -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
<style>
    h4 {
        text-align: center;
    }

    .slider {
        width: 100%;
        margin: 100px auto;
    }

    .slick-slide {
        margin: 0px 20px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }

    .image-container {
        position: relative;
        text-align: center;
    }

    .image-container img {
        width: 100%;
    }

    .image-container p {
        margin-top: 10px;
        background-color: #0074d9;
        /* Fondo para el nombre */
        color: #fff;
        /* Color del texto del nombre */
        padding: 5px;
        /* Espaciado dentro del fondo */
        border-radius: 5px;
        /* Bordes redondeados */
        display: inline-block;
        /* Para centrar el nombre horizontalmente */
    }

    .nombre {
        background-color: #071952;
        text-align: center;
        color: #fff;
        height: 40px;

    }

    .entrar {
        background-color: #35A29F;
        color: #fff;
        text-align: center;
        margin-top: -20px;
        border-radius: 0 0 8px 8px;
    }

    .entrar:hover {
        text-decoration: none;
        background-color: #088395;
        color: #fff;
    }

    .categoria-image {
        width: 270px;
        /* Establece el ancho deseado */
        height: 160px;
        /* Establece la altura deseada */
    }
</style>
<style>
    /*  Helper Styles */
    body {
        font-family: Varela Round;
    }

    .categoria-image {
        width: 100%;
        /* Establece el ancho al 100% para que coincida con el contenedor */
        height: 200px;
        /* Establece una altura fija para todas las imágenes */
        object-fit: cover;
        /* Mantiene la relación de aspecto y cubre el contenedor */
    }

    /* Agregado para controlar la disposición en dispositivos móviles */
    @media (max-width: 768px) {
        .col-sm-6 {
            width: 50%;
        }
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
        text-align: center;
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
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5
        });
    });
</script>
@stop
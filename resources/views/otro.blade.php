@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <section class="regular slider">
            @foreach ($categorias as $categoria)
            <div>
                <img class="categoria-image" src="{{ $categoria->imagen }}" class="categoria-image"/>
                <p class="nombre"><b>{{ $categoria->nombre }}</b></p>
                <div class="entrar">
                    <a style="color: #fff;" href="{{ route('restaurantes.por-categoria', ['categoria_id' => $categoria->id]) }}">Ver</a>
                </div>
            </div>
            @endforeach
        </section>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
<style>
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
        background-color: #088395;
        color: #fff;
        text-align: center;
        margin-top: -20px;
    }
    .categoria-image {
    width: 270px; /* Establece el ancho deseado */
    height: 160px; /* Establece la altura deseada */
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
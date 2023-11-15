@extends('detalles')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)
@section('content')

<body>
    <div class="container" style="margin-top: 50px;">
        <div class="container1" style="margin-top: 50px;">
            <h4 style="text-align: center;"><b>Categoria Productos</b></h4>
            <div class="row" style="margin-top: -70px;">

                <section class="regular slider">
                    @foreach ($categorias as $categoria)
                    <div>
                        <img class="categoria-image" src="{{ $categoria->imagen }}" class="categoria-image" />
                        <p class="nombre"><b>{{ $categoria->nombre }}</b></p>
                        <div class="entrar">
                            <a style="color: #fff;" href="{{ route('producto.por-categoria', ['categoria_id' => $categoria->id]) }}">Ver</a>
                        </div>
                    </div>
                    @endforeach
                </section>
            </div>
        </div>
        <h4><b>Productos</b></h4>
<div class="row">
    @foreach ($listado as $producto)
    <div id="container">
        <div class="product-details">
            <h1>{{ $producto->nombre }}</h1><br>
            <span class="hint-star star">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
            </span>
            <p class="information">{{$producto->descripcion}}</p>
            <div class="control">
                <form action="{{ route('agregar-al-pedido', ['producto' => $producto]) }}" method="POST">
                    @csrf
                    @if ($producto->stock > 0)
                        <button class="btn">
                            <span class="price">BOB {{ $producto->precio }}</span>
                            <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true" style="color: #fff;"></i></span>
                            <span class="buy">Solicitar</span>
                        </button>
                    @else
                        <div class="agotado" style="text-align:right; color:red; font-size:17px;"><i class="fa-solid fa-hourglass" style="color: red;"><b> Agotado</b></i></div>
                    @endif
                </form>
            </div>
        </div>
        <div class="product-image">
            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
            <div class="info">
                <h2>{{ $producto->nombre }}</h2>
                <ul>
                    <li>Descripción:{{$producto->descripcion}}</li>
                    <li>Precio:{{$producto->precio}}</li>
                    
                </ul>
            </div>
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
    /* fonts  */
    @import url('https://fonts.googleapis.com/css?family=Abel|Aguafina+Script|Artifika|Athiti|Condiment|Dosis|Droid+Serif|Farsan|Gurajada|Josefin+Sans|Lato|Lora|Merriweather|Noto+Serif|Open+Sans+Condensed:300|Playfair+Display|Rasa|Sahitya|Share+Tech|Text+Me+One|Titillium+Web');

    #container {
        box-shadow: 0 15px 30px 1px rgba(128, 128, 128, 0.31);
        background: rgba(255, 255, 255, 0.90);
        text-align: center;
        border-radius: 20px;
        overflow: hidden;
        margin: 5em auto;
        height: 350px;
        width: 700px;

    }

    /* 	Product details  */
    .product-details {
        position: relative;
        text-align: left;
        overflow: hidden;
        padding: 20px;
        height: 100%;
        float: left;
        width: 40%;

    }

    /* 	Product Name */
    #container .product-details h1 {
        font-family: 'Old Standard TT', serif;
        display: inline-block;
        position: relative;
        font-size: 34px;
        color: #344055;
        margin: 0;

    }


    /*Product Rating  */
    .hint-star {
        display: inline-block;
        margin-left: 0.5em;
        color: gold;
        width: 50%;
    }


    /* The most important information about the product */
    #container .product-details>p {
        font-family: 'Farsan', cursive;
        text-align: center;
        font-size: 20px;
        color: #7d7d7d;

    }

    /* control */

    .control {

        position: absolute;
        bottom: 1%;
        left: 22.8%;

    }

    /* the Button */
    .btn {
        transform: translateY(0px);
        transition: 0.3s linear;
        background: #49C608;
        border-radius: 5px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        outline: none;
        border: none;
        color: #eee;
        padding: 0;
        margin: 0;

    }

    .btn:hover {
        transform: translateY(-4px);
    }

    .btn span {
        font-family: 'Farsan', cursive;
        transition: transform 0.3s;
        display: inline-block;
        padding: 10px 20px;
        font-size: 1.2em;
        margin: 0;

    }

    /* shopping cart icon */
    .btn .price,
    .shopping-cart {
        background: #333;
        border: 0;
        margin: 0;
    }

    .btn .price {
        transform: translateX(-10%);
        padding-right: 15px;
    }

    /* the Icon */
    .btn .shopping-cart {
        transform: translateX(-100%);
        position: absolute;
        background: #333;
        z-index: 1;
        left: 0;
        top: 0;
    }

    /* buy */
    .btn .buy {
        z-index: 3;
        font-weight: bolder;
    }

    .btn:hover .price {
        transform: translateX(-110%);
    }

    .btn:hover .shopping-cart {
        transform: translateX(0%);
    }



    /* product image  */
    .product-image {
        transition: all 0.3s ease-out;
        display: inline-block;
        position: relative;
        overflow: hidden;
        height: 100%;
        float: right;
        width: 50%;
        display: inline-block;
    }

    #container img {
        width: 100%;
        height: 100%;
    }

    .info {
        background: rgba(27, 26, 26, 0.9);
        font-family: 'Farsan', cursive;
        transition: all 0.3s ease-out;
        transform: translateX(-100%);
        position: absolute;
        line-height: 1.9;
        text-align: left;
        font-size: 120%;
        cursor: no-drop;
        color: #FFF;
        height: 100%;
        width: 100%;
        left: 0;
        top: 0;
    }

    .info h2 {
        text-align: center
    }

    .product-image:hover .info {
        transform: translateX(0);
    }

    .info ul li {
        transition: 0.3s ease;
    }

    .info ul li:hover {
        transform: translateX(50px) scale(1.3);
    }

    .product-image:hover img {
        transition: all 0.3s ease-out;
    }

    .product-image:hover img {
        transform: scale(1.2, 1.2);
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('alert'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: '{{ session('alert.type') }}',
            title: '{{ session('alert.message') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@stop
@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="container" style="margin-top: 50px;">
    <div class="row">
        @foreach ($productos as $producto)
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
                    <p class="information">" Especially good for container gardening, the Angelonia will keep blooming all summer even if old flowers are removed. Once tall enough to cut, bring them inside and you'll notice a light scent that some say is reminiscent of apples. "</p>
                    <div class="control">
                        <button class="btn">
                            <span class="price">BOB {{ $producto->precio }}</span>
                            <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true" style="color: #fff;"></i></span>
                            <span class="buy">Solicitar</span>
                        </button>
                    </div>
                </div>
                <div class="product-image">
                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                    <div class="info">
                        <h2>{{ $producto->nombre }}</h2>
                        <ul>
                            <li><strong>Sun Needs: </strong>Full Sun</li>
                            <li><strong>Soil Needs: </strong>Damp</li>
                            <li><strong>Zones: </strong>9 - 11</li>
                            <li><strong>Height: </strong>2 - 3 feet</li>
                            <li><strong>Blooms in: </strong>Mid‑Summer - Mid‑Fall</li>
                            <li><strong>Features: </strong>Tolerates heat</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@stop

@section('css')
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

@stop
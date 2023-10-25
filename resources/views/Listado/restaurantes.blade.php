@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')

<body>
    <main>
        <ul class="item-list">
            @foreach ($restaurantes as $index => $restaurante)
            <li class="item{{ $index + 1 }}">
                <input type="radio" name="point" id="slide{{ $index + 1 }}" {{ $index === 0 ? ' checked' : '' }}>
                <label for="slide{{ $index + 1 }}" class="label">
                    <h3 style="text-align: center;"><b>{{ $restaurante->nombre }}</b></h3>
                    <h4>Codewars call to me,<br><br>
                        Challenging my skills to slay<br>
                        Cthulhu with code.</h4><span class="control"></span>
                    <div class="slider ">
                        <img sizes="(max-width: 589px) 100vw" src="{{ $restaurante->imagen }}" alt="{{ $restaurante->nombre }}" style=" object-fit: cover; width: 100%; height: 100%;">
                    </div>
                </label>
            </li>
            @endforeach
        </ul>
    </main>
</body>

</html>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="https://kenwheeler.github.io/slick/slick/slick-theme.css">
<style>
    @import url("https://fonts.googleapis.com/css2?family=BIZ+UDGothic&display=swap");

    :root {
        --color-one: #007bff;
        --color-two: #364b44;
        --text-color: #c2e6ef;
        --mem-width: min(38em, calc(100vw - 4em));
        --mem-height: min(36em, calc(100vw - 6em));
        --slide-duration: 0.9s;
        --text-duration: 0.9s;
        --text-l-height: 1.5em;
        --lbg: "https://lidachk.github.io/cssBayan/cssBayan/assets/lbg370.png";
        --lbg-50: "https://lidachk.github.io/cssBayan/cssBayan/assets/lbg50.png";
    }

    * {
        box-sizing: border-box;
    }

    ul {
        padding: 0;
        list-style: none;
    }

    body,
    h1,
    h4,
    p,
    ul,
    ol,
    li {
        margin: 0;
    }

    * {
        margin: 0;
    }

    body {
        font-family: "BIZ UDGothic", sans-serif;
        min-height: 100vh;
        scroll-behavior: smooth;
        text-rendering: optimizeSpeed;
        line-height: 1.5;

        color: var(--text-color);

        background-repeat: no-repeat, repeat, repeat;
        background-position: 0% 100%, 0 0, center;
        background-blend-mode: lighten;
        background-attachment: fixed;
        background-size: 100vmin, auto, auto;
        animation: start1 2s ease-in-out;
    }

    @keyframes start {
        0% {
            background-blend-mode: color-burn;
        }

        50% {
            background-blend-mode: darken;
        }

        100% {
            background-blend-mode: lighten;
        }
    }

    @keyframes start1 {
        0% {
            background-position: -100% 0, 0 0, center;
        }

        100% {
            background-position: 0 100%, 0 0, center;
        }
    }

    input,
    button,
    textarea,
    select {
        font: inherit;
    }

    main {
        margin: 1em auto;
        width: var(--mem-width);
        max-width: 100%;
        font-size: 0.7rem;
    }

    .head {
        display: block;
        width: 100%;
        height: auto;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        margin: 1em 0;
        text-transform: uppercase;
        text-align: center;
        text-transform: uppercase;
    }

    ul.item-list {
        max-width: var(--mem-width);
        margin: 0 auto;
    }

    img {
        max-width: 100%;
    }

    img[width][height] {
        height: auto;
    }

    /* Let SVG scale without boundaries */
    img[src$=".svg"] {
        width: 100%;
        height: auto;
        max-width: none;
    }

    input {
        display: none;
    }

    label {
        width: 100%;
        /*   display: flex;
  flex-direction: row;
  flex-wrap: wrap; */
        display: grid;
        grid-template-columns: 1fr auto;
        grid-template-rows: auto auto;
        grid-template-areas: "h4 control" "img img";
        margin-bottom: 1em;
        border-radius: 0.5em;
        background-color: #3876BF;
        transition: all 0.35s ease-in-out;
        padding: 0.5em;
    }

    label>h4 {
        height: var(--text-l-height);
        overflow: hidden;
        /*   text-overflow: ellipsis;
  animation: text-hide var(--text-duration) ease-in-out; */
        transition: height var(--text-duration) ease-in-out;
        grid-area: h4;
    }

    label>.control {
        grid-area: control;
    }

    label>.slider {
        grid-area: img;
    }

    .slider {
        margin-top: 1em;
        overflow: hidden;
        transition: all var(--slide-duration);
        height: 0;
    }

    input:checked+label>.slider {
        /*  animation: details-show var(--slide-duration) ease-in-out; */
        transition: height var(--slide-duration) ease-in-out;
        height: var(--mem-height);
    }

    input:checked+label>h4 {
        height: calc(var(--text-l-height) * 4);
        /* animation: text-show var(--text-duration) ease-in-out; */
        transition: height var(--text-duration) ease-in-out;
    }

    input:not(:checked)+label>.slider {
        /* animation: details-hide var(--slide-duration) ease-in-out; */
        transition: height var(--slide-duration) ease-in-out;
        height: 0;
    }

    .control {
        display: block;
        width: var(--text-l-height);
        height: var(--text-l-height);
        background: url(https://lidachk.github.io/cssBayan/cssBayan/assets/control.svg);
        filter: invert(1%) sepia(42%) saturate(1672%) hue-rotate(167deg) brightness(101%) contrast(87%);
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;

        transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;

        opacity: 0;
    }

    input:checked~label>.control {
        transform: rotate(-1.5turn);
        -webkit-transform: rotate(-1.5turn);
        -moz-transform: rotate(-1.5turn);
        -ms-transform: rotate(-1.5turn);
        -o-transform: rotate(-1.5turn);
    }

    @keyframes details-show {
        0% {
            height: 0;
        }

        100% {
            height: var(--mem-height);
        }
    }

    @keyframes details-hide {
        0% {
            height: var(--mem-height);
        }

        100% {
            height: 0;
        }
    }

    @keyframes text-show {
        0% {
            height: var(--text-l-height);
        }

        100% {
            height: calc(var(--text-l-height) * 3);
        }
    }

    @keyframes text-hide {
        0% {
            height: calc(var(--text-l-height) * 3);
        }

        100% {
            height: var(--text-l-height);
        }
    }

    @keyframes glow {
        0% {
            filter: drop-shadow(0 -0.2em 0.5em #5ed8d8);
        }

        100% {
            filter: drop-shadow(0 -0.2em 0.8em #5ed8d8);
        }
    }

    .label:active>.control,
    .label:active {
        opacity: 1;
        animation: 0.9s glow ease-in-out infinite alternate;
    }

    @media (hover: hover) {

        li,
        label {
            cursor: pointer;
        }

        input:not(:checked)+label:hover>.slider {
            /* animation: details-show var(--slide-duration) ease-in-out; */
            transition: height var(--slide-duration) ease-in-out;
            height: var(--mem-height);
        }

        input:not(:checked)+label:not(:hover)>.slider {
            /* animation: details-hide var(--slide-duration) ease-in-out; */
            transition: height var(--slide-duration) ease-in-out;
            height: 0;
        }

        input:not(:checked)+label:hover>h4 {
            /* animation: text-show var(--text-duration) ease-in-out; */
            transition: height var(--text-duration) ease-in-out;
            height: calc(var(--text-l-height) * 4);
        }

        input:not(:checked)+label:not(:hover)>h4 {
            /* animation: text-hide var(--text-duration) ease-in-out; */
            transition: height var(--text-duration) ease-in-out;
            height: var(--text-l-height);
        }

        ul:hover .control {
            opacity: 1;
        }

        input:not(:checked)+label:hover>.control {
            transform: rotate(1.25turn);
            -webkit-transform: rotate(1.25turn);
            -moz-transform: rotate(1.25turn);
            -ms-transform: rotate(1.25turn);
            -o-transform: rotate(1.25turn);
            filter: drop-shadow(0 -0.2em 0.5em #5ed8d8);
        }
    }

    @media all and (min-width: 820px) and (max-width: 1022px) {

        /*tablet*/
        body {
            background-image: url("https://lidachk.github.io/cssBayan/cssBayan/assets/lbg_470.png"),
                url("https://lidachk.github.io/cssBayan/cssBayan/assets/filter.svg"),
                linear-gradient(90deg, #261947, #63339c, #140f22);
        }

        .label {
            padding: 1em;
        }

        main {
            font-size: 1rem;
        }
    }

    @media all and (min-width: 1023px) {

        /*descktop*/
        :root {
            --mem-width: 38rem;
            --mem-height: 36rem;
        }

        .head {
            margin: 1em 0;
            text-align: center;
            text-transform: uppercase;
        }

        .label {
            padding: 1rem;
        }

        body {
            background-size: min(calc(50wv-20rem), 100vmin), auto, auto;
        }

        main {
            font-size: 1.5rem;
        }
    }
</style>
@stop

@section('js')
<!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
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
</script> -->
@stop
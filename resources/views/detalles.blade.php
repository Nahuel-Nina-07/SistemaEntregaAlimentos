@extends('adminlte::page')

@section('right-sidebar')
<style>
    .control-sidebar,
    .control-sidebar::before {
        bottom: calc(3.5rem + 1px);
        display: none;
        right: -410px;
        width: 410px;
        transition: right .3s ease-in-out, display .3s ease-in-out;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 5px;
        background-color: #fff;
        gap: 16px;
        height: 90px;
        border-radius: 8px 8px 0 0;
    }

    .cart-item img {
        width: 60px;
        /* Establece un ancho fijo para la imagen */
        height: 60px;
        /* Establece una altura fija para la imagen */
        object-fit: cover;
        /* Controla cómo se ajusta la imagen dentro de su contenedor */
        border-radius: 17px;
        /* Aplica el mismo redondeo a la imagen que al contenedor */
    }

    .cart-item-info {
        display: flex;
        align-items: center;
        flex-grow: 1;
        justify-content: space-between;
    }

    .cart-item-title {
        font-size: 16px;
        text-align: center;
        overflow: hidden;
        width: 250px;
    }

    .cart-item-quantity {
        display: flex;
        align-items: center;

    }

    .quantity-input {
        width: 40px;
        text-align: center;
        font-size: 16px;
        height: 34px;
        border: none;

    }

    .quantity-button {
        padding: 5px 10px;
        background-color: rgb(229 231 235);
        color: black;
        font-size: 20px;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .cart-item-details {
        display: flex;
        flex-direction: column;
        background-color: rgb(229 231 235);
        height: 42px;
        border-radius: 0 0 8px 8px;
        /* align-items: center; */
    }

    .price-and-remove {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-item-price {
        font-size: 19px;
        margin-top: 9px;
        margin-left: 20px;
    }

    .remove-button {
        background-color: rgb(229 231 235);
        color: red;
        border: none;
        cursor: pointer;
        font-size: 19px;
        margin-right: 16px;
    }
</style>
<style>
    @import url("https://fonts.googleapis.com/css?family=Lora:400,400i,700");


    #miP {
        margin: 0em 5em 4em 5em;
    }

    #miH1,
    #miP {
        text-align: center;
        line-height: 1.8;
        font-family: 'Lora', serif;
        color: white;
        /* Agrega este estilo para asegurar que el texto sea blanco */
    }

    .glowIn {
        animation: glow-in 1.5s infinite;
        /* Cambia 0.8s por 1.5s para que la animación sea más visible y establece que se repita infinitamente */

    }

    @keyframes glow-in {
        0% {
            opacity: 0.1;
            text-shadow: none;
        }

        45% {
            opacity: 1;
            text-shadow: 0 0 0.5px white;
            /* Cambia el valor de 25px a 15px */
        }

        55% {
            opacity: 1;
            text-shadow: 0 0 0.5px white;
            /* Cambia el valor de 25px a 15px */
        }

        55% {
            opacity: 0.7;
            text-shadow: 0 0 0.5px white;
            /* Cambia el valor de 25px a 15px */
        }

        75% {
            opacity: 0.3;
            text-shadow: 0 0 0.5px white;
            /* Cambia el valor de 25px a 15px */
        }

        85% {
            opacity: 0.2;
            text-shadow: 0 0 0.5px white;
            /* Cambia el valor de 25px a 15px */
        }

        100% {
            opacity: 0.1;
            text-shadow: none;
        }
    }
    .scroll-container {
        height: 100vh;
        overflow-y: scroll;
        scrollbar-width: none; /* Oculta la barra de desplazamiento de Firefox */
        -ms-overflow-style: none; /* Oculta la barra de desplazamiento de Internet Explorer */
    }

    .scroll-container::-webkit-scrollbar {
        width: 0; /* Oculta la barra de desplazamiento de WebKit (Safari y Chrome) */
    }

</style>

<body>
    <div>
        <div>
            <div style="background-color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 180px; margin-top: 5px;">
                <a href="{{ route('categoriasProducto.indexlistado') }}"><i class="fa-solid fa-cart-shopping fa-beat-fade fa-xl" style="color: #000000;"></i></a>
            </div>
            <h3 style="text-align: center; margin-top: -37px;">
                <br>Mi carrito
            </h3>
            <div style="height: 80vh; overflow-y: auto;" class="scroll-container">
                @if (count($detalles) > 0)
                @foreach ($detalles as $detalle)
                <div style="padding: 13px;">
                    <div class="cart-container">
                        <div class="cart-item">
                            <img src="{{ $detalle->producto->imagen }}" alt="Producto">
                            <h3 class="cart-item-title" style="text-align: center; color: black;">
                                {{ $detalle->producto->nombre }}
                            </h3>
                            <div class="cart-item-quantity">
                                <button class="quantity-button decrement" style="border-radius: 8px 0 0 8px;"><b>-</b></button>
                                <input class="quantity-input" type="number" value="{{ $detalle->cantidad+1 }}" min="0" readonly>
                                <button class="quantity-button increment" style="border-radius: 0 8px 8px 0;"><b>+</b></button>
                                <input type="hidden" class="detalle-pedido-id" value="{{ $detalle->id }}">
                                <input type="hidden" class="stock" value="{{ $detalle->producto->stock }}">
                            </div>
                        </div>
                        <p id="max-stock-msg-{{ $detalle->id }}" class="max-stock-msg" style="background-color: #fff; color: #000000; margin: 0; padding: 0; display: none;">Máximo Stock Disponible</p>
                        <div class="cart-item-details">
                            <div class="price-and-remove">
                                <h2 class="cart-item-price" style="color: black;">
                                    <b>BOB {{ $detalle->precio_unitario }}</b>
                                </h2>
                                <form method="POST" action="{{ route('carrito.eliminar', $detalle) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="remove-button" type="submit"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div style="text-align: center;">
                    <a href="{{ route('realizarPago') }}" style="text-decoration: none;" id="realizar-compra-btn">
                        <button style="background-color: #007BFF; color: #fff; width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 16px;">
                            <i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i> Realizar Pago
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div style="text-align: center;">
            <h4 class="glowIn" id="miH1">Su carrito está vacío.</h4>
            <a href="{{ route('categoriasProducto.indexlistado') }}">
                <p class="glowIn" id="miP">¡Agrega productos para continuar comprando!</p>
            </a>
        </div>
        @endif
    </div>
</body>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const incrementButtons = document.querySelectorAll(".increment");
    const decrementButtons = document.querySelectorAll(".decrement");

    incrementButtons.forEach(function(incrementButton, index) {
        const input = document.querySelectorAll(".quantity-input")[index];
        const detalleId = document.querySelectorAll(".detalle-pedido-id")[index];
        const precioUnitario = document.querySelectorAll(".cart-item-price b")[index];
        const stock = parseInt(document.querySelectorAll(".stock")[index].value); // Obtener el stock del producto
        const maxStockMsg = document.querySelector(`#max-stock-msg-${detalleId.value}`); // Obtener el mensaje específico por ID del producto

        incrementButton.addEventListener("click", function() {
            if (parseInt(input.value) < stock) { // Verificar si la cantidad no excede el stock
                input.value = parseInt(input.value) + 1;
                actualizarCantidad(detalleId.value, input.value, precioUnitario);
            } else {
                input.value = stock; // Establecer la cantidad al máximo de stock
                maxStockMsg.style.display = "block"; // Mostrar el mensaje específico
            }
        });
    });

    decrementButtons.forEach(function(decrementButton, index) {
        const input = document.querySelectorAll(".quantity-input")[index];
        const detalleId = document.querySelectorAll(".detalle-pedido-id")[index];
        const precioUnitario = document.querySelectorAll(".cart-item-price b")[index];
        const maxStockMsg = document.querySelector(`#max-stock-msg-${detalleId.value}`); // Obtener el mensaje específico por ID del producto

        decrementButton.addEventListener("click", function() {
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                actualizarCantidad(detalleId.value, input.value, precioUnitario);
            }
            // Ocultar el mensaje específico cuando se disminuye la cantidad
            maxStockMsg.style.display = "none";
        });
    });

    function actualizarCantidad(detalleId, nuevaCantidad, precioUnitarioElement) {
        fetch(`/carrito/actualizar-cantidad/${detalleId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nueva_cantidad: nuevaCantidad
            })
        })
        .then(response => response.json())
        .then(data => {
            precioUnitarioElement.textContent = `BOB ${data.precio_unitario}`;
        });
    }
});
</script>


@stop

@section('css')

@stop

@section('js')

@stop
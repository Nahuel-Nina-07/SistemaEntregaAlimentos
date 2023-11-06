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


<body>
    <div>
        <div style="background-color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: 180px; margin-top: 20px;">
            <i class="fa-solid fa-cart-shopping fa-beat-fade fa-xl" style="color: #000000;"></i>
        </div>
        <h3 style="text-align: center; margin-top: -25px;">
            <br>Mi carrito
        </h3>
        
        <div style="padding: 13px;">
            <div class="cart-container">
                <div class="cart-item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlg62E_eqso7gx3THHYBkn-KBWqx978K7TuQ&usqp=CAU" alt="Producto">
                    <h3 class="cart-item-title" style="text-align: center; color: black;">
                        Nombre sadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaafffffffffffffffffffffffffffff
                    </h3>
                    <div class="cart-item-quantity">
                        <button class="quantity-button decrement" style="border-radius: 8px 0 0 8px;"><b>-</b></button>
                        <input class="quantity-input" type="number" value="1" min="1" readonly>
                        <button class="quantity-button increment" style="border-radius: 0 8px 8px 0;"><b>+</b></button>
                    </div>
                </div>
                <div class="cart-item-details">
                    <div class="price-and-remove">
                        <h2 class="cart-item-price" style="color: black;">
                            <b>BOB 20.00</b>
                        </h2>
                        <button class="remove-button"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div style="padding: 13px;">
            <div class="cart-container">
                <div class="cart-item">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlg62E_eqso7gx3THHYBkn-KBWqx978K7TuQ&usqp=CAU" alt="Producto">
                    <h3 class="cart-item-title" style="text-align: center; color: black;">
                        Nombre sadaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaafffffffffffffffffffffffffffff
                    </h3>
                    <div class="cart-item-quantity">
                        <button class="quantity-button decrement" style="border-radius: 8px 0 0 8px;"><b>-</b></button>
                        <input class="quantity-input" type="number" value="1" min="1" readonly>
                        <button class="quantity-button increment" style="border-radius: 0 8px 8px 0;"><b>+</b></button>
                    </div>
                </div>
                <div class="cart-item-details">
                    <div class="price-and-remove">
                        <h2 class="cart-item-price" style="color: black;">
                            <b>BOB 20.00</b>
                        </h2>
                        <button class="remove-button"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center;">
        <button style="background-color: #007BFF; color: #fff; width: 100%; padding: 10px; border: none; border-radius: 8px; font-size: 16px;">
        <i class="fa-solid fa-money-check-dollar" style="color: #ffffff;"></i> Realizar Pago
        </button>
    </div>

    
</body>
<script src="https://kit.fontawesome.com/0b506ee94b.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const incrementButtons = document.querySelectorAll(".increment");
        const decrementButtons = document.querySelectorAll(".decrement");

        incrementButtons.forEach(function(incrementButton, index) {
            const input = document.querySelectorAll(".quantity-input")[index];
            
            incrementButton.addEventListener("click", function() {
                input.value = parseInt(input.value) + 1;
            });
        });

        decrementButtons.forEach(function(decrementButton, index) {
            const input = document.querySelectorAll(".quantity-input")[index];

            decrementButton.addEventListener("click", function() {
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    });
</script>
@stop

@section('css')

@stop

@section('js')

@stop
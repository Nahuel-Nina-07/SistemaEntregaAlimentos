@extends('adminlte::page')


@section('content')
@if(!Request::is('realizarPago'))
@php
config(['adminlte.right_sidebar' => false]);
@endphp
@endif
<div class="container">
    <br>
    <div class="row flex-row align-items-start"> <!-- Agregamos flex-row y align-items-start -->
        <div class="col-md-6 order-md-1" style="margin-left: -30px;">
            <table class="table ml-3 text-left">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                    <tr>
                        <td class="product-cell">{{ $detalle->producto->nombre }}</td>
                        <td class="product-cell">{{ $detalle->cantidad }}</td>
                        <td class="product-cell">BOB {{ number_format($detalle->precio_unitario, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td><b>Descuento:</b></td>
                        <td>({{ $descuento > 0 ? '3.00%' : '0.00%' }})</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Total:</b></td>
                        <td id="total" class="product-cell">BOB {{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('marcar.pendiente') }}">
                @csrf
                <h3 class="title">Información de Pago</h3>
                <div class="row">
                    <div class="col">
                        <div class="inputBox">
                            <span>Nombre completo:</span>
                            <input type="text" placeholder="John Deo" required>
                        </div>
                        <div class="inputBox">
                            <span>Correo electrónico :</span>
                            <input type="email" placeholder="example@example.com" required>
                        </div>
                        <div class="inputBox">
                            <span>Dirección:</span>
                            <input type="text" placeholder="Calle - Calle - Localidad" required>
                        </div>
                        <div class="inputBox">
                            <span>Pais:</span>
                            <input type="text" placeholder="Bolivia" required>
                        </div>
                        <div class="flex">
                            <div class="inputBox">
                                <span>Ciudad:</span>
                                <input type="text" placeholder="Oruro" required>
                            </div>
                            <div class="inputBox">
                                <span>Código Postal:</span>
                                <input type="number" placeholder="123 456" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inputBox">
                            <span>Tarjetas aceptadas:</span>
                            <img src="{{ asset('images/card_img.png') }}" alt="">
                        </div>
                        <div class="inputBox">
                            <span>Número de tarjeta de crédito:</span>
                            <input type="number" placeholder="1111-2222-3333-4444" required>
                        </div>
                        <div class="flex">
                            <div class="inputBox">
                                <span>Vencimiento:</span>
                                <div class="flex">
                                    <div class="exp-month">
                                        <select name="exp-month" style="height: 180%;" required>
                                            <option value="">--</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="exp-year">
                                        <select name="exp-year" style="height: 180%;" required>
                                            <option value="">--</option>
                                            <option value="23">2023</option>
                                            <option value="24">2024</option>
                                            <option value="25">2025</option>
                                            <option value="26">2026</option>
                                            <option value="27">2027</option>
                                            <option value="28">2028</option>
                                            <option value="29">2029</option>
                                            <option value="30">2030</option>
                                            <option value="31">2031</option>
                                            <option value="32">2032</option>
                                            <option value="33">2033</option>
                                            <option value="34">2034</option>
                                            <option value="35">2035</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="inputBox">
                                <span>CVV:</span>
                                <input type="number" placeholder="123" style="width: 80px;" required>
                                <a href="https://www.santander.com/es/stories/cvv-tarjeta-bancaria" style="margin-left: 5px;">?</a>
                            </div>
                        </div>
                    </div>
                </div>
                <form>
                    <button type="submit" class="submit-btn">Pagar BOB {{ number_format($total, 2) }}</button>
                </form>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-transform: capitalize;
        transition: all .2s linear;
    }

    .product-cell {
        max-width: 90px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .container form .row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .container form .row .col {
        flex: 1 1 250px;
    }

    .container form .row .col .inputBox {
        margin: 15px 0;
    }

    .container form .row .col .inputBox span {
        margin-bottom: 10px;
        display: block;
    }

    .container form .row .col .inputBox input {
        width: 100%;
        border: 1px solid #ccc;
        padding: 10px 15px;
        font-size: 15px;
        text-transform: none;
    }

    .container form .row .col .inputBox input:focus {
        border: 1px solid #000;
    }

    .container form .row .col .flex {
        display: flex;
        gap: 15px;
    }

    .container form .row .col .flex .inputBox {
        margin-top: 5px;
    }

    .container form .row .col .inputBox img {
        height: 34px;
        margin-top: 5px;
        filter: drop-shadow(0 0 1px #000);
    }

    .container form .submit-btn {
        width: 100%;
        padding: 12px;
        font-size: 17px;
        background: #27ae60;
        color: #fff;
        margin-top: 5px;
        cursor: pointer;
    }

    .container form .submit-btn:hover {
        background: #2ecc71;
    }
</style>
@stop

@section('js')
<script>
    const expMonthSelect = document.getElementById("exp-month-select");
    const expMonthValidation = document.getElementById("exp-month-validation");
    expMonthSelect.addEventListener("change", function() {
        if (expMonthSelect.value === "") {
            expMonthValidation.style.display = "block";
        } else {
            expMonthValidation.style.display = "none";
        }
    });
</script>


@stop
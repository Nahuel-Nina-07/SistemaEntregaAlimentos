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
                    @if ($descuento > 0)
                    <tr>
                        <td></td>
                        <td><b>Descuento:</b></td>
                        <td>(3.00%)</td>
                    </tr>
                    @endif
                    <tr>
                        <td></td>
                        <td><b>Total:</b></td>
                        <td id="total" class="product-cell">BOB {{ number_format($total, 2) }}</td>
                    </tr>
                    @if (isset($totalEnDolares))
                    <tr>
                        <td></td>
                        <td><b>Total (USD):</b></td>
                        <td class="product-cell">${{ number_format($totalEnDolares, 2) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <form id="paymentForm" method="POST" action="{{ route('marcar.pendiente') }}">
                @csrf
                <h3 class="title">Información de Pago</h3>
                <div id="sectionCard" class="hidden p-4 bg-gray-100"></div>
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

<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}&components=buttons,funding-eligibility&locale=es_BO"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Script de PayPal
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                },
                payer: {
                    email_address: '{{ auth()->user()->email }}',
                    name: {
                        given_name: '{{ auth()->user()->name }}',
                        surname: '{{ auth()->user()->apellido }}'
                    },
                },
                purchase_units: [{
                    amount: {
                        value: '{{ number_format($totalEnDolares, 2) }}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert(details.payer.name.given_name + ', gracias por tu compra!');

                marcarPedidoComoPendiente();

                window.history.replaceState({}, document.title, "{{ route('categoriasProducto.indexlistado') }}");
                window.location.href = "{{ route('categoriasProducto.indexlistado') }}";
            });
        },
        onError: function(err) {
            console.log(err);
        }
    }).render('#sectionCard');

    function marcarPedidoComoPendiente() {
        // Hacer una llamada AJAX para notificar al servidor y marcar el pedido como pendiente
        $.ajax({
            url: "{{ route('marcar.pendiente') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }
</script>



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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@stop
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Repartidor/form.css') }}">
</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="demo-page">
        <!-- <div class="demo-page-navigation"></div> -->

        <main class="demo-page-content">
            <section>
                <!-- <div class="href-target" id="input-types"></div> -->
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify">
                        <line x1="21" y1="10" x2="3" y2="10" />
                        <line x1="21" y1="6" x2="3" y2="6" />
                        <line x1="21" y1="14" x2="3" y2="14" />
                        <line x1="21" y1="18" x2="3" y2="18" />
                    </svg>
                    Ingresa tus datos detallados
                </h1>
                <p>Por normas de seguridad necesitamos que lenes todos los campos.</p>
                <form method="POST" action="{{ url('/guardar-detallados') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- <div class="nice-form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre_solicitante" placeholder="Ingrese su nombre" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido_solicitante" placeholder="Ingrese su apellido" value="" required />
                    </div> -->

                    <div class="nice-form-group">
                        <label>Email</label>
                        <input type="email" name="correo_electronico_solicitante" placeholder="Ingrese su email" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label>Telefono</label>
                        <input type="tel" name="telefono_solicitante" placeholder="Ingrese su numero" value="" required />
                    </div>


                    <!-- <fieldset class="nice-form-group">
                        <label>¿Tienes más de 18 años?</label>
                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-1" value="1" />
                            <label for="r-1">Si</label>
                        </div>

                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-2" value="0" />
                            <label for="r-2">No</label>
                        </div>
                    </fieldset> -->

                    <fieldset class="nice-form-group">
                        <label>¿Tienes tu propio vehículo?</label>
                        <div class="nice-form-group">
                            <input type="radio" name="vehiculoPropio" id="r-3" value="1" />
                            <label for="r-3">Si</label>
                        </div>

                        <div class="nice-form-group">
                            <input type="radio" name="vehiculoPropio" id="r-4" value="0" />
                            <label for="r-4">No</label>
                        </div>
                    </fieldset>

                    <div class="nice-form-group">
                        <select name="tipo_vehiculo" required>
                            <option>Elige tu transporte</option>
                            <option>Moto</option>
                            <option>Auto</option>
                        </select>
                    </div>

                    <div class="nice-form-group">
                        <label>Imagen documentos de tu vehiculo o contrato de prestamo vehicular</label>
                        <input type="file" name="imagen_propiedad_vehiculo" accept="image/*" required />
                    </div>

                    <!-- <div class="nice-form-group">
                        <label>Numero de cédula o pasaporte</label>
                        <input type="tel" placeholder="Ingrese su cédula/pasaporte(sin guion)" value="" name="ci_numero" required />
                    </div> -->


                    <details>
                        <summary>
                            <button type="submit">
                                <div class="toggle-code">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-code">
                                        <polyline points="16 18 22 12 16 6" />
                                        <polyline points="8 6 2 12 8 18" />
                                    </svg>
                                    Enviar
                                </div>
                            </button>
                        </summary>
                    </details>
                    <br>
                    <br>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </section>

        </main>

    </div>
</body>

</html>
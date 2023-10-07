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
                    Ingresa tus datos
                </h1>
                <p>Por normas de seguridad necesitamos que lenes todos los campos.</p>
                <form method="POST" action="{{ route('repartidor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="nice-form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre_solicitante" placeholder="Ingrese su nombre" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido_solicitante" placeholder="Ingrese su apellido" value="" required />
                    </div>

                    <div class="nice-form-group">
                        <label>Email</label>
                        <input type="email" name="correo_electronico_solicitante" placeholder="Ingrese su email" value="" required />
                    </div>

                    <fieldset class="nice-form-group">
                        <label>¿Tienes más de 18 años?</label>
                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-1" value="1" />
                            <label for="r-1">Si</label>
                        </div>

                        <div class="nice-form-group">
                            <input type="radio" name="edad" id="r-2" value="0" />
                            <label for="r-2">No</label>
                        </div>
                    </fieldset>
                    <br>
                    <div id="mensaje-requisito" style="display: none;">
                        Como requisito, necesitamos que seas mayor de 18 años.
                    </div>

                    <script>
                        function mostrarMensajeRequisito() {
                            var edadNo = document.getElementById("r-2").checked;

                            if (edadNo) {
                                document.getElementById("mensaje-requisito").style.display = "block";
                            }
                        }
                    </script>


                    <details>
                        <summary>
                            <button type="submit" onclick="mostrarMensajeRequisito()">
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

                </form>
            </section>

        </main>

    </div>
</body>

</html>
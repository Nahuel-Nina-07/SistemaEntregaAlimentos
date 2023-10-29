<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 2rem;
            text-align: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body h1 {
            font-weight: 600;
        }

        body hr {
            width: 50px;
            border: none;
            border-bottom: 1px solid rgba(119, 119, 119, 0.25)
        }

        .container {
            width: 60%;
            margin: 1rem auto;
            padding: 2rem;
            text-align: justify;
            transition: all 0.3s;
        }

        .container p {
            line-height: 1.5;
            letter-spacing: 0.3px;
            word-spacing: 2px;
        }

        .container p:first-child::first-letter {
            color: #FE5F55;
            font-weight: bold;
            font-size: 70px;
            float: left;
            line-height: 60px;
            padding-right: 8px;
            margin-top: -3px;
        }

        @media screen and (max-width:600px) {
            .container {
                width: 100%;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Drop Caps</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <h1>Solicitud Rechazada</h1>
        <hr>
        <div class="container">
            <p>
                Espero que te encuentres bien. Quiero agradecerte sinceramente por tu interés en unirse a <a href="#"><b>GoVin</b></a> y por tomarte el tiempo para enviar tu solicitud. 
                Valoramos y apreciamos el esfuerzo que pusiste en tu solicitud.
                Lamentablemente, después de un proceso de revisión minucioso y consideración cuidadosa, hemos tomado la decisión de no avanzar con tu solicitud en esta ocasión.
            </p>
            <hr>
            <p>
                Agradecemos nuevamente tu interés en <b>GoVin</b> y te deseamos mucho éxito en tus futuras búsquedas laborales.
                Si tienes alguna pregunta o necesitas comentarios adicionales sobre tu solicitud, no dudes en contactarnos. Estamos aquí para ayudarte.
                Gracias nuevamente y te enviamos nuestros mejores deseos.
            </p>
        </div>
    </body>

    </html>
</body>

</html>
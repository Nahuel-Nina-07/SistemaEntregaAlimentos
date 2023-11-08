<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #map {
            height: 90vh;
            width: 100vw;
        }
    </style>
</head>

<body>
<div id="coordinates">Coordenadas: </div>
    <h1>Visita los sitios turisticos de Colombia</h1>
    <select name="select-location" id="select-location">
        <option value="-1">Seleccione un lugar:</option>
        <option value="6.636254,-73.223129">Barichara-Santander</option>
        <option value="12.19602,-72.147218">Cabo de la Vela-La Guajira</option>
        <option value="10.42278,-75.539217">
            Castillo San Felipe Cartagena-Bolivar
        </option>
        <option value="2.265124,-73.794523">Caño Cristales-Meta</option>
        <option value="3.233851,-75.168934">Desierto de Tatacoa-Huila</option>
        <option value="6.233825,-75.167062">Guatape-Antioquia</option>
        <option value="4.945885,-73.825740">Guatavita-Cundinamarca</option>
        <option value="2.135151,-76.410226">Parque Purace-Cauca</option>
        <option value="1.888593,-76.295127">San Agustín-Huila</option>
        <option value=" -17.39483754707626, -66.28108620643604">Plaza Bolivar</option>
    </select>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([4.5993, -74.0805], 18);

        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        var coordinatesDiv = document.getElementById("coordinates");

        document
            .getElementById("select-location")
            .addEventListener("change", function(e) {
                let selectedOption = e.target.options[e.target.selectedIndex];
                if (selectedOption.value !== "-1") {
                    let coords = selectedOption.value.split(",");
                    map.flyTo(coords, 18);
                    coordinatesDiv.textContent = "Coordenadas: " + coords.join(", ");
                } else {
                    coordinatesDiv.textContent = "Coordenadas: ";
                }
            });

        // Agregar un evento de clic al mapa para mostrar las coordenadas en el div.
        map.on('click', function(e) {
            coordinatesDiv.textContent = "Coordenadas: " + e.latlng.lat + ", " + e.latlng.lng;
        });
    </script>
</body>

</html>



// Fonction d'initialisation de la carte google Maps
var map;

function initMap() {
    var Paris = {lat: 48.852969, lng: 2.349903};

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: Paris,
    });

    // Mise en place de l'input de recherche
    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));


    // Récupère et affiche les informations de l'input
    searchBox.addListener('places_changed', function () {
        //Renvoie le lieu choisi par l'utilisateur
        var places = searchBox.getPlaces();

        // Recupere les données géographiques
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function (place) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            bounds.extend(place.geometry.location);
            showImage(lat, lng);
            ;
        });

        // Affiche les données dans la carte précedemment déclaré (var map)
        map.fitBounds(bounds);
        map.setZoom(13);

    });

    // Create a <script> tag and set the USGS URL as the source.
    var script = document.createElement('script');
    // This example uses a local copy of the GeoJSON stored at

    JSON.stringify()

    script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
    document.getElementsByTagName('head')[0].appendChild(script);


    // Loop through the results array and place a marker for each
    // set of coordinates.
    window.eqfeed_callback = function (results) {
        for (var i = 0; i < results.features.length; i++) {
            var coords = results.features[i].geometry.coordinates;
            var latLng = new google.maps.LatLng(coords[1], coords[0]);
            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
        }
    }

}

function showImage(lat, lng) {
    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            document.getElementById("txtHint").innerHTML = this.responseText;

        }
    }

    xhttp.open("GET", "searchImage.php?lat=" + lat + "&lng=" + lng, true);
    xhttp.send();
}


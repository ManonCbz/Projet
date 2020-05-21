// Fonction d'initialisation de la carte google Maps

function initMap() {
    //Coordonneés de Paris
    var Paris = {lat: 48.852969, lng: 2.349903};

    // Ajout de la carte dans la div appropriée
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: Paris
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
        });

        // Affiche les données dans la carte précedemment déclaré (var map)
        map.fitBounds(bounds);
        map.setZoom(13);
    });

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
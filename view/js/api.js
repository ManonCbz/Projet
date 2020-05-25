var map;

// Fonction d'initialisation de la carte google Maps
function initMap() {
    var Paris = {lat: 48.852969, lng: 2.349903};

    // Ajout de la carte sur l'écran
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: Paris,
    });

    // Mise en place de l'input de recherche
    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));

    showJSON();

    // Récupère et affiche les informations de l'input
    searchBox.addListener('places_changed', function () {
        //Renvoie le lieu choisi par l'utilisateur
        var places = searchBox.getPlaces();

        // Recupere les données géographiques
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function (place) {
            bounds.extend(place.geometry.location);
        });

        // Affiche les données dans la carte
        map.fitBounds(bounds);
        map.setZoom(13);

    });

}

//Fonction affichage des images ensemble

function showJSON() {
    var xhttp;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {

            // Recupere le fichier json
            var tableauJSON = JSON.parse(this.responseText);

            // Crée une fenetre d'informations
            info = new google.maps.InfoWindow();

            for (var i = 0; i < tableauJSON.infos.length; i++) {

                lat = tableauJSON.infos[i].latitude;
                lng = tableauJSON.infos[i].longitude;

                // Ajoute un marqueur google

                var marker = new google.maps.Marker({
                    numero : i,
                    position: new google.maps.LatLng(lat,lng),
                    map: map
                });

                // Ajoute l'evenement pour l'affichage des informations au clic sur le marker

                google.maps.event.addListener( marker, 'click', function() {
                    // affectation du contenu
                    info.setContent('<h3>'+ tableauJSON.infos[this.numero].name + '</h3>'
                        + '<a href="https://www.instagram.com/'+ tableauJSON.infos[this.numero].website +'/" target="_blank">Instagram</a>'
                        + '<br><img alt="photo" class=\'imgDiv\' src="../view/upload/'+ tableauJSON.infos[this.numero].imagename +'" />'
                        + '<br>Latitude : ' + tableauJSON.infos[this.numero].latitude + '<br>Longitude: ' + tableauJSON.infos[this.numero].longitude
                );
                    // affichage de l'InfoWindow
                    info.open( this.getMap(), this);
                });
            }

        }
    }

    xhttp.open("GET", "imageJSON.php", true);
    xhttp.send();

}
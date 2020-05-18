// Fonction d'initialisation de la carte google Maps

function initMap()
{
    //Coordonneés de Paris
    var Paris = {lat: 48.852969, lng: 2.349903};


    // Ajout de la carte dans la div appropriée

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: Paris
    });

    // Mise en place de l'input de recherche

    var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));


    // Récupère et affiche les informations de l'input

    searchBox.addListener('places_changed', function ()
    {
        //Renvoie le lieu choisi par l'utilisateur
        var places = searchBox.getPlaces();

        // Recupere les données géographiques
        var bounds = new google.maps.LatLngBounds();

        places.forEach(function (place)
        {
            bounds.extend(place.geometry.location);
        });

        // Affiche les données dans la carte précedemment déclaré (JS:11)
        map.fitBounds(bounds);
        map.setZoom(12);
    });
}
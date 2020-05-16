// Fonction d'initialisation de la carte
function initMap() {
    var myLatLng = {lat: 48.852969, lng: 2.349903};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });

}

var beachMarker = new google.maps.Marker({
    position: {lat: -33.890, lng: 151.274},
    map: map,
});

window.onload = function(){
    // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
    initMap();
};
<?php $apiKey = "" ?>

<body id="bodyMap">

<div id="viewportMap">
    <form method="post" id="searchMap">
        <div class="searchBar">
            <img alt="search" src="../view/pictures/search.png">
            <input id="pac-input" class="controls" type="text" placeholder="Paris">
        </div>
    </form>
    <div id="map">

    </div>
</div>
<div id="txtHint"></div>
<script src="../view/js/api.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=$apiKey?>&libraries=places&callback=initMap"
        async defer></script>
</body>
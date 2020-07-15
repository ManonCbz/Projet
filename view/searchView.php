<body id="bodyMap">

<div id="viewportMap">
    <form method="post" id="searchMap">
        <div class="searchBar">
            <img alt="search" src="../view/pictures/search.png">
            <input id="pac-input" class="controls" type="text" placeholder="Paris">
        </div>
        <p class="titleCat">Catégories :</p>

        <div class="categories">
            <h4>Paysage :</h4>
            <input type="checkbox" id="ville" name="placeCity" value="ville">
            <label for="ville">Ville</label>

            <input type="checkbox" id="campagne" name="placeCountryside" value="campagne">
            <label for="campagne">Campagne</label>

            <input type="checkbox" id="mer" name="placeSea" value="mer">
            <label for="mer">Mer</label>

            <input type="checkbox" id="montagne" name="placeMountain" value="montagne">
            <label for="montagne">Montagne</label>
        </div>

        <div class="categories">
            <h4>Journée :</h4>
            <input type="radio" id="aurore" name="day" value="dawn">
            <label for="aurore">Aurore</label>

            <input type="radio" id="journée" name="day" value="day">
            <label for="journée">Journée</label>

            <input type="radio" id="Crepuscule" name="day" value="dusk">
            <label for="Crepuscule">Crepuscule</label>

            <input type="radio" id="nuit" name="day" value="night">
            <label for="nuit">Nuit</label>
        </div>
        <button type="submit" id="searchButton">Envoyer</button>
    </form>
    <div id="map">

    </div>
</div>
<div id="txtHint">
    <?php
    if (isset($_POST['day'])) {
        displayImageSearchCat($_POST['day']);
    }
    ?>
</div>
<?= $apiKey = "" ?>
<script src="../view/js/api.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKey ?>&libraries=places&callback=initMap"
        async defer></script>
</body>
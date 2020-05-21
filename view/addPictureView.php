<body id="addPictureBody">
<h1>Ajouter une photo</h1>

<div id="addPictureViewport">

    <form name="addPicture" method="post" action="../controller/addPicture.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <input type="file" name="image">
        <div id="latLng">
            <label for="latInput">Latitude</label>
            <input id="latInput" name="latitude" type="number" step="any" placeholder="48.852969">
            <label for="lngInput">Longitude</label>
            <input id="lngInput" name="longitude" type="number" step="any" placeholder="2.349903">
        </div>
        <p class="titleCat">Catégories :</p>

        <div class="categories">
            <h4>Paysage :</h4>
            <input type="checkbox" id="ville" name="placeCity" value="ville" checked>
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
            <input type="radio" id="aurore" name="day" value="aurore" checked>
            <label for="aurore">Aurore</label>

            <input type="radio" id="journée" name="day" value="journée">
            <label for="journée">Journée</label>

            <input type="radio" id="Crepuscule" name="day" value="Crepuscule">
            <label for="Crepuscule">Crepuscule</label>

            <input type="radio" id="nuit" name="day" value="nuit">
            <label for="nuit">Nuit</label>
        </div>
        <button type="submit">Envoyer</button>
    </form>

</div>
</body>
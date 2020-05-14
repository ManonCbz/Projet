<body id="addPictureBody">
<h1>Ajouter une photo</h1>

<div id="addPictureViewport">

    <form name="addPicture" method="post" action="../controller/addPicture.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <input type="file" name="image">
        <div id="latLng">
            <label for="latInput">Lattitude</label>
            <input id="latInput" type="number" placeholder="48.852969">
            <label for="lngInput">Longitude</label>
            <input id="lngInput" type="number" placeholder="2.349903">
        </div>
        <p class="titleCat">Catégories :</p>

        <div class="categories">
            <input type="checkbox" id="ville" name="drone" value="ville" checked>
            <label for="ville">Ville</label>

            <input type="checkbox" id="campagne" name="drone" value="campagne">
            <label for="campagne">Campagne</label>

            <input type="checkbox" id="mer" name="drone" value="mer">
            <label for="mer">Mer</label>
        </div>
        <button type="submit">Envoyer</button>
    </form>

</div>
</body>
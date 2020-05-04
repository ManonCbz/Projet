<body id="addPictureBody">
<h1>Ajouter une photo</h1>

<div id="addPictureViewport">

    <div id="statueAddPicture"> <?= $statueAddPicture ?></div>

    <form name="addPicture" method="post" action="../controller/addPicture.php" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <input type="file" name="image">
        <button type="submit">Envoyer</button>
    </form>

</div>
</body>
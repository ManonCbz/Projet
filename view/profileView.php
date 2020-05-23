<body id="bodyProfile">
<div id="profileViewport">
    <div class="profilePresentation">

        <h1> <?= $_SESSION['username'] ?> </h1>
        <p><?= $informationsUser["presentationText"] ?></p>
        <a href="https://www.instagram.com/<?= $informationsUser["websiteValue"] ?>/ ">Instagram</a>

    </div>

    <div class="profilePictures">
        <?= displayPicture($_SESSION['userID']); ?>
    </div>

</div>
</body>
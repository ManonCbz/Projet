<body id="bodyProfile">
<div id="profileViewport">
    <div class="profilePresentation">

        <h1> <?= $_SESSION['username'] ?> </h1>
        <p><?= $informationsUser["presentationText"] ?></p>
        <a href=" <?= $informationsUser["websiteValue"] ?> ">Mon site web</a>

    </div>

    <div class="profilePictures">

    </div>

</div>
</body>
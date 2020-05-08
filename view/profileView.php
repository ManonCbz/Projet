<body id="bodyProfile">
<div id="profileViewport">
    <div class="profilePresentation">

        <h1> <?= $_SESSION['username'] ?> </h1>
        <p><?= $informationsUser["presentationText"] ?></p>
        <a href=" <?= $informationsUser["websiteValue"] ?> ">Mon site web</a>

    </div>

    <div class="profilePictures">
        <?= // $images = displayPicture($_SESSION['userID']);
            displayPicture($_SESSION['userID']);
         ?>
    </div>

    <!-- echo "<img class='imgDiv' src='../view/upload/".$row['img_name']."'>"; -->

</div>
</body>
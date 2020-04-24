<?php
require 'require/header.php';
require 'database.php';

$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

?>

<body style="overflow: hidden">
<div class="viewportLogParent">

    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">

        <form action="" method="POST">

            <div class="logForm">
                <input type="text" name="username" placeholder="<?= $usernamePlaceholder ?>">
            </div>

            <div class="logForm">
                <input type="password" name="password" placeholder="<?= $passwordPlaceholder ?>"/>
            </div>

            <button type="submit" class="buttonLog">Se connecter</button>
        </form>
        <div id="changeButton">
            <span>Pas encore inscrit ? </span><a HREF="register.php"><button>S'inscrire</button></a>
        </div>
    </div>
</div>
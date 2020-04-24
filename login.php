<?php
require 'header.php';
require 'database.php';
?>

<html lang="fr">
<body style="overflow: hidden">
<div class="viewportLogParent">

    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">

        <form action="" method="POST">

            <div class="form-group">
                <input type="text" name="email" placeholder="Adresse email">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mot de passe"/>
            </div>

            <button type="submit" class="buttonLog">Se connecter</button>
        </form>
        <div id="changeButton">
            <span>Pas encore inscrit ? </span><a HREF="register.php"><button>S'inscrire</button></a>
        </div>
    </div>
</div>
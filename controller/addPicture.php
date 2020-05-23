<?php
require 'header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    ?>
    <script> document.location.replace("profile.php"); </script>
    <?php
}
if (!empty($_SESSION['admin'])){
    ?>
    <script> document.location.replace("admin.php"); </script>
    <?php
}


// =========================================== Verification Formulaire =========================================== //

// Pour chaque erreur :
// 1 - J'ajoute +1 à ma variable $errors
// 2 - Je modifie le CSS

if (!empty($_POST)) {

    $errors = 0;

    // Si aucune image n'est envoyé

    if($_FILES['image']['size'] === 0){
        $errors++;
        ?>
        <style>
            input[type=file]{
                border: thin solid red;
            }
        </style>
        <?php
    }

    // Si les valeurs longitude & latitude sont vide

    if(empty($_POST['longitude']) || empty($_POST['latitude'])){
        $errors++;
        ?>
        <style>
            #latInput, #lngInput{
                border: thin solid red;
            }
        </style>
        <?php
    }

    if(empty($_POST['day'])){
        $errors++;
        ?>
        <style>
            .day label{
                color: red;
            }
        </style>
        <?php
    }

    if ($errors === 0) {

        $city = 0;
        $countryside = 0;
        $sea = 0;
        $mountain = 0;

        if(isset($_POST['placeCity'])){
            $city = 1;
        }
        if(isset($_POST['placeCountryside'])){
            $countryside = 1;
        }
        if(isset($_POST['placeSea'])){
            $sea = 1;
        }
        if(isset($_POST['placeMountain'])){
            $mountain = 1;
        }


        addPicture($_SESSION['userID'], $_POST['latitude'], $_POST['longitude'], $city, $countryside, $sea, $mountain, $_POST['day']);

        ?>
        <script> document.location.replace("profile.php"); </script>
        <?php
    }
}


require '../view/addPictureView.php';
require 'footer.php';
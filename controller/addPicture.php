<?php
require 'header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}
if (!empty($_SESSION['admin'])){
    header('Location: admin.php');
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
                border: 1px solid red;
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
                border: 1px solid red;
            }
        </style>
        <?php
    }

    if ($errors === 0) {

        $userID = $_SESSION['userID'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        addPicture($userID, $latitude, $longitude);

        header('Location: profile.php');
    }
}


require '../view/addPictureView.php';
require 'footer.php';

<?php
require '../controller/header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}

$newEmailPlaceholder1 = "Nouvelle adresse email";
$newEmailPlaceholder2 = "Confirmez votre adresse email";

if (!empty($_POST['presentationSetting'] || $_POST['websiteSetting'])){
    updateInformations($_POST['presentationSetting'], $_POST['websiteSetting'], $_SESSION['userID']);
}

if(!empty($_POST['newEmail']) && $_POST['newEmail'] == $_POST['newEmailConf']){
    updateEmail($_POST['newEmail'], $_SESSION['userID']);
}

if($_POST['newEmail'] !== $_POST['newEmailConf']){
    $newEmailPlaceholder1 = "L'adresse email ne correspond pas";
    $newEmailPlaceholder2 = "L'adresse email ne correspond pas";
    ?>
    <style>
        .newEmail::placeholder {
            color: red;
            font-style: italic
        }
    </style><?php
}

$informationsUser = getInformations($_SESSION['userID']);

$deletePlaceholder1 = "Mot de passe";
$deletePlaceholder2 = "Confirmez votre Mot de Passe";

if(!empty($_POST['password']) && $_POST['password'] == $_POST['confPassword']){

    $user = getLog($_SESSION['username']);

    if (password_verify($_POST['password'], $user['password'])) {

        $id = $_SESSION['userID'];

        deleteAccount($id);

        deleteInformations($id);

        deletePictures($id);

        session_destroy();

        header('Location: login.php');

    }
    else{
        $deletePlaceholder1 = "Mot de passe incorrect";
        $deletePlaceholder2 = "Mot de passe incorrect";
        ?>
        <style>
            .deleteInput::placeholder {
                color: red;
                font-style: italic
            }
        </style><?php
    }
}

if ($_POST['password'] !== $_POST['confPassword']){
        $deletePlaceholder1 = "Mot de passe different";
        $deletePlaceholder2 = "Mot de passe different";
        ?>
        <style>
            .deleteInput::placeholder {
                color: red;
                font-style: italic
            }
        </style><?php
}

require '../view/settingView.php';
require '../controller/footer.php';

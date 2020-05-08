<?php
require '../controller/header.php';

$newEmailPlaceholder = "Nouvelle adresse email";

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}

if (!empty($_POST['presentationSetting'] || $_POST['websiteSetting'])){
    updateInformations($_POST['presentationSetting'], $_POST['websiteSetting'], $_SESSION['userID']);
}

if(!empty($_POST['newEmail']) && $_POST['newEmail'] == $_POST['newEmailConf']){
    updateEmail($_POST['newEmail'], $_SESSION['userID']);
}

if($_POST['newEmail'] !== $_POST['newEmailConf']){
    $newEmailPlaceholder = "L'adresse email ne correspond pas";
    ?>
    <style>
        .newEmail::placeholder {
            color: red;
            font-style: italic
        }
    </style><?php
}

$informationsUser = getInformations($_SESSION['userID']);

require '../view/settingView.php';
require '../controller/footer.php';

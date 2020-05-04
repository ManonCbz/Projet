<?php
require '../controller/header.php';

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}

if (!empty($_POST)){
    updateInformations($_POST['presentationSetting'], $_POST['websiteSetting'], $_SESSION['userID']);
}

$informationsUser = getInformations($_SESSION['userID']);

require '../view/settingView.php';
require '../controller/footer.php';

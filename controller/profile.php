<?php
require '../controller/header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}
if (!empty($_SESSION['admin'])){
    header('Location: admin.php');
}


$informationsUser = getInformations($_SESSION['userID']);


require '../view/profileView.php';
require 'footer.php';


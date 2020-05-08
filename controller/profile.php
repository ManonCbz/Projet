<?php
require '../controller/header.php';

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}

$informationsUser = getInformations($_SESSION['userID']);


require '../view/profileView.php';
require 'footer.php';


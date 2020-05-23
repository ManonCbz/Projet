<?php

require 'header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    ?>
    <script language="Javascript">  document.location.replace("login.php"); </script>
    <?php
}
if (!empty($_SESSION['admin'])){
    ?>
    <script language="Javascript">  document.location.replace("admin.php"); </script>
    <?php
}

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

require '../view/searchView.php';
require 'footer.php';
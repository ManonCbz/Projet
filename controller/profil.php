<?php
require 'header.php';

if(empty($_SESSION['username'])){
    header('Location: login.php');
}

?>

<h1>Bonjour <?= $_SESSION['username'] ?> </h1>

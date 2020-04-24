<?php
require 'require/header.php';

session_start();

?>

<html lang="fr">

<h1>TEST <?= $_SESSION['auth'] ?> </h1>

</html>

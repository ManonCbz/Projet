<?php
require '../controller/header.php';

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


$informationsUser = getInformations($_SESSION['userID']);


require '../view/profileView.php';
require 'footer.php';


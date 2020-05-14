<?php

include '../model/database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<html lang="fr">
<head>
    <title>Spot Photo</title>
    <link rel="icon" href="../view/pictures/ico-camera.ico"/>
    <link href="../view/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina+2|Satisfy&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=MYAPIKEY&callback=initMap"
            type="text/javascript">
    </script>
</head>
<body>
<header>
    <?php

    if (isset($_SESSION['username'])) {
        ?>
        <div id="navbar">
            <img alt="logo" class="logo" src="../view/pictures/log-camera.png" height="40px" width="40px">
            <div class="linkNavbar">
                <a href="profile.php">Profil</a>
                <a href="search.php">Rechercher</a>
                <a href="addPicture.php">Ajouter une photo</a>
            </div>
            <div class="iconNavbar">
                <a href="setting.php"><img class="iconNavbar" title="Paramètres" alt="Paramètres"
                                           src="../view/pictures/icon-settings.png"></a>
                <a href="logout.php"><img class="iconNavbar" title="Se déconnecter" alt="Se déconnecter"
                                          src="../view/pictures/icon-logout.png"></a>
            </div>
        </div>
        <?php
    }

    ?>
</header>
</body>
</html>
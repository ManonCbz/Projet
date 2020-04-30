<?php

include '../model/database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<head>
    <title>Test</title>
    <link href="../vue/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina+2|Satisfy&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>

<?php

if (isset($_SESSION['username'])) {
    ?>
    <div id="navbar">
        <img alt="logo" class="logo" src="../vue/pictures/log-camera.png" height="40px" width="40px">
        <div class="linkNavbar">
            <a href="profile.php">Profil</a>
            <a href="">Rechercher</a>
            <a href="">Ajouter une photo</a>
        </div>
        <div class="iconNavbar">
            <a href="setting.php"><img class="iconNavbar" title="Paramètres" alt="Paramètres"
                                       src="../vue/pictures/icon-settings.png"></a>
            <a href="logout.php"><img class="iconNavbar" title="Se déconnecter" alt="Se déconnecter"
                                      src="../vue/pictures/icon-logout.png"></a>
        </div>
    </div>
    <?php
}

?>
</body>

<?php

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

    if (isset($_SESSION['username'])){
        ?>
        <div id="navbar">
            <img src="../vue/pictures/camera.png" height="40px" width="40px">
            <div>
                <a href="">Profil</a>
                <a href="">Rechercher</a>
                <a href="">Ajouter</a>
                <a href="logout.php">Se déconnecter</a>
            </div>
        </div>
        <?php
    }

?>
</body>

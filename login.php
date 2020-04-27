<?php
require 'header.php';
require 'database.php';

$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $username = $_POST['username'];
        $_SESSION['username'] = $username;
        echo $_SESSION['username'];
        header('Location: profil.php');
    }

    else {
        ?>
            <style>
                .error {
                    display: block;
                }
            </style>
        <?php
    }
}

?>

<body style="overflow: hidden">
<div class="viewportLogParent">

    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">

        <div class="error"> ● Identifiant ou mot de passe incorrect </div>

        <form action="" method="POST">

            <div class="logForm">
                <input type="text" name="username" placeholder="<?= $usernamePlaceholder ?>">
            </div>

            <div class="logForm">
                <input type="password" name="password" placeholder="<?= $passwordPlaceholder ?>"/><br>
            </div>

            <button type="submit" class="buttonLog">Se connecter</button>
        </form>
        <div id="changeButton">
            <span>Pas encore inscrit ? </span><a HREF="register.php"><button>S'inscrire</button></a>
        </div>
    </div>
</div>
<?php
require 'header.php';
require 'database.php';

$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $_POST['username']]);
    $user = $stmt->fetch();

    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['username'] = $user;
        header('Location: profil.php');
    }
    else
    {
        $passwordPlaceholder = "Mot de passe incorrect";
    }
}

?>

<body style="overflow: hidden">
<div class="viewportLogParent">

    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">

        <form action="" method="POST">

            <div class="logForm">
                <input type="text" name="username" placeholder="<?= $usernamePlaceholder ?>">
            </div>

            <div class="logForm">
                <input type="password" name="password" placeholder="<?= $passwordPlaceholder ?>"/>
            </div>

            <button type="submit" class="buttonLog">Se connecter</button>
        </form>
        <div id="changeButton">
            <span>Pas encore inscrit ? </span><a HREF="register.php"><button>S'inscrire</button></a>
        </div>
    </div>
</div>
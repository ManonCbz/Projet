<?php
require 'require/database.php';
include "require/header.php";

$pseudoPlaceholder = "Pseudo";
$emailPlaceholder = "Adresse email";
$passwordPlaceholder = "Mot de passe";

$userID = "";

// Si le formulaire (ci-dessous) est rempli

if (!empty($_POST)){

    $errors = array();

    // Si le input pseudo est vide

    if (empty($_POST['username'])){
        $errors['username'] = "Pseudo vide";
        $pseudoPlaceholder = "Veuillez entrer un pseudo"
        ?><style>
            .usernameInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le pseudo contient un caractére spécial

    else if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Pseudo invalide";
        $pseudoPlaceholder = "Uniquement des lettres et des chiffres"
        ?><style>
            .usernameInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le pseudo a déjà été enregistré/utilisé

    else {
        $req = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $req->bind_param("s", $_POST['username']);
        $req->execute();
        $user = $req->fetch();
        $req->close();
        if($user){
            $errors['username'] = "Pseudo déjà pris";
            $pseudoPlaceholder = "Votre pseudo est déjà utilisé";
            ?><style>
                .usernameInput::placeholder {color: red; font-style: italic}
            </style><?php
        }
    }

    // Si le input mail est vide

    if (empty($_POST['email'])){
        $errors['email'] = "Email vide";
        $emailPlaceholder = "Veuillez entrer un email"
        ?><style>
            .emailInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le mail est n'est pas valide

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email invalide";
        $emailPlaceholder = "Cet email n'est pas valide"
        ?><style>
            .emailInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si l'email est déjà utilisé

    else {
            $req = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $req->bind_param("s", $_POST['email']);
            $req->execute();
            $mail = $req->fetch();
            $req->close();
            if($mail){
                $errors['username'] = "Email est déjà utilisé";
                $emailPlaceholder = "Cet email est déjà utilisé";
                ?><style>
                    .emailInput::placeholder {color: red; font-style: italic}
                </style><?php
            }
    }

    // Si le input mot de passe est vide

    if (empty($_POST['password'])){
        $errors['password'] = "Mdp invalide";
        $passwordPlaceholder = "Veuillez entrer un mot de passe"
        ?><style>
            .passwordInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le mot de passe ne correspond pas à la confirmation

    else if ($_POST['password'] != $_POST['passwordConfirm']){
        $errors['password'] = "Mdp ne correspond pas";
        $passwordPlaceholder = "Mots de passe différents"
        ?><style>
            .passwordInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si il n'y a pas d'erreur -> envoi les infos à la db

    if (empty($errors)){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (id, username, email, password) VALUES (NULL , ?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $passwordHash);
        $stmt->execute();

        // ouvre une session

        $req = $conn->prepare('SELECT id FROM users WHERE id = ?');
        $req->bind_param("s", $_POST['id']);
        $req->execute();
        $userID = $req->fetch();

        var_dump($userID);
    }
}


?>

<html lang="fr">
<body style="overflow: hidden">
<div class="viewportLogParent">
    
    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">


        <form action="" method="POST">

            <div class="form-group">
                <input type="text" class="usernameInput" name="username" placeholder= " <?= $pseudoPlaceholder ?> ">
            </div>

            <div class="form-group">
                <input type="text" class="emailInput" name="email" placeholder="<?= $emailPlaceholder ?>">
            </div>

            <div class="form-group">
                <input type="password" class="passwordInput" name="password" placeholder="<?= $passwordPlaceholder ?>"/>
            </div>

            <div class="form-group">
                <input type="password" class="passwordInput" name="passwordConfirm" placeholder="<?= $passwordPlaceholder ?>">
            </div>

            <button type="submit" class="buttonLog">M'inscrire</button>
        </form>
        <div id="changeButton">
            <span>Déjà inscrit ? </span><a href="login.php"><button>Se connecter</button></a>
        </div>
    </div>
</div>

</body>
</html>


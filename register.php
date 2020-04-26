<?php
require 'database.php';
include "header.php";

$usernamePlaceholder = "Pseudo";
$emailPlaceholder = "Adresse email";
$passwordPlaceholder = "Mot de passe";

$userID = "";

// Si le formulaire (ci-dessous) est rempli

if (!empty($_POST)){

    $errors = array();

    // =========================================== Erreurs Formulaire =========================================== //

    // Si le input pseudo est vide

    if (empty($_POST['username'])){
        $errors['username'] = "Pseudo vide";
        $usernamePlaceholder = "Veuillez entrer un pseudo"
        ?><style>
            .usernameInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le pseudo contient un caractére spécial

    else if(!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Pseudo invalide";
        $usernamePlaceholder = "Uniquement des lettres et des chiffres"
        ?><style>
            .usernameInput::placeholder {color: red; font-style: italic}
        </style><?php
    }

    // Si le pseudo a déjà été enregistré/utilisé

    else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $user = $stmt->fetch();
        $stmt->close();
        if($user){
            $errors['username'] = "Pseudo déjà pris";
            $usernamePlaceholder = "Votre pseudo est déjà utilisé";
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
            $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->bind_param("s", $_POST['email']);
            $stmt->execute();
            $mail = $stmt->fetch();
            $stmt->close();
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

    // =========================================== Formulaire Correct =========================================== //

    // Pas d'erreur -> envoi les infos à la db & ouvre la session

    if (empty($errors)){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (id, username, email, password) VALUES (NULL , ?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $passwordHash);
        $stmt->execute();
        $stmt->close();

        session_start();
        $_SESSION['username'] = $username;
        header('Location: profil.php');
    }
}


?>
<head>
    <title>Test</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina+2|Satisfy&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body style="overflow: hidden">
<div class="viewportLogParent">
    
    <img class="imageHome" src="pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="pictures/camera.png" height="80px" width="80px">


        <form action="" method="POST">

            <div class="logForm">
                <input type="text" class="usernameInput" name="username" placeholder= " <?= $usernamePlaceholder ?> ">
            </div>

            <div class="logForm">
                <input type="text" class="emailInput" name="email" placeholder="<?= $emailPlaceholder ?>">
            </div>

            <div class="logForm">
                <input type="password" class="passwordInput" name="password" placeholder="<?= $passwordPlaceholder ?>"/>
            </div>

            <div class="logForm">
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


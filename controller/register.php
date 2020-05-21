<?php

require '../controller/header.php';

// ===== verification de connexion (Si la session est déjà ouverte -> profile.php) ===== //

if (!empty($_SESSION['username'])) {
    header('Location: profile.php');
}

if(!empty($_SESSION['admin'])){
    header('Location: admin.php');
}

$usernamePlaceholder = 'Pseudo';
$emailPlaceholder = 'Adresse email';
$passwordPlaceholder = 'Mot de passe';

$userID = '';

// Si le formulaire est rempli

if (!empty($_POST)) {

    // =========================================== Erreurs Formulaire =========================================== //

    // Je crée un tableau pour contenir les erreurs possible dans le formulaire

    $errors = array();

    // Pour chaque erreur :
    // 1 - J'ajoute celle-ci dans mon tableau $errors
    // 2 - Je modifie la variable placeholder & le CSS


    // Si le input pseudo est vide

    if (empty($_POST['username'])) {
        $errors['username'] = 'Pseudo vide';
        $usernamePlaceholder = 'Veuillez entrer un pseudo';
        ?>
        <style>
            .usernameInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // Si le pseudo contient un caractére spécial

    else if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = 'Pseudo invalide';
        $usernamePlaceholder = 'Uniquement des lettres et des chiffres';
        ?>
        <style>
            .usernameInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // Si le pseudo a déjà été enregistré/utilisé

    else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($user) {
            $errors['username'] = 'Pseudo déjà pris';
            $usernamePlaceholder = 'Votre pseudo est déjà utilisé';
            ?>
            <style>
                .usernameInput::placeholder {
                    color: red;
                    font-style: italic
                }
            </style>
            <?php
        }
    }

    // Si le input mail est vide

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email vide';
        $emailPlaceholder = 'Veuillez entrer un email';
        ?>
        <style>
            .emailInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // Si le mail est n'est pas valide

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email invalide';
        $emailPlaceholder = 'Cet email n\'est pas valide';
        ?>
        <style>
            .emailInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // Si l'email est déjà utilisé

    else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param("s", $_POST['email']);
        $stmt->execute();
        $mail = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($mail) {
            $errors['email'] = 'Email est déjà utilisé';
            $emailPlaceholder = 'Cet email est déjà utilisé';
            ?>
            <style>
                .emailInput::placeholder {
                    color: red;
                    font-style: italic
                }
            </style>
            <?php
        }
    }

    // Si le input mot de passe est vide

    if (empty($_POST['password'])) {
        $errors['password'] = 'Mdp invalide';
        $passwordPlaceholder = 'Veuillez entrer un mot de passe';
        ?>
        <style>
            .passwordInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // Si le mot de passe ne correspond pas à la confirmation

    else if ($_POST['password'] != $_POST['passwordConfirm']) {
        // Ajout de l'erreur au tableau
        $errors['password'] = 'Mdp ne correspond pas';

        $passwordPlaceholder = 'Mots de passe différents';
        ?>
        <style>
            .passwordInput::placeholder {
                color: red;
                font-style: italic
            }
        </style>
        <?php
    }

    // =========================================== Formulaire Correct =========================================== //

    // Pas d'erreur -> envoi les infos à la db & ouvre la session

    if (empty($errors)) {

        $username = $_POST['username'];
        $email = $_POST['email'];

        // Je hache le mot de passe

        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Appel des fonctions pour créer le compte et le profil utilisateur + Ouverture session & redirection

        createAccount($username, $email, $passwordHash);

        createInformation($username);
        getID($username);

        session_start();

        $_SESSION['username'] = $username;
        header('Location: profile.php');
    }
}

require('../view/registerView.php');

?>
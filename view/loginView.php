<body style="overflow: hidden">
<div class="viewportLogParent">

    <img alt="Photo" class="imageHome" src="../view/pictures/homepict.jpg">

    <div class="viewportLog">
        <img alt="Spot photo" src="../view/pictures/log-camera.png" height="80px" width="80px">

        <div class="error"> ● Identifiant ou mot de passe incorrect</div>

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
            <span>Pas encore inscrit ? </span><a HREF="../controller/register.php">
                <button>S'inscrire</button>
            </a>
        </div>
    </div>
</div>


<body style="overflow: hidden">
<div class="viewportLogParent">

    <img class="imageHome" src="../vue/pictures/photoacceuil.jpg" height="100%" width="49%">

    <div class="viewportLog">
        <img src="../vue/pictures/camera.png" height="80px" width="80px">

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
            <span>Pas encore inscrit ? </span><a HREF="../controller/register.php"><button>S'inscrire</button></a>
        </div>
    </div>
</div>
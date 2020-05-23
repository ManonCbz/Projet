<body style="overflow: hidden">
<div class="viewportLogParent">

    <img alt="Photo" class="imageHome" src="../view/pictures/homepict.jpg">

    <div class="viewportLog">
        <img alt="Spot photo" src="../view/pictures/log-camera.png" height="80px" width="80px">


        <form action="" method="POST">

            <div class="logForm">
                <input type="text" class="usernameInput" name="username" placeholder=" <?= $usernamePlaceholder ?> ">
            </div>

            <div class="logForm">
                <input type="text" class="emailInput" name="email" placeholder="<?= $emailPlaceholder ?>">
            </div>

            <div class="logForm">
                <input type="password" class="passwordInput" name="password" placeholder="<?= $passwordPlaceholder ?>"/>
            </div>

            <div class="logForm">
                <input type="password" class="passwordInput" name="passwordConfirm"
                       placeholder="<?= $passwordPlaceholder ?>">
            </div>

            <button type="submit" class="buttonLog">M'inscrire</button>
        </form>
        <div id="changeButton">
            <span>Déjà inscrit ? </span><a href="../controller/login.php">
                <button>Se connecter</button>
            </a>
        </div>
    </div>
</div>

</body>

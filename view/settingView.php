<body class="bodySetting">

<h2>Paramètres</h2>

<div class="settingViewport">
    <div class="settingProfil">
        <h3>Profil</h3>

        <form method="post">
            <label for="presentationSetting">Présentation</label>
            <textarea name="presentationSetting" id="presentationSetting"><?= $informationsUser["presentationText"] ?></textarea>
            <label for="websiteSetting">Votre site web</label>
            <input name="websiteSetting" id="websiteSetting" placeholder="Site web, Instagram, Facebook.." type="url" value= <?= $informationsUser["websiteValue"] ?> >
            <button type="submit">Ok</button>
        </form>
    </div>

    <div class="settingOther">
        <form method="post">
            <label for="newEmail">Changer l'adresse email : </label>
            <input type="email" name="newEmail" id="newEmail" class="newEmail" placeholder="<?= $newEmailPlaceholder ?>">
            <input type="email" name="newEmailConf" id="newEmailConf" class="newEmail" placeholder="<?= $newEmailPlaceholder ?>">
            <button type="submit">Ok</button>
        </form>

    <a href="../controller/delete.php" id="deleteAccount">Supprimer mon compte</a>

    </div>

</div>

</body>

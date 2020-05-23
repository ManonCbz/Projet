<body class="bodySetting">

<h2>Paramètres</h2>

<div class="settingViewport">
    <div class="settingProfil">
        <h3>Profil</h3>

        <form method="post">
            <label for="presentationSetting">Présentation</label>
            <textarea name="presentationSetting"
                      id="presentationSetting"><?= $informationsUser["presentationText"] ?></textarea>
            <label for="websiteSetting">Votre site web</label>
            <input name="websiteSetting" id="websiteSetting" placeholder="Pseudo Instagram" type="text"
                   value= <?= $informationsUser["websiteValue"] ?>>
            <button type="submit">Ok</button>
        </form>
    </div>

    <div class="settingOther">
        <form method="post">
            <label for="newEmail">Changer l'adresse email : </label>
            <input type="email" name="newEmail" id="newEmail" class="newEmail"
                   placeholder="<?= $newEmailPlaceholder1 ?>">
            <input type="email" name="newEmailConf" id="newEmailConf" class="newEmail"
                   placeholder="<?= $newEmailPlaceholder2 ?>">
            <button type="submit">Ok</button>
        </form>

        <form id="deleteAccount" method="post">
            <label for="deleteInput">Supprimer mon compte</label>
            <input type="password" id="deleteInput" class="deleteInput" name="password" placeholder="<?= $deletePlaceholder1 ?>">
            <input type="password" class="deleteInput" name="confPassword" placeholder="<?= $deletePlaceholder2 ?>">
            <button id="buttonDelete" type="submit">Je supprime mon compte</button>
        </form>

    </div>

</div>

</body>

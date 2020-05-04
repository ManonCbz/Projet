<body class="bodySetting">

<h2>Paramètres</h2>

<div class="settingViewport">
    <div class="settingProfil">
        <h3>Profil</h3>

        <form method="post">
            <label for="presentationSetting">Présentation</label><br>
            <textarea name="presentationSetting" id="presentationSetting"><?= $informationsUser["presentationText"] ?></textarea>
            <label for="websiteSetting">Votre site web</label><br>
            <input name="websiteSetting" id="websiteSetting" placeholder="Site web, Instagram, Facebook.." type="url" value= <?= $informationsUser["websiteValue"] ?> >
            <button type="submit">Ok</button>
        </form>
    </div>

    <div class="settingOther">
    </div>
</div>

</body>

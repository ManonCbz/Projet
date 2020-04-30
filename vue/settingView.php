<body class="bodySetting">

<h2>Paramètres</h2>

<div class="settingViewport">
    <div class="settingProfil">
        <h3>Profil</h3>

        <form method="post">
            <label for="presentationSetting">Présentation</label><br>
            <textarea id="presentationSetting"><?= $presentationText ?></textarea>
            <label for="websiteSetting">Votre site web</label><br>
            <input id="websiteSetting" type="url" value= <?= $websiteValue ?> >
            <button type="submit">Ok</button>
        </form>
    </div>

    <div class="settingOther">
    </div>
</div>

</body>
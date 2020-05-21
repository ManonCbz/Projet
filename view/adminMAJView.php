<body id="adminBody">

<div id="adminMAJviewport">
    <div id="ownMAJ">

        <h2> Changer mon mot de passe</h2>
        <form method="post" id="updatePasswordAdmin">
            <label for="oldPasswordAdmin">Ancien mot de passe</label>
            <input type="password" id="oldPasswordAdmin">
            <label for="newPasswordAdmin">Nouveau Mot de passe</label>
            <input type="password" id="newPasswordAdmin">
            <label for="confirmNewPasswordAdmin">Confirmation du mot de passe</label>
            <input type="password" id="confirmNewPasswordAdmin">
            <button type="submit">Ok</button>
        </form>

        <h2> Changer mon email</h2>
        <form method="post" id="updateEmailAdmin">
            <label for="oldEmailAdmin">Nouvel email : </label>
            <input type="email" id="oldEmailAdmin">
            <label for="newEmailAdmin">Mot de passe</label>
            <input type="email" id="newEmailAdmin">
            <button type="submit">Ok</button>
        </form>

    </div>
    <div id="otherAdmin">

        <h2> Ajouter un administrateur</h2>
        <form method="post" id="addAdmin">
            <label for="usernameAdmin">Pseudo</label>
            <input type="text" id="usernameAdmin">
            <label for="emailAdmin">Email</label>
            <input type="email" id="emailAdmin">
            <label for="confirmEmailAdmin">Confirmation de l'email</label>
            <input type="email" id="confirmEmailAdmin">
            <button type="submit">Ajouter</button>
        </form>

        <h2> Supprimer un administrateur</h2>
        <form method="post" id="deleteAdmin">
            <label for="emailAdmin">Email</label>
            <input type="email" id="emailAdmin">
            <label for="confirmEmailAdmin">Confirmation de l'email</label>
            <input type="email" id="confirmEmailAdmin">
            <button type="submit">Supprimer</button>
        </form>
    </div>
</div>

</body>

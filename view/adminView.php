<body id="adminBody">

<div id="adminViewport">
    <div id="acceptPict">
        <h2>Controle photo</h2>

        <div id="controle">
            <div id="adminImage"></div>
            <div id="adminInformationImage"></div>
        </div>

        <div id="buttonAdmin">
            <form name="accept" method="post">
                <input type="hidden" name="accept">
                <button id="acceptAdminButton">Accepter</button>
            </form>
            <form name="accept" method="post">
                <input type="hidden" name="delete">
                <button id="deleteAdminButton">Supprimer</button>
            </form>
        </div>

    </div>

    <div id="otherAdmin">
        <h2>Ajouter un administrateur</h2>

        <form method="post" id="addAdminForm">
            <input type="text" placeholder="Pseudo (Nom.Prénom)">
            <input type="email" placeholder="Adresse email">
            <input type="email" placeholder="Confirmez l'adresse Email">
            <button>Ajouter l'administrateur</button>
        </form>

        <h2>Supprimer un administrateur</h2>

        <form method="post" id="addAdminForm">
            <input type="text" placeholder="Pseudo (Nom.Prénom)">
            <button>Supprimer l'administrateur</button>
        </form>
    </div>
</div>
</body>
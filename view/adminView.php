<body id="adminBody">

<div id="adminViewport">
    <div id="acceptPict">
        <h2>Controle photo</h2>

        <div id="controle">
                <p>Toutes les photos sont mises à jour !</p>
                <?=getAllImages()?>
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
</div>
</body>
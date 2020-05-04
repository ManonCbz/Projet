<?php

// footer uniquement pour le responsive

if (isset($_SESSION['username'])) {
    ?>

    <div id="navbarFooter">
        <a href="profile.php"><img class="iconFooter" alt="profil" src="../view/pictures/icon-user.png"></a>
        <a href="addPicture.php"><img class="iconFooter" alt="ajouter" src="../view/pictures/icon-add.png"></a>
        <a href=""><img class="iconFooter" alt="rechercher" src="../view/pictures/icon-tool.png"></a>
    </div>

    <?php

}

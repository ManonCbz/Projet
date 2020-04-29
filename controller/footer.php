<?php

// footer uniquement pour le responsive

if (isset($_SESSION['username'])){
    ?>

    <div id="navbarFooter">
            <a href="profile.php"><img class="iconFooter" alt="profil" src="../vue/pictures/icon-user.png"></a>
            <a href=""><img class="iconFooter" alt="ajouter" src="../vue/pictures/icon-add.png"></a>
            <a href=""><img class="iconFooter" alt="rechercher" src="../vue/pictures/icon-tool.png"></a>
    </div>

<?php

}

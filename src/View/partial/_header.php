<header>
    <div class="navbar">
        <div class="logo">
            <div class="img-logo">
                <img src="src/public/picture/association.png" alt="img-logo">
            </div>
            <div>
                <a href="index.php?page=mission&action=homePage">Les eclaireurs solidaires</a>
            </div>
        </div>

        <ul class="links">
            <li class="nav-iem"><a href="#">A propos</a></li>
            <li class="nav-iem"><a href="index.php?page=mission&action=addMission">Ajouter</a></li>
            <li class="nav-iem"><a href="index.php?page=mission&action=listAllMission">Missions</a></li>
            <li class="nav-iem"><a href="index.php?page=thematic&action=show">Thematics</a></li>
            <?php if (!isset($_SESSION['users'])) { ?>
                <li class="nav-iem"><a href="index.php?page=user&action=signUpUser">Devenir benevole</a></li>
                <li class="nav-iem"><a href="index.php?page=user&action=signInUser" class="buttons">Connexion</a></li>
            <?php } else { ?>
                <li class="nav-iem"><a href="index.php?page=user&action=logOut" class="buttons">Deconnexion</a></li>
            <?php } ?>
            

            <?php if (isset($_SESSION['users'])) { ?>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#"><?= $_SESSION['users']['firstname'] ?></a>
                </li>
            <?php } ?>
        </ul>

        <div class="burger">
            <span></span>
        </div>
        <!-- <button class="burger-menu-buttons" onclick="openMenu()">
                    <span class="material-icons md-36">menu</span>
                </button> -->
    </div>
</header>
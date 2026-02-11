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

        <div class="search-container">
            <form action="index.php?page=mission&action=listAllMission" method="POST" class="search-form">
                <div class="search-group">
                    <input type="text" name="keyword" placeholder="Rechercher (lieu, nom...)" value="<?= $_POST['keyword'] ?? '' ?>">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <ul class="links">
            <li class="nav-iem"><a href="#">A propos</a></li>

            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-iem"><a href="index.php?page=mission&action=addMission">Ajouter une mission</a></li>
                <li class="nav-iem"><a href="index.php?page=thematic&action=show">Thématiques</a></li>
                <li class="nav-iem"><a href="index.php?page=user&action=showDashbord">Dashbord</a></li>
            <?php endif; ?>

            <li class="nav-iem"><a href="index.php?page=mission&action=listAllMission">Missions</a></li>

            <?php if (!isset($_SESSION['users']) && !isset($_SESSION['admin'])): ?>
                <li class="nav-iem"><a href="index.php?page=user&action=signUpAdmin">Devenir bénévole</a></li>
                <li class="nav-iem"><a href="index.php?page=user&action=signInAdmin" class="buttons">Connexion</a></li>
            <?php else: ?>
                <li class="nav-iem">
                    <a href="index.php?page=user&action=logOut" class="buttons">Déconnexion</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=user&action=profile" style="color: #f1c40f;">
                        <i class="fas fa-user"></i> 
                        <?php
                        if (isset($_SESSION['users'])) {
                            echo htmlspecialchars($_SESSION['users']['firstname']);
                        } elseif (isset($_SESSION['admin'])) {
                            echo "Admin: " . htmlspecialchars($_SESSION['admin']['name']);
                        } else {
                            echo "Invité";
                        }
                        ?>
                    </a>
                </li>

            <?php endif; ?>
        </ul>

        <div class="burger">
            <span></span>
        </div>
        <!-- <button class="burger-menu-buttons" onclick="openMenu()">
                    <span class="material-icons md-36">menu</span>
                </button> -->
    </div>
</header>
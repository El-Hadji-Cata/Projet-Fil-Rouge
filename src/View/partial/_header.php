<?php
$notifCount = 0;
$userDemands = [];

// Récupération de l'ID utilisateur (s'adapte au nom de colonne id ou id_users)
$userId = $_SESSION['users']['id'] ?? $_SESSION['users']['id_users'] ?? $_SESSION['user']['id'] ?? null;
$database = $db ?? ($this->db ?? null);

if ($userId && $database) {
    if (!class_exists('MissionModel')) {
        require_once __DIR__ . '/../../Model/MissionModel.php';
    }
    $missionModel = new MissionModel($database);
    // Demandes validées (2) ou rejetées (3)
    $userDemands = $missionModel->getUserDemandsWithStatus($userId);
    $notifCount = count($userDemands);
}
?>

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
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a href="#">A propos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=mission&action=addMission">Ajouter une mission</a></li>
                <li class="nav-item"><a href="index.php?page=thematic&action=show">Thématiques</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=showDashbord">Dashbord</a></li>
            <?php endif; ?>

            <li class="nav-item"><a href="index.php?page=mission&action=listAllMission">Missions</a></li>

            <?php if (!isset($_SESSION['users']) && !isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=user&action=signUpAdmin">Devenir bénévole</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=signInAdmin" class="buttons">Connexion</a></li>
            <?php else: ?>

                <!-- CLOCHE DE NOTIFICATION FONTAWESOME -->
                <?php if (isset($_SESSION['users']) || isset($_SESSION['user'])): ?>
                    <li class="nav-item" style="margin: 0 10px; display: flex; align-items: center;">
                        <a href="index.php?page=user&action=profile" style="color: #f7b80b !important; position: relative; font-size: 1.3rem; text-decoration: none;" title="Mes candidatures">
                            <i class="fas fa-bell"></i>
                            <?php if ($notifCount > 0): ?>
                                <span style="position: absolute; top: -6px; right: -10px; background-color: #e74c3c; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; font-weight: bold; line-height: 1;">
                                    <?= $notifCount ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- PROFIL UTILISATEUR -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=user&action=profile" style="color: #f1c40f;">
                        <i class="fas fa-user"></i>
                        <?php
                        if (isset($_SESSION['users'])) {
                            echo htmlspecialchars($_SESSION['users']['firstname'] ?? $_SESSION['users']['users_firstname'] ?? 'Utilisateur');
                        } elseif (isset($_SESSION['admin'])) {
                            echo "Admin: " . htmlspecialchars($_SESSION['admin']['name'] ?? 'Admin');
                        } else {
                            echo "Invité";
                        }
                        ?>
                    </a>
                </li>

                <!-- DÉCONNEXION -->
                <li class="nav-item">
                    <a href="index.php?page=user&action=logOut" class="buttons">Déconnexion</a>
                </li>

            <?php endif; ?>
        </ul>

        <div class="burger">
            <span></span>
        </div>
    </div>
</header>
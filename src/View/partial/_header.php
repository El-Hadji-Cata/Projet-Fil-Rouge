<?php
$notifCount = 0;
$userDemands = [];
$unreadMsgCount = 0;

// Récupération des IDs
$userId = $_SESSION['users']['users_id'] ?? $_SESSION['users']['id'] ?? $_SESSION['user']['users_id'] ?? $_SESSION['user']['id'] ?? null;
$isAdmin = isset($_SESSION['admin']);
$adminId = $_SESSION['admin']['admin_id'] ?? $_SESSION['admin']['id'] ?? 6;
$database = $db ?? ($this->db ?? null);

if ($database) {
    // 1. Gestion des demandes de missions (pour l'utilisateur)
    if ($userId) {
        if (!class_exists('MissionModel')) {
            require_once __DIR__ . '/../../Model/MissionModel.php';
        }
        $missionModel = new MissionModel($database);
        $userDemands = $missionModel->getUserDemandsWithStatus($userId);
        $notifCount = count($userDemands);
    }

    // 2. Gestion des messages non lus
    if (!class_exists('MessageModel')) {
        require_once __DIR__ . '/../../Model/MessageModel.php';
    }
    $messageModel = new MessageModel($database);
    $unreadMsgCount = $messageModel->countUnreadMessages($userId, $adminId, $isAdmin);
    //var_dump($userId, $isAdmin, $unreadMsgCount);
}
?>

<header>
    <div class="navbar" style="display: flex; align-items: center; justify-content: space-between; width: 100%; flex-wrap: nowrap;">

        <!-- LOGO -->
        <div class="logo" style="display: flex; align-items: center; gap: 10px; flex-shrink: 0;">
            <div class="img-logo">
                <img src="src/public/picture/association.png" alt="img-logo">
            </div>
            <div>
                <a href="index.php?page=mission&action=homePage" style="text-decoration: none; white-space: nowrap;">Les eclaireurs solidaires</a>
            </div>
        </div>

        <!-- LIENS DE NAVIGATION (ALIGNÉS SUR UNE SEULE LIGNE) -->
        <ul class="links" style="display: flex; align-items: center; justify-content: flex-end; gap: 15px; margin: 0; padding: 0; list-style: none; flex-wrap: nowrap; white-space: nowrap;">

            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a href="#">A propos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=mission&action=addMission">Ajouter une mission</a></li>
                <li class="nav-item"><a href="index.php?page=thematic&action=show">Thématiques</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=showDashbord">Dashbord</a></li>
            <?php endif; ?>

            <li class="nav-item"><a href="index.php?page=mission&action=listAllMission">Missions</a></li>

            <!-- LIEN MESSAGERIE (Visible uniquement si connecté) -->
            <?php if (isset($_SESSION['users']) || isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
                <li class="nav-item notification-item">
                    <a href="index.php?page=message&action=conversation" class="notif-link" title="Messagerie">
                        <i class="fas fa-envelope"></i> Messagerie
                        <?php if (isset($unreadMsgCount) && $unreadMsgCount > 0): ?>
                            <span class="badge" style="background-color: #e74c3c; color: #fff; padding: 2px 6px; border-radius: 50%; font-size: 0.75rem; margin-left: 5px;">
                                <?= $unreadMsgCount ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (!isset($_SESSION['users']) && !isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=user&action=signUpUser">Devenir bénévole</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=signInUser" class="buttons">Connexion</a></li>
            <?php else: ?>

                <!-- CLOCHE DE NOTIFICATION -->
                <?php if (isset($_SESSION['users']) || isset($_SESSION['user'])): ?>
                    <li class="nav-item" style="display: flex; align-items: center;">
                        <a href="index.php?page=user&action=profile" style="color: #e9a30c !important; position: relative; font-size: 1.2rem; text-decoration: none;" title="Mes candidatures">
                            <i class="fas fa-bell"></i>
                            <?php if ($notifCount > 0): ?>
                                <span style="position: absolute; top: -6px; right: -10px; background-color: #e74c3c; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.75rem; font-weight: bold; line-height: 1;">
                                    <?= $notifCount ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- PROFIL UTILISATEUR OU ADMIN -->
                <li class="nav-item">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <!-- Redirection directe vers le Dashboard pour l'Admin -->
                        <a class="nav-link" href="index.php?page=user&action=showDashbord" style="color: #f1c40f; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                            <i class="fas fa-user-shield"></i>
                            Admin: <?= htmlspecialchars($_SESSION['admin']['name'] ?? $_SESSION['admin']['admin_name'] ?? 'Admin') ?>
                        </a>
                    <?php else: ?>
                        <!-- Redirection vers le Profil pour l'Utilisateur -->
                        <a class="nav-link" href="index.php?page=user&action=profile" style="color: #f1c40f; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                            <i class="fas fa-user"></i>
                            <?= htmlspecialchars($_SESSION['users']['firstname'] ?? $_SESSION['users']['users_firstname'] ?? 'Utilisateur') ?>
                        </a>
                    <?php endif; ?>
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
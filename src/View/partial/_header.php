<?php
$notifCount = 0;
$userDemands = [];
$unreadMsgCount = 0;

$userId = $_SESSION['users']['users_id'] ?? $_SESSION['users']['id'] ?? $_SESSION['user']['users_id'] ?? $_SESSION['user']['id'] ?? null;
$isAdmin = isset($_SESSION['admin']);
$adminId = $_SESSION['admin']['admin_id'] ?? $_SESSION['admin']['id'] ?? 6;
$database = $db ?? ($this->db ?? null);

if ($database) {
    if ($userId) {
        if (!class_exists('MissionModel')) {
            require_once __DIR__ . '/../../Model/MissionModel.php';
        }
        $missionModel = new MissionModel($database);
        $userDemands = $missionModel->getUserDemandsWithStatus($userId);
        $notifCount = count($userDemands);
    }

    if (!class_exists('MessageModel')) {
        require_once __DIR__ . '/../../Model/MessageModel.php';
    }
    $messageModel = new MessageModel($database);
    $unreadMsgCount = $messageModel->countUnreadMessages($userId, $adminId, $isAdmin);
}
?>

<header>
    <nav class="navbar">

        <!-- LOGO -->
        <div class="logo">
            <div class="img-logo">
                <img src="src/public/picture/association.png" alt="img-logo">
            </div>
            <a href="index.php?page=mission&action=homePage">Les éclaireurs solidaires</a>
        </div>

        <!-- LIENS DE NAVIGATION -->
        <ul class="links" id="nav-links">

            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-item"><a href="#">À propos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=mission&action=addMission">Ajouter une mission</a></li>
                <li class="nav-item"><a href="index.php?page=thematic&action=show">Thématiques</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=showDashbord">Dashboard</a></li>
            <?php endif; ?>

            <li class="nav-item"><a href="index.php?page=mission&action=listAllMission">Missions</a></li>

            <?php if (isset($_SESSION['users']) || isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
                <li class="nav-item notification-item">
                    <a href="index.php?page=message&action=conversation" class="notif-link" title="Messagerie">
                        <i class="fas fa-envelope"></i> Messagerie
                        <?php if (isset($unreadMsgCount) && $unreadMsgCount > 0): ?>
                            <span class="badge"><?= $unreadMsgCount ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (!isset($_SESSION['users']) && !isset($_SESSION['admin'])): ?>
                <li class="nav-item"><a href="index.php?page=user&action=signUpUser">Devenir bénévole</a></li>
                <li class="nav-item"><a href="index.php?page=user&action=signInUser" class="buttons">Connexion</a></li>
            <?php else: ?>

                <?php if (isset($_SESSION['users']) || isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a href="index.php?page=user&action=profile" class="bell-link" title="Mes candidatures">
                            <i class="fas fa-bell"></i>
                            <?php if ($notifCount > 0): ?>
                                <span class="badge"><?= $notifCount ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <a class="nav-link admin-profile" href="index.php?page=user&action=showDashbord">
                            <i class="fas fa-user-shield"></i>
                            Admin: <?= htmlspecialchars($_SESSION['admin']['name'] ?? $_SESSION['admin']['admin_name'] ?? 'Admin') ?>
                        </a>
                    <?php else: ?>
                        <a class="nav-link user-profile" href="index.php?page=user&action=profile">
                            <i class="fas fa-user"></i>
                            <?= htmlspecialchars($_SESSION['users']['firstname'] ?? $_SESSION['users']['users_firstname'] ?? 'Utilisateur') ?>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="nav-item">
                    <a href="index.php?page=user&action=logOut" class="buttons">Déconnexion</a>
                </li>

            <?php endif; ?>
        </ul>

        <!-- BURGER MENU -->
        <div class="burger" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</header>
<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<div class="profile-container">
    <div class="user-info">
        <img src="/Projet_fil_rouge/src/public/picture/<?= $userData['users_img'] ?>" style="width:150px; border-radius:50%;">
        <h2><?= $userData['users_firstname'] ?> <?= $userData['users_lastname'] ?></h2>
        <p><strong>Email :</strong> <?= $userData['users_email'] ?></p>
        <p><strong>Ville :</strong> <?= $userData['users_city'] ?></p>
    </div>


    <hr>

    <h3>Mes Missions</h3>
    <div class="mission-list">
        <?php if (!empty($userMissions)): ?>
            <?php foreach ($userMissions as $mission): ?>
                <div class="mission-item">
                    <strong><?= $mission['missions_name'] ?></strong>
                    <span>Statut :
                        <?= $mission['demand_mission_validation'] == 1 ? '✅ Validée' : '⏳ En attente' ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Vous n'avez pas encore postulé à des missions.</p>
        <?php endif; ?>
    </div>
</div>

<hr class="my-5">
<div class="edit-profile-section">
    <h3 class="mb-4">Modifier mes informations personnelles</h3>

    <form action="index.php?page=user&action=editProfile" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 bg-light rounded">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Prénom</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($userData['users_firstname'] ?? '') ?>" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Nom</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($userData['users_lastname'] ?? '') ?>" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label class="form-label font-weight-bold">Adresse</label>
                <input type="text" name="address" value="<?= htmlspecialchars($userData['users_address'] ?? '') ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label font-weight-bold">Ville</label>
                <input type="text" name="city" value="<?= htmlspecialchars($userData['users_city'] ?? '') ?>" class="form-control">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label font-weight-bold">Changer ma photo de profil</label>
            <input type="file" name="image" class="form-control-file border p-1 w-100 bg-white">
            <small class="text-muted">Format acceptés : JPG, PNG. Max 500ko.</small>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-success px-5">
                <i class="fas fa-save mr-2"></i>Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<?php
require_once 'src/View/partial/_footer.php';
?>
<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';

?>

<div class="container">
    <h1 style="color:#224631;text-align:center;">Liste des Missions</h1>

    <?php if (!empty($this->missions) && is_array($this->missions)): ?>
        <?php foreach ($this->missions as $categ): ?>
            <div class="card mb-3" style="max-width: 840px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="src/public/picture/engagement.jpg" class="img-fluid rounded-start" alt="Image de mission">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($categ['missions_name']) ?></h5>
                            <p class="card-text"><strong>Places disponibles:</strong>
                                <span class="badge <?= $categ['missions_nbre_volontaries'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $categ['missions_nbre_volontaries'] ?>
                                </span>
                            </p>

                            <p class="card-text"><strong>Dates:</strong> Du <?= $categ['missions_date_start'] ?> au <?= $categ['missions_date_stop'] ?></p>
                            <p class="card-text"><strong>Lieu:</strong> <?= htmlspecialchars($categ['missions_address']) ?></p>

                            <?php if (isset($_SESSION['users']['id'])): ?>
                                <?php
                                // On vérifie si l'utilisateur est inscrit à la mission ou pas 
                                $isRegistered = $this->missionModel->alreadyApplied($_SESSION['users']['id'], $categ['missions_id']);
                                ?>

                                <?php if ($isRegistered): ?>
                                    <a href="index.php?page=mission&action=missionRegister&idMission=<?= $categ['missions_id'] ?>"
                                        class="btn btn-danger">Se désinscrire</a>
                                <?php elseif ($categ['missions_nbre_volontaries'] > 0): ?>
                                    <a href="index.php?page=mission&action=missionRegister&idMission=<?= $categ['missions_id'] ?>"
                                        class="btn btn-primary">S'inscrire</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Complet</button>
                                <?php endif; ?>

                            <?php else: ?>
                                <a href="index.php?page=user&action=signInUser" class="btn btn-secondary">Connectez-vous pour postuler</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info text-center mt-5" role="alert">
            <i class="fas fa-search-minus fa-2x mb-3"></i>
            <h3>Oups ! Aucun résultat.</h3>
            <p>Nous n'avons trouvé aucune mission correspondant à vos critères de recherche.</p>
            <a href="index.php?page=mission&action=listAllMission" class="btn btn-outline-primary">
                Voir toutes les missions
            </a>
        </div>
    <?php endif; ?>
</div>


<?php
require_once 'src/View/partial/_footer.php';
?>
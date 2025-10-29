<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';

?>

<div class="container">
    <h1 style="color:#224631;text-align:center;">Liste des Missions</h1>

    <?php foreach ($this->missions as $categ) { ?>
        <div class="card mb-3" style="max-width: 840px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="src/public/picture/engagement.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $categ['missions_name'] ?></h5>
                        <p class="card-text"><strong>Nombre de volntaires Recherchés:</strong> <?= $categ['missions_nbre_volontaries'] ?></p>
                        <p class="card-text"><strong>Date de début:</strong> <?= $categ['missions_date_start'] ?></small></p>
                        <p class="card-text"><strong>Date de fin:</strong> <?= $categ['missions_date_stop'] ?></small></p>
                        <p class="card-text"><strong>Duree: </strong><?= $categ['missions_duration_hour'] ?></small></p>
                        <p class="card-text"><strong>Lieu: </strong><?= $categ['missions_address'] ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<?php
require_once 'src/View/partial/_footer.php';
?>
<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<div class="dashboard-container container-fluid mt-4">
    <h1 class="mb-4">Tableau de Bord Administrateur</h1>

    <div class="row mb-4 text-center">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h5>Utilisateurs</h5>
                <h3><?= count($allUsers) ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h5>En attente</h5>
                <h3><?= count($pendingDemands) ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h5>Sélectionnées</h5>
                <h3><?= count($activeMissions) ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h5>Rejetées</h5>
                <h3><?= count($rejectedDemands) ?></h3>
            </div>
        </div>
    </div>

    <section class="mb-5 shadow-sm p-3 bg-white rounded">
        <h2 class="text-danger"><i class="fas fa-hourglass-half"></i> Demandes en attente de validation</h2>
        <table class="table table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Utilisateur</th>
                    <th>Mission</th>
                    <th>Date demande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingDemands as $demand): ?>
                    <tr>
                        <td><?= $demand['users_firstname'] ?> <?= $demand['users_lastname'] ?></td>
                        <td><?= $demand['missions_name'] ?></td>
                        <td><?= $demand['demand_mission_date'] ?></td>
                        <td>
                            <a href="index.php?page=user&action=validateDemand&id=<?= $demand['demand_mission_id'] ?>"
                                class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Valider
                            </a>

                            <a href="index.php?page=user&action=rejectDemand&id=<?= $demand['demand_mission_id'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Refuser cette demande ?')">
                                <i class="fas fa-times"></i> Refuser
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="mb-5 shadow-sm p-3 bg-white rounded">
    <h2 class="text-success"><i class="fas fa-check-circle"></i> Personnes sélectionnées (Missions en cours)</h2>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Bénévole</th>
                <th>Mission</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activeMissions as $active): ?>
                <tr>
                    <td><?= htmlspecialchars($active['users_firstname']) ?></td>
                    <td><?= htmlspecialchars($active['missions_name']) ?></td>
                    <td><span class="badge bg-success">Validé</span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

    <section class="mb-5 shadow-sm p-3 bg-light rounded">
        <h2 class="text-secondary"><i class="fas fa-user-times"></i> Demandes Refusées</h2>
        <table class="table table-sm mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Utilisateur</th>
                    <th>Mission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rejectedDemands as $rejected): ?>
                    <tr>
                        <td class="text-muted"><?= htmlspecialchars($rejected['users_firstname'] . ' ' . $rejected['users_lastname']) ?></td>
                        <td class="text-muted"><?= htmlspecialchars($rejected['missions_name']) ?></td>
                        <td>
                            <a href="index.php?page=user&action=validateDemand&id=<?= $rejected['demand_mission_id'] ?>" 
                               class="btn btn-sm btn-outline-primary">Ré-examiner</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if(empty($rejectedDemands)): ?>
                    <tr><td colspan="3" class="text-center text-muted">Aucun historique de refus.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section class="mb-5 shadow-sm p-3 bg-white rounded">
        <h2><i class="fas fa-users"></i> Gestion des Utilisateurs</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?= $user['users_id'] ?></td>
                        <td><?= $user['users_firstname'] ?> <?= $user['users_lastname'] ?></td>
                        <td><?= $user['users_email'] ?></td>
                        <td><?= $user['users_city'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-info">Détails</button>
                            <button class="btn btn-sm btn-outline-danger">Bannir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</div>

<?php
require_once 'src/View/partial/_footer.php';
?>
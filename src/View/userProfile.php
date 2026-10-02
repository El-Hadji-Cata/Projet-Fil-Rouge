<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<div class="container my-5" style="max-width: 800px;">

    <!-- 1. CARTE DU HAUT : Profil & Mes Missions -->
    <div class="card border-0 shadow-lg mb-5" style="border-radius: 12px; background-color: #ffffff;">
        <div class="card-body p-4 p-md-5 text-center">

            <!-- Photo de profil -->
            <div class="mb-3">
                <?php $avatar = !empty($userData['users_img']) ? $userData['users_img'] : 'default.png'; ?>
                <img src="public/picture/<?= htmlspecialchars($avatar) ?>" alt="Photo de profil" class="rounded-circle img-thumbnail" style="width: 110px; height: 110px; object-fit: cover; border-color: #28a745;">
            </div>

            <h3 class="fw-bold text-dark mb-1" style="font-size: 1.5rem;">
                <?= htmlspecialchars($userData['users_firstname'] ?? '') ?> <?= htmlspecialchars($userData['users_lastname'] ?? '') ?>
            </h3>
            <p class="text-muted small mb-1">Email : <?= htmlspecialchars($userData['users_email'] ?? '') ?></p>
            <p class="text-muted small mb-4">Ville : <?= htmlspecialchars($userData['users_city'] ?? '') ?></p>

            <hr class="my-4 text-muted opacity-25">

            <h4 class="fw-bold mb-4" style="color: #224631; font-size: 1.2rem;">Mes Missions</h4>

            <div class="list-group list-group-flush">
                <?php if (!empty($userMissions)): ?>
                    <?php foreach ($userMissions as $index => $mission): ?>
                        <div class="list-group-item bg-light rounded mb-2 border-0 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-secondary"><?= htmlspecialchars($mission['missions_name'] ?? '') ?></span>

                                <?php
                                $statusId = $mission['id_status'] ?? null;
                                $isValidated = ($statusId == 2 || ($mission['demand_mission_validation'] ?? 0) == 1);
                                ?>

                                <?php if ($isValidated): ?>
                                    <span class="badge bg-success text-white px-3 py-2">
                                        ✔ Validée
                                    </span>
                                <?php elseif ($statusId == 3): ?>
                                    <span class="badge bg-danger text-white px-3 py-2">
                                        ✖ Refusée
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        ⏳ En attente
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Bloc Avis & Notation (Si la mission est validée) -->
                            <?php if ($isValidated): ?>
                                <?php
                                $demandId = $mission['demand_mission_id']
                                    ?? $mission['id_demand']
                                    ?? $mission['id_missions']
                                    ?? $mission['missions_id']
                                    ?? $mission['id']
                                    ?? ($index + 1);

                                $userAvis = $mission['demand_mission_avis'] ?? null;
                                $userNote = $mission['demand_mission_note'] ?? '5';
                                ?>

                                <?php if (!empty($userAvis)): ?>
                                    <!-- Affichage de l'avis déjà déposé -->
                                    <div class="mt-3 text-start p-3 bg-white rounded border">
                                        <small class="text-success fw-bold d-block mb-1">
                                            <i class="fas fa-check-circle me-1"></i> Votre avis déposé (<?= htmlspecialchars((string)$userNote) ?>/5 ⭐) :
                                        </small>
                                        <p class="mb-0 small text-muted fs-6">"<?= htmlspecialchars((string)$userAvis) ?>"</p>
                                    </div>
                                <?php else: ?>
                                    <!-- Bouton & Formulaire pour laisser un avis -->
                                    <div class="text-end mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-success" onclick="toggleReviewForm('reviewForm<?= $demandId ?>')">
                                            <i class="fas fa-star me-1"></i> Donner mon avis
                                        </button>
                                    </div>

                                    <div id="reviewForm<?= $demandId ?>" class="mt-3 text-start" style="display: none;">
                                        <form action="index.php?page=mission&action=addReview" method="POST" class="p-3 border rounded bg-white shadow-sm">
                                            <input type="hidden" name="id_demand" value="<?= $demandId ?>">

                                            <div class="mb-2">
                                                <label class="form-label fw-semibold small mb-1">Note / 5</label>
                                                <select name="note" class="form-select form-select-sm" required>
                                                    <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                                                    <option value="4">⭐⭐⭐⭐ (4/5)</option>
                                                    <option value="3">⭐⭐⭐ (3/5)</option>
                                                    <option value="2">⭐⭐ (2/5)</option>
                                                    <option value="1">⭐ (1/5)</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label fw-semibold small mb-1">Votre avis</label>
                                                <textarea name="avis" class="form-control form-control-sm" rows="3" placeholder="Racontez votre expérience..." required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-success w-100">Envoyer mon avis</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-muted small my-3">Vous n'avez pas encore postulé à des missions.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- 2. CARTE DU BAS : Modification des infos -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px; background-color: #f5f5f5;">
        <div class="card-body p-4 p-md-5">

            <h5 class="fw-bold mb-4 d-flex align-items-center gap-2" style="color: #224631; font-size: 1.15rem;">
                <i class="fas fa-plus-circle"></i>
                Modifier mes informations personnelles
            </h5>

            <form action="index.php?page=user&action=editProfile" method="POST" enctype="multipart/form-data">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-bold text-muted small mb-1">Prénom</label>
                        <input type="text" name="firstname" value="<?= htmlspecialchars($userData['users_firstname'] ?? '') ?>" class="form-control bg-white" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-bold text-muted small mb-1">Nom</label>
                        <input type="text" name="lastname" value="<?= htmlspecialchars($userData['users_lastname'] ?? '') ?>" class="form-control bg-white" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-bold text-muted small mb-1">Adresse</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($userData['users_address'] ?? '') ?>" class="form-control bg-white">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase fw-bold text-muted small mb-1">Ville</label>
                        <input type="text" name="city" value="<?= htmlspecialchars($userData['users_city'] ?? '') ?>" class="form-control bg-white">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fw-bold text-muted small mb-1">Changer ma photo de profil</label>
                    <div class="position-relative">
                        <input type="file" name="image" id="profileImageInput" class="d-none">
                        <label for="profileImageInput" class="form-control bg-white d-flex align-items-center justify-content-between pe-2" style="cursor: pointer;">
                            <span class="text-muted small">Aucun fichier choisi</span>
                            <span class="btn btn-sm btn-light border d-flex align-items-center justify-content-center p-1" style="width: 28px; height: 28px; border-radius: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2z" />
                                </svg>
                            </span>
                        </label>
                    </div>
                    <div class="form-text text-muted" style="font-size: 0.75rem;">Format acceptés : JPG, PNG. Max 500ko.</div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn text-white fw-bold px-4 py-2 d-inline-flex align-items-center gap-2" style="background-color: #28a745; font-size: 0.9rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3z" />
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
function toggleReviewForm(id) {
    const form = document.getElementById(id);
    if (form) {
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
}
</script>
<?php
require_once 'src/View/partial/_footer.php';
?>
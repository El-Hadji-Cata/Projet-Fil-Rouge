<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<div class="container my-5">
    <div class="card shadow-sm mx-auto p-4" style="max-width: 600px !important; width: 100%; border: 1.5px solid #224631; border-radius: 8px; background-color: #ffffff;">

        <h3 class="text-center fw-bold mb-4 d-flex align-items-center justify-content-center gap-2" style="color: #224631;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#224631" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
            Ajouter une mission
        </h3>

        <form action="index.php?page=mission&action=addMission" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="title" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Nom de la mission</label>
                <input type="text" id="title" name="title" class="form-control form-control-sm" required>
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Description de la mission</label>
                <textarea id="summary" name="summary" rows="3" class="form-control form-control-sm" required></textarea>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <label for="dateStart" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Date de début</label>
                    <input type="date" id="dateStart" name="dateStart" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-6">
                    <label for="dateStop" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Date de fin</label>
                    <input type="date" id="dateStop" name="dateStop" class="form-control form-control-sm" required>
                </div>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <label for="nbre" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Volontaires</label>
                    <input type="number" id="nbre" name="nbre" min="1" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Heures prévues</label>
                    <input type="time" id="time" name="time" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4">
                    <label for="address" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Adresse</label>
                    <input type="text" id="address" name="address" class="form-control form-control-sm" required>
                </div>
            </div>

            <div class="row g-2 mb-4">
                <div class="col-md-6">
                    <label for="category" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Thématique</label>
                    <select id="category" name="category" class="form-select form-select-sm" required>
                        <option value="" disabled selected>Choisir une thématique...</option>
                        <?php if (!empty($this->thematics)): ?>
                            <?php foreach ($this->thematics as $category): ?>
                                <option value="<?= $category['thematics_missions_id'] ?>">
                                    <?= htmlspecialchars($category['thematics_missions_name'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="city" class="form-label text-uppercase fw-bold text-muted small d-block mb-1">Ville</label>
                    <select id="city" name="city" class="form-select form-select-sm" required>
                        <option value="" disabled selected>Choisir une ville...</option>
                        <?php if (!empty($this->city)): ?>
                            <?php foreach ($this->city as $cat): ?>
                                <option value="<?= $cat['city_id'] ?>"><?= htmlspecialchars($cat['city_name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success fw-bold px-4 py-2" style="background-color: #28a745;">
                    Enregistrer la mission
                </button>
            </div>

        </form>
    </div>
</div>

<?php
require_once 'src/View/partial/_footer.php';
?>
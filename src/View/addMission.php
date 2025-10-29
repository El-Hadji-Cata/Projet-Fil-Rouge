<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';

?>

<div class="container">
    <h1 style="color:#224631;text-align:center;">Ajouter une mission</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Nom de la mission</label>
            <input value="" type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Description de la mission</label>
            <textarea class="form-control" id="summary" name="summary" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="dateStart" class="form-label">Date de début de la mission</label>
            <input value="" type="date" class="form-control" id="dateStart" name="dateStart">
        </div>
        <div class="mb-3">
            <label for="dateStop" class="form-label">Date de fin de la mission</label>
            <input value="" type="date" class="form-control" id="dateStop" name="dateStop">
        </div>
        <div class="mb-3">
            <label for="nbre" class="form-label">Nombres de volontaires récherchés</label>
            <input value="" type="number" class="form-control" id="nbre" name="nbre" min="1">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse de la mission</label>
            <input value="" type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Durée de la mission</label>
            <input value="" type="time" class="form-control" id="time" name="time">
        </div>
        <div class="mb-3">
            <label for="datePub" class="form-label">Date de publication de la mission</label>
            <input value="" type="date" class="form-control" id="datePub" name="datePub">
        </div>
        <div class="mb-3">
            <select class="form-select" name="category" aria-label="Default select example">
                <option selected>>Catégorie</option>
                <?php foreach ($this->thematics as $category) { ?>
                    <option value="<?= $category['thematics_missions_id'] ?>"><?= $category['thematics_missions_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-select" name="city" aria-label="Default select example">
                <option selected>>Ville</option>
                <?php foreach ($this->city as $cat) { ?>
                    <option value="<?= $cat['city_id'] ?>"><?= $cat['city_name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
require_once 'src/view/partial/_footer.php';

?>
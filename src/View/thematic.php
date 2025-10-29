<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';

?>

<div class="container">
    <h1 style="color:#224631;text-align:center;">Thematics</h1>

    <form action="index.php?page=thematic&action=addThematic" method="post">
        <div class="mb-3">
            <input value="" type="text" name="thematics_missions_name">
            <button type="submit" class="btn btn-primary">Ajouter Thematic</button>
        </div>
    </form>

    <?php foreach ($this->thematics as $category) { ?>
        <div style="display:flex ; justify-content:space-between; align-items:center">
            <p style="opacity: <?= $category['thematics_missions_is_activated'] == 1 ? '1' : '0.5' ?>;"><?= $category['thematics_missions_name'] ?></p>
            <a href="index.php?page=thematic&action=toggle&id=<?= $category['thematics_missions_id'] ?>" style="display: block; width: 40px;">
                <img style="display: block; width:40px;" src="src/public/picture/<?= $category['thematics_missions_is_activated'] == 1 ? 'remove' : 'add' ?>.svg" alt="">
            </a>
        </div>
    <?php } ?>

</div>


<?php
require_once 'src/view/partial/_footer.php';
?>
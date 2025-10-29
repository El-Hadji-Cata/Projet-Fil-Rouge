<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';

?>

<main class="container">
    <h1>Création de Compte</h1>

    <form action="index.php?page=user&action=addAdmin" method="post" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="pswrd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pswrd" name="pswrd">
        </div>
        <div class="mb-3">
            <label for="dateCreated" class="form-label">Date de création</label>
            <input type="date" class="form-control" id="dateCreated" name="dateCreated">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
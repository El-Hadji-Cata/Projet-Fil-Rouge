<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';
?>

<main class="container my-5" style="max-width: 550px;">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="card-body">
            <h1 class="h3 fw-bold text-center mb-4 text-dark">Nouveau compte Administrateur</h1>

            <form action="index.php?page=user&action=addAdmin" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="pswrd" class="form-label fw-semibold">Mot de passe</label>
                    <input type="password" class="form-control" id="pswrd" name="pswrd" required>
                </div>
                <div class="mb-4">
                    <label for="dateCreated" class="form-label fw-semibold">Date de création</label>
                    <input type="date" class="form-control" id="dateCreated" name="dateCreated" value="<?= date('Y-m-d') ?>">
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill mb-3">Créer l'administrateur</button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="text-muted mb-0">Un compte administrateur existe déjà ?</p>
                <a href="index.php?page=user&action=signInAdmin" class="text-success fw-bold text-decoration-none">Se connecter à l'espace Admin</a>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
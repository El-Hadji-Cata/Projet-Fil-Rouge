<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';
?>

<main class="container my-5" style="max-width: 720px;">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="card-body">
            <h1 class="h3 fw-bold text-center mb-4 text-dark">Inscription Bénévole</h1>

            <form action="?page=user&action=addUser" method="post" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label fw-semibold">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label fw-semibold">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="pswrd" class="form-label fw-semibold">Mot de passe</label>
                    <input type="password" class="form-control" id="pswrd" name="pswrd" required>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label fw-semibold">Adresse postale</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>

                <div class="col-md-4">
                    <label for="gender" class="form-label fw-semibold">Genre</label>
                    <input type="text" class="form-control" id="gender" name="gender" placeholder="Ex: M / F / Autre">
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label fw-semibold">Ville</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="col-md-4">
                    <label for="country" class="form-label fw-semibold">Pays</label>
                    <input type="text" class="form-control" id="country" name="country" value="France">
                </div>

                <div class="col-md-6">
                    <label for="birthday" class="form-label fw-semibold">Date de Naissance</label>
                    <input type="date" class="form-control" id="birthday" name="birthday">
                </div>
                <div class="col-md-6">
                    <label for="dateCreated" class="form-label fw-semibold">Date de création</label>
                    <input type="date" class="form-control" id="dateCreated" name="dateCreated" value="<?= date('Y-m-d') ?>">
                </div>

                <div class="col-12">
                    <label for="image" class="form-label fw-semibold">Photo de Profil</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill mb-3">S'inscrire</button>
                </div>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="text-muted mb-0">Vous avez déjà un compte ?</p>
                <a href="index.php?page=user&action=signInUser" class="text-primary fw-bold text-decoration-none">Se connecter</a>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
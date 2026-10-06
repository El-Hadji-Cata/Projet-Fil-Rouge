<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<main class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 mx-auto" style="max-width: 400px !important; width: 100%;">
        <div class="card-body p-2">
            <h1 class="h4 fw-bold text-center mb-4 text-dark">Espace Bénévole</h1>

            <form action="index.php?page=user&action=signInUsr" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small mb-1">Adresse email</label>
                    <input type="email" class="form-control form-control-sm py-2" id="email" placeholder="nom@exemple.com" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="pswrd" class="form-label fw-semibold small mb-1">Mot de passe</label>
                    <input type="password" class="form-control form-control-sm py-2" id="pswrd" placeholder="••••••••" name="pswrd" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill my-2 py-2 fw-bold">Se connecter</button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="text-muted small mb-1">Pas encore de compte ?</p>
                <a href="index.php?page=user&action=addUser" class="text-primary fw-bold text-decoration-none small">Créer un compte bénévole</a>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'src/View/partial/_footer.php';
?>
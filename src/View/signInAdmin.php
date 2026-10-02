<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';
?>

<main class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 mx-auto" style="max-width: 400px !important; width: 100%;">
        <div class="card-body p-2">
            <h1 class="h4 fw-bold text-center mb-4 text-dark">Connexion Admin</h1>

            <form action="index.php?page=user&action=signInAdmn" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small mb-1">Nom d'utilisateur</label>
                    <input type="text" class="form-control form-control-sm py-2" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small mb-1">Adresse email</label>
                    <input type="email" class="form-control form-control-sm py-2" id="email" placeholder="nom@exemple.com" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="pswrd" class="form-label fw-semibold small mb-1">Mot de passe</label>
                    <input type="password" class="form-control form-control-sm py-2" id="pswrd" placeholder="••••••••" name="pswrd" required>
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill my-2 py-2 fw-bold">Se connecter</button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="text-muted small mb-1">Créer un nouvel accès administrateur ?</p>
                <a href="index.php?page=user&action=signUpAdmin" class="text-success fw-bold text-decoration-none small">Créer un compte Admin</a>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
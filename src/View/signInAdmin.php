<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';
?>

<main class="container my-5" style="max-width: 480px;">
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="card-body">
            <h1 class="h3 fw-bold text-center mb-4 text-dark">Connexion Admin</h1>

            <form action="index.php?page=user&action=signInAdmn" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nom d'utilisateur</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Adresse email</label>
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="nom@exemple.com" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="pswrd" class="form-label fw-semibold">Mot de passe</label>
                    <input type="password" class="form-control form-control-lg" id="pswrd" placeholder="••••••••" name="pswrd" required>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill mb-3">Se connecter</button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <p class="text-muted mb-0">Créer un nouvel accès administrateur ?</p>
                <a href="index.php?page=user&action=signUpAdmin" class="text-success fw-bold text-decoration-none">Créer un compte Admin</a>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';

?>

<main class="container">
    <h1>Création de Compte</h1>

    <form action="?page=user&action=addUser" method="post" enctype='multipart/form-data'>
        <div class="mb-3">
            <label for="firstname" class="form-label">Prenom</label>
            <input type="text" class="form-control" id="firstname" name="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
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
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Genre</label>
            <input type="text" class="form-control" id="gender" name="gender">
        </div>
        <div class="mb-3">
            <label for="birthday" class="form-label">Date de Naissance</label>
            <input type="date" class="form-control" id="birthday" name="birthday">
        </div>
        <div class="mb-3">
            <label for="dateCreated" class="form-label">Date de création</label>
            <input type="date" class="form-control" id="dateCreated" name="dateCreated">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo de Profil</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Pays</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
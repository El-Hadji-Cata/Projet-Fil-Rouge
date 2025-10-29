<?php
require_once 'src/view/partial/_head.php';
require_once 'src/view/partial/_header.php';
require_once 'src/view/partial/_alert.php';

?>

<main class="container">
    <h1>Connexion</h1>

    <form action="index.php?page=user&action=signInUsr" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="mb-3">
            <label for="pswrd" class="form-label">Password</label>
            <input type="password" class="form-control" id="pswrd" placeholder="Password" name="pswrd">
        </div>
        <button type="submit" class="btn btn-primary">Se Connecter</button>
    </form>
</main>

<?php
require_once 'src/view/partial/_footer.php';
?>
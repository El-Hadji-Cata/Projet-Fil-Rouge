<?php
// Processing du formulaire de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    // 1. Nettoyage et sécurisation des données reçues
    $firstname = htmlspecialchars(trim($_POST['firstname'] ?? ''));
    $lastname  = htmlspecialchars(trim($_POST['lastname'] ?? ''));
    $email     = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $country   = htmlspecialchars(trim($_POST['country'] ?? ''));
    $tel       = htmlspecialchars(trim($_POST['tel'] ?? ''));
    $message   = htmlspecialchars(trim($_POST['message'] ?? ''));
    $smsOptin  = isset($_POST['sms_optin']) ? 1 : 0;
    $mailOptin = isset($_POST['mail_optin']) ? 1 : 0;

    // 2. Validation basique
    if (!$email || empty($message)) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Veuillez remplir correctement votre e-mail et votre message.'
        ];
    } else {
        // 3. Traitement (Exemple : envoi par mail ou sauvegarde en BDD)
         
        $to = "paomar8@gmail.com";
        $subject = "Nouvelle demande de renseignements - $firstname $lastname";
        $body = "Nom: $firstname $lastname\nEmail: $email\nTél: $tel\nPays: $country\nMessage:\n$message";
        $headers = "From: $email";
        mail($to, $subject, $body, $headers);
        

        // Message de succès affiché via _alert.php
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Votre demande a bien été envoyée ! Notre équipe vous recontactera rapidement.'
        ];

        // Redirection pour éviter de renvoyer le formulaire si l'utilisateur rafraîchit la page (F5)
        header('Location: index.php?page=mission&action=homePage');
        exit();
    }
}

require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
require_once 'src/View/partial/_alert.php';
?>

<main class="container my-5">
    <!-- Section Recherche & Hero -->
    <section class="p-5 mb-5 bg-light rounded-4 shadow-sm text-center">
        <h1 class="display-5 fw-bold text-success mb-3">Éclaireurs Solidaires</h1>
        <p class="lead text-muted mb-4">Trouvez des missions de bénévolat adaptées à vos envies et engagez-vous facilement.</p>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <form class="d-flex gap-2" action="index.php?page=mission&action=listAllMission" method="POST">
                    <input type="text" name="keyword" class="form-control form-control-lg rounded-pill" placeholder="Rechercher une mission...">
                    <button class="btn btn-success btn-lg rounded-pill px-4" type="submit">
                        <i class="fa fa-search me-1" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Section Qui sommes-nous -->
    <section class="my-5 p-4 bg-white rounded-3 shadow-sm border-start border-4 border-success">
        <h2 class="h3 fw-bold text-dark mb-3">Qui sommes-nous ?</h2>
        <p class="text-secondary leading-relaxed mb-0">
            Eclaireurs Solidaires est une association fondée par Claire MONNIER en 2020 à Lyon.
            Son but principal est de faciliter l'engagement bénévole ponctuel ou régulier dans des actions sociales,
            écologiques et culturelles. Ancienne éducatrice spécialisée passionnée par l'engagement citoyen depuis son adolescence,
            elle a développé son réseau de partenaires entre 2020 et 2023.
        </p>
    </section>

    <!-- Section Valeurs / Blocs d'informations -->
    <section class="my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">L'engagement se transforme. Et vous ?</h2>
            <p class="text-muted">Découvrez notre expertise et nos solutions pour accompagner tous les acteurs associatifs. Créons ensemble une société solidaire.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-success mb-3"><i class="fas fa-hand-holding-heart fa-2x"></i></div>
                        <h3 class="h5 card-title fw-bold">Solidarité</h3>
                        <p class="card-text text-muted fs-6">
                            Les actions solidaires sont des initiatives collectives visant à offrir une aide mutuelle aux personnes en situation de besoin pour renforcer les liens communautaires.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-success mb-3"><i class="fas fa-bullhorn fa-2x"></i></div>
                        <h3 class="h5 card-title fw-bold">Engagement</h3>
                        <p class="card-text text-muted fs-6">
                            L'engagement bénévole associatif participe au développement d'une société plus solidaire, attachée à servir l'intérêt général et le bien commun.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-success mb-3"><i class="fas fa-users fa-2x"></i></div>
                        <h3 class="h5 card-title fw-bold">Bénévolat</h3>
                        <p class="card-text text-muted fs-6">
                            Que ce soit pour agir au service des autres ou défendre des causes qui vous tiennent à cœur, le bénévolat est une opportunité unique d'agir.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-success mb-3"><i class="fas fa-tasks fa-2x"></i></div>
                        <h3 class="h5 card-title fw-bold">Missions</h3>
                        <p class="card-text text-muted fs-6">
                            Faire vivre la solidarité au quotidien pour redonner le sourire et permettre à des enfants en difficulté de s'épanouir lors d'activités variées.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulaire de contact -->
    <section class="my-5 p-4 p-md-5 bg-white rounded-4 shadow-sm">
        <div class="row g-4">
            <div class="col-lg-5">
                <h2 class="fw-bold mb-3">Demande de renseignements</h2>
                <p class="text-muted">
                    Notre équipe passionnée est ravie de vous aider à trouver l'opportunité de volontariat idéale pour vos ambitions.
                </p>
            </div>

            <div class="col-lg-7">
                <form action="" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label fw-semibold">Prénom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>

                        <div class="col-md-6">
                            <label for="lastname" class="form-label fw-semibold">Nom de famille</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>

                        <div class="col-12">
                            <label for="mail" class="form-label fw-semibold">Votre email</label>
                            <input type="email" class="form-control" id="mail" name="email" required>
                        </div>

                        <div class="col-12">
                            <label for="tel" class="form-label fw-semibold">Numéro de téléphone</label>
                            <div class="input-group">
                                <select class="form-select" style="max-width: 130px;" id="country" name="country">
                                    <option value="france">FRANCE</option>
                                    <option value="belgique">BELGIQUE</option>
                                    <option value="italie">ITALIE</option>
                                    <option value="espagne">ESPAGNE</option>
                                    <option value="allemagne">ALLEMAGNE</option>
                                    <option value="suisse">SUISSE</option>
                                    <option value="autriche">AUTRICHE</option>
                                    <option value="hors_ue">Hors UE</option>
                                </select>
                                <input type="tel" class="form-control" id="tel" name="tel">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label fw-semibold">Votre message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="sms_optin" name="sms_optin">
                                <label class="form-check-label text-muted" for="sms_optin">
                                    J'accepte de recevoir les communications par SMS
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="mail_optin" name="mail_optin">
                                <label class="form-check-label text-muted" for="mail_optin">
                                    J'accepte de recevoir les communications par mail
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" name="contact_submit" class="btn btn-success btn-lg w-100 rounded-3">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Avis Clients -->
    <section class="my-5">
        <h2 class="text-center fw-bold mb-4">Avis Bénévoles</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <img src="src/public/picture/photo-avis client 3.png" class="rounded-circle mx-auto my-3" alt="David" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text text-muted">"Un outil très adapté aux activités associatives, intuitif et convivial pour trouver de nouvelles missions."</p>
                        <h5 class="fw-bold fs-6">David</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <img src="src/public/picture/photo-avis client 1.png" class="rounded-circle mx-auto my-3" alt="Camille" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text text-muted">"Je vous remercie grandement pour votre aide et votre flexibilité. Vraiment mille mercis."</p>
                        <h5 class="fw-bold fs-6">Camille</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <img src="src/public/picture/photo-avis client 2.png" class="rounded-circle mx-auto my-3" alt="Avis client" style="width: 80px; height: 80px; object-fit: cover;">
                    <div class="card-body">
                        <p class="card-text text-muted">"Un outil intuitif et convivial pour trouver de nouvelles opportunités de volontariat."</p>
                        <h5 class="fw-bold fs-6">Marc</h5>
                        <div class="text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require_once 'src/View/partial/_footer.php';
?>
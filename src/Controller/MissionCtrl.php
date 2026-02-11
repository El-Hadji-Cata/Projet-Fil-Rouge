<?php

class MissionCtrl
{
    public $alertError = null;

    public $alertSuccess = null;

    public $missionModel;

    public $missions;

    public $mission;

    public $thematicModel;

    public $thematics;

    public $city;

    public $country;

    public $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->missionModel = new MissionModel($this->db);
    }

    public function manage()
    {
        $action = filter_input(INPUT_GET, 'action');

        if ($action === 'homePage') {

            $this->home();
        } else if ($action === 'listAllMission') {

            $this->showListMission();
        } else if ($action == 'addMission') {

            $this->addMission();
        } else if ($action === 'missionRegister') {

            $this->toggleDemandMission();
        } else if ($action === 'validateDemand') {

            $this->adminValidate();
        } else {

            $this->page404();
        }
    }

    public function home()
    {
        include 'src/View/home.php';
    }

    public function showListMission()
    {
        // On récupère le mot-clé (on force le type "string")
        $keyword = isset($_POST['keyword']) ? (string)$_POST['keyword'] : null;

        // On récupère l'ID du thème (on force le type "int" pour être sûr que c'est un chiffre)
        $thematicId = isset($_POST['thematic']) ? (int)$_POST['thematic'] : 0;

        if ($keyword || $thematicId) {
            // Si on a des critères, on filtre
            $this->missions = $this->missionModel->searchMissions($keyword, $thematicId);
        } else {
            // Sinon, on affiche tout comme avant
            $this->missions = $this->missionModel->getAll();
        }

        include 'src/View/listMission.php';
    }
    /* public function showListMission()
    {
        $this->missions = $this->missionModel->getAll();
        include 'src/View/listMission.php';
    } */

    public function page404()
    {
        include 'src/View/page404.php';
    }

    public function addMission()
    {
        $this->thematicModel = new ThematicModel($this->db);

        $this->thematics = $this->thematicModel->getAll(true);

        $this->city = $this->missionModel->getCity();

        /*  $this->country = $this->missionModel->getCountry(); */

        if (isset($_POST['title'])) {
            if (
                empty($_POST['title']) ||
                empty($_POST['summary']) ||
                empty($_POST['dateStart']) ||
                empty($_POST['dateStop']) ||
                empty($_POST['nbre']) ||
                empty($_POST['address']) ||
                empty($_POST['time']) ||
                empty($_POST['datePub']) ||
                empty($_POST['category']) ||
                empty($_POST['city'])
            ) {
                $this->alertError = "Veuillez remplir tous les champs !";
            } else {
                $this->missionModel->addMission(
                    $_POST['title'],
                    $_POST['summary'],
                    $_POST['dateStart'],
                    $_POST['dateStop'],
                    $_POST['nbre'],
                    $_POST['address'],
                    $_POST['time'],
                    $_POST['datePub'],
                    $_POST['category'],
                    $_POST['city']
                );

                $this->alertSuccess = "La mission {$_POST['title']} a bien été ajouté :)";
            }
        }

        require_once 'src/View/addMission.php';
    }

    /* public function addDemandMission()
    {

        $idMission = filter_input(INPUT_GET, 'idMission', FILTER_VALIDATE_INT);

        if (!isset($_SESSION['users']['id'])) {
            $this->alertError = "Vous devez être connecté pour postuler.";
            header('Location: index.php?action=login');
            exit;
        }

        if ($idMission) {
            $today = date("Y-m-d H:i:s");
            $userId = $_SESSION['users']['id'];

            if (!$this->missionModel->alreadyApplied($userId, $idMission)) {

                $this->missionModel->addDemandMission(
                    $today,
                    0,      // $validation
                    "",     // $note
                    "",     // $avis
                    $userId,
                    $idMission
                );

                $this->alertSuccess = "Votre candidature a bien été enregistrée !";
            }
        } else {
            $this->alertError = "Mission introuvable.";
        }

        include 'src/View/addDemandMission.php';
    } */
    /* public function toggleMission()
    {
        $idMission = filter_input(INPUT_GET, 'idMission', FILTER_VALIDATE_INT);
        $userId = $_SESSION['users']['id'] ?? null;

        if ($userId && $idMission) {
            if ($this->missionModel->alreadyApplied($userId, $idMission)) {
                $this->missionModel->removeDemandMission($userId, $idMission);
                $this->alertError = "Vous avez déjà postulé à cette mission !";
            } else {
                $today = date("Y-m-d H:i:s");
                $this->missionModel->addDemandMission($today, 0, "", "", $userId, $idMission);
                $this->alertSuccess = "Votre candidature a été envoyée avec succès.";
            }
        }
        header("Location: index.php?page=mission&action=listAllMission");
        exit;
    } */

    public function toggleDemandMission()
    {
        $idMission = filter_input(INPUT_GET, 'idMission', FILTER_VALIDATE_INT);
        $userId = $_SESSION['users']['id'] ?? null;

        if (!isset($_SESSION['users']['id'])) {
            $this->alertError = "Vous devez être connecté pour postuler.";
            header('Location: index.php?page=user&action=signInUser');
            exit;
        }

        if ($userId && $idMission) {
            //je vérifie si l'utilsateur a déja postulé ou non
            if ($this->missionModel->alreadyApplied($userId, $idMission)) {
                $this->missionModel->removeDemandMission($userId, $idMission);
            } else {
                $today = date("Y-m-d H:i:s");
                $this->alertSuccess = "Votre candidature a été envoyée avec succès.";
                $this->missionModel->addDemandMission($today, 0, "", "", $userId, $idMission);
            }
        }

        /* header("Location: index.php?page=mission&action=listAllMission");
        exit; */
        /* include 'src/View/listMission.php'; */
        $this->showListMission();
    }

    public function adminValidate()
    {
        // On vérifie si la session admin existe
        if (!isset($_SESSION['admin'])) {
            $this->alertError = "Accès refusé : cette action nécessite un compte administrateur.";
            $this->home();
            return;
        }

        $idDemand = filter_input(INPUT_GET, 'idDem', FILTER_VALIDATE_INT);
        $idMission = filter_input(INPUT_GET, 'idMiss', FILTER_VALIDATE_INT);

        if ($idDemand && $idMission) {
            // Le modèle effectue la transaction SQL (Validation + Décrémentation)
            $success = $this->missionModel->validateDemand($idDemand, $idMission);

            if ($success) {
                $this->alertSuccess = "Candidature validée ! Le nombre de places disponibles a été mis à jour.";
            } else {
                $this->alertError = "Erreur : La validation a échoué (vérifiez s'il reste des places).";
            }
        }
        $this->showListMission(); // à changer
    }
}

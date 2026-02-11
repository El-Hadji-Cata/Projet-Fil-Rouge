<?php

class UserCtrl
{
    public $alertError = null;

    public $alertSuccess = null;

    public $userModel;
    public $adminModel;
    public $missionModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function manage()
    {
        $action = filter_input(INPUT_GET, 'action');

        if ($action === 'signInUser') { /* USER */

            $this->showSignInUser();
        } else if ($action === 'signUpUser') {

            $this->showSignUpUser();
        } else if ($action === 'addUser') {

            $this->signUpUser();
        } else if ($action === 'signInUsr') {

            $this->signInUser();
        } else if ($action === 'profile') {

            $this->showProfile();
        } else if ($action === 'editProfile') {

            $this->editProfile();
        } else if ($action === 'logOut') {  /* LOGOUT*/

            $this->logOut();
        } else if ($action === 'signInAdmin') { /* ADMIN */

            $this->showSignInAdmin();
        } else if ($action === 'signUpAdmin') {

            $this->showSignUpAdmin();
        } else if ($action === 'addAdmin') {

            $this->signUpAdmin();
        } else if ($action === 'signInAdmn') {

            $this->signInAdmin();
        } else if ($action === 'showDashbord') {

            $this->showAdminDashboard();
        } else if ($action === 'validateDemand') { // NOUVELLE ACTION
            $this->validateDemand();
        } else if ($action === 'rejectDemand') {   // NOUVELLE ACTION
            $this->rejectDemand();
        } else {

            header("Location: index.php");
            exit();
        }
    }

    /*************************** USER *****************************/
    public function signUpUser()
    {
        if (isset($_POST['email'])) {
            if (
                empty($_POST['email']) ||
                empty($_POST['firstname']) ||
                empty($_POST['lastname']) ||
                empty($_POST['pswrd']) ||
                empty($_POST['address']) ||
                empty($_POST['gender']) ||
                empty($_POST['birthday']) ||
                empty($_POST['dateCreated']) ||
                empty($_POST['city']) ||
                empty($_POST['country'])
            ) {

                $this->alertError = "Veuillez remplir tous les champs ! ";
            } else {

                $userEmail = $this->userModel->getUserByEmail($_POST['email']);

                if ($userEmail) {

                    $this->alertError = "Un utilisateur existe déjà avec cet email ! ";
                } else {

                    $pswrdHash = password_hash($_POST['pswrd'], PASSWORD_DEFAULT);

                    $file = null;
                    $uploadOk = false;

                    if (!empty($_FILES['image']['name'])) {
                        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));


                        $uploadOk = true;
                        $now = date("d-m-Y_H-i-s");

                        $targetDir = "public/picture/";
                        $targetFile = $targetDir . $_POST['firstname'] . '-' . $now . "." . $imageFileType;




                        $check = getimagesize($_FILES['image']['tmp_name']);



                        if ($check === false || empty($imageFileType)) {
                            $uploadOk = false;
                            $this->alertError = "Le fichier n'est pas une image !";
                        }

                        if (file_exists($targetFile)) {
                            $uploadOk = false;
                            $this->alertError = "Un fichier du meme nom existe déjà !";
                        }

                        if ($_FILES['image']['size'] > 500000) {
                            $uploadOk = false;
                            $this->alertError = "Le fichier est trop volumineux (max 500ko)  !";
                        }

                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                            $uploadOk = false;
                            $this->alertError = "Uniquement JPG, JPEG ou PNG !";
                        }

                        if ($uploadOk === true) {

                            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                                $file = $_POST['firstname'] . '-' . $now . "." . $imageFileType;
                            } else {
                                $uploadOk = false;
                                $this->alertError = "Echec de l'upload !!";
                            }
                        }
                    }

                    if (!$this->alertError) {

                        $this->userModel->addUser(
                            $_POST['firstname'],
                            $_POST['lastname'],
                            $_POST['email'],
                            $pswrdHash,
                            $_POST['address'],
                            $_POST['gender'],
                            $_POST['birthday'],
                            $_POST['dateCreated'],
                            $file,
                            $_POST['city'],
                            $_POST['country']
                        );

                        $_SESSION['users'] = [

                            'email' => $_POST['email'],
                            'firstname' => $_POST['firstname'],
                            'isAdmin' => 'false'
                        ];

                        $this->alertSuccess = "Le compte a bien été créé :) ";
                    }
                }
            }
        } else {

            $this->alertError = "Veuillez remplir tous les champs ! ";
        }

        require_once 'src/View/signUpUser.php';
    }

    public function signInUser()
    {
        if (isset($_POST['email'])) {
            if (
                empty($_POST['email']) ||
                empty($_POST['pswrd'])
            ) {

                $this->alertError = "Veuillez remplir tous les champs ! ";
            } else {

                try {

                    $user = $this->userModel->getUserByEmail($_POST['email']);
                    $email = $_POST['email'];
                    $pswrd = $_POST['pswrd'];

                    /* var_dump($user); */

                    if (!$user || !password_verify($pswrd, $user['users_password'])) {

                        $this->alertError = "Email ou mot de passe incorrect !";
                    } else {
                        $_SESSION['users'] = [
                            'id' => $user['users_id'],
                            'firstname' =>  $user['users_firstname'],
                            'email' => $email
                        ];

                        header("Location: index.php?page=mission&action=homePage");
                        exit();
                    }
                } catch (PDOException $e) {

                    var_dump("Echec de la connexion au compte" . $e->getMessage());
                }
            }
        } else {

            $this->alertError = "Veuillez remplir tous les champs ! ";
        }

        require_once 'src/View/signInUser.php';
    }

    public function showSignInUser()
    {
        require_once 'src/View/signInUser.php';
    }

    public function showSignUpUser()
    {
        require_once 'src/View/signUpUser.php';
    }

    /*************************** LOGOUT *****************************/
    public function logOut()
    {
        $_SESSION = [];
        session_destroy();

        header("Location: index.php?page=mission&action=homePage");
        exit();
    }

    /*************************** ADMIN *****************************/

    public function signUpAdmin()
    {

        if (isset($_POST['email'])) {
            if (
                empty($_POST['email']) ||
                empty($_POST['name']) ||
                empty($_POST['pswrd']) ||
                empty($_POST['dateCreated'])
            ) {

                $this->alertError = "Veuillez remplir tous les champs ! ";
            } else {

                $adminEmail = $this->userModel->getAdminByEmail($_POST['email']);

                if ($adminEmail) {

                    $this->alertError = "Un Administrateur existe déjà avec cet email ! ";
                } else {

                    $pswrdHash = password_hash($_POST['pswrd'], PASSWORD_DEFAULT);


                    if (!$this->alertError) {

                        $this->userModel->addAdmin(
                            $_POST['name'],
                            $_POST['email'],
                            $pswrdHash,
                            $_POST['dateCreated']
                        );

                        $_SESSION['admin'] = [

                            'email' => $_POST['email'],
                            'name' => $_POST['name'],
                            'isAdmin' => 'true'
                        ];

                        $this->alertSuccess = "Le compte a bien été créé :) ";
                    }
                }
            }
        } else {

            $this->alertError = "Veuillez remplir tous les champs ! ";
        }

        require_once 'src/View/signUpAdmin.php';
    }

    public function signInAdmin()
    {

        if (isset($_POST['email'])) {
            if (
                empty($_POST['name']) ||
                empty($_POST['email']) ||
                empty($_POST['pswrd'])
            ) {

                $this->alertError = "Veuillez remplir tous les champs ! ";
            } else {

                try {

                    $admin = $this->userModel->getAdminByEmail($_POST['email']);
                    $email = $_POST['email'];
                    $pswrd = $_POST['pswrd'];

                    /* var_dump($user); */

                    if (!$admin || !password_verify($pswrd, $admin['admin_password'])) {

                        $this->alertError = "Email ou mot de passe incorrect !";
                    } else {
                        $_SESSION['admin'] = [
                            'id' => $admin['admin_id'],
                            'name' =>  $admin['admin_name'],
                            'email' => $email
                        ];

                        header("Location: index.php?page=mission&action=homePage");
                        exit();
                    }
                } catch (PDOException $e) {

                    var_dump("Echec de la connexion au compte" . $e->getMessage());
                }
            }
        } else {

            $this->alertError = "Veuillez remplir tous les champs ! ";
        }

        require_once 'src/View/signInAdmin.php';
    }

    public function showSignInAdmin()
    {
        require_once 'src/View/signInAdmin.php';
    }

    public function showSignUpAdmin()
    {
        require_once 'src/View/signUpAdmin.php';
    }

    public function showProfile()
    {
        // 1. Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['users']['id'])) {
            header("Location: index.php?page=user&action=signInUser");
            exit();
        }

        $userId = $_SESSION['users']['id'];

        // 2. Récupérer les infos de l'utilisateur (via son email ou ID)
        $userData = $this->userModel->getUserByEmail($_SESSION['users']['email']);

        // 3. Récupérer ses missions
        $userMissions = $this->userModel->getUserMissions($userId);

        require_once 'src/View/userProfile.php';
    }

    public function editProfile()
    {
        if (!isset($_SESSION['users']['id'])) {
            header("Location: index.php?page=user&action=signInUser");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['users']['id'];
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $address = htmlspecialchars($_POST['address']);
            $city = htmlspecialchars($_POST['city']);

            $fileName = null;

            if (!empty($_FILES['image']['name'])) {
                $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $now = date("d-m-Y_H-i-s");

                $targetDir = "src/public/picture/";
                $fileBaseName = $firstname . '-' . $now . "." . $imageFileType;
                $targetFile = $targetDir . $fileBaseName;

                $uploadOk = true;

                // Vérifications
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $uploadOk = false;
                    $this->alertError = "Le fichier n'est pas une image !";
                }

                if ($_FILES['image']['size'] > 500000) {
                    $uploadOk = false;
                    $this->alertError = "Le fichier est trop volumineux (max 500ko) !";
                }

                if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
                    $uploadOk = false;
                    $this->alertError = "Uniquement JPG, JPEG ou PNG !";
                }

                if ($uploadOk === true) {

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $fileName = $fileBaseName;
                    } else {
                        $this->alertError = "Échec de l'upload technique. Vérifiez les droits du dossier public/picture.";
                    }
                }
            }

            $success = $this->userModel->updateUserProfile($id, $firstname, $lastname, $address, $city, $fileName);

            if ($success) {
                $this->alertSuccess = "Profil mis à jour avec succès !";
                $_SESSION['users']['firstname'] = $firstname;
            }
        }

        $this->showProfile();
    }

    public function showAdminDashboard()
    {
        // Vérification de sécurité Admin
        if (!isset($_SESSION['admin'])) {
            header("Location: index.php?page=user&action=signInAdmin");
            exit();
        }

        $allUsers = $this->userModel->getAllUsers();
        $allMissions = $this->userModel->getAllMissions(); // Utilise la méthode ajoutée au modèle
        $pendingDemands = $this->userModel->getDemandsByStatus(0);
        $activeMissions = $this->userModel->getDemandsByStatus(1);
        // 5. Demandes rejetées (validation = 2)
        $rejectedDemands = $this->userModel->getDemandsByStatus(2);

        require_once 'src/View/adminDashboard.php';
    }

    public function validateDemand()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            // On appelle une méthode pour passer le statut à 1
            $this->updateStatus($id, 1);
        }
    }

    public function rejectDemand()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            // On appelle une méthode pour passer le statut à 2 (refusé) ou 0 pour reset
            $this->updateStatus($id, 2);
        }
    }

    private function updateStatus($id, $status)
    {
        // On crée cette méthode rapide dans le modèle pour changer le statut
        $success = $this->userModel->updateDemandStatus($id, $status);

        if ($success) {
            header("Location: index.php?page=user&action=showDashbord");
        } else {
            echo "Erreur lors de la mise à jour du statut.";
        }
        exit();
    }
}

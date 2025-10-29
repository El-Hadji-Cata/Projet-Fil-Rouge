<?php

class UserCtrl
{
    public $alertError = null;

    public $alertSucces = null;

    public $userModel;
    public $adminModel;

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
        } else {

            header("Location : index.php");
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
                        $now = date("d-m-Y H-i-s");

                        $targetDir = "/public/picture/";
                        $targetFile = dirname(__DIR__) . $targetDir . $_POST['firstname'] . '-' . $now . "." . $imageFileType;




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

                        $this->alertSucces = "Le compte a bien été créé :) ";
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

                        $this->alertSucces = "Le compte a bien été créé :) ";
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
}

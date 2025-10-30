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
        } else if($action === 'missionRegister') {

            $this->addDemandMission();
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
        $this->missions = $this->missionModel->getAll();
        include 'src/View/listMission.php';
    }

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

    public function addDemandMission()
    {
        var_dump($_SESSION);

        $this->missionModel->addDemandMission();
        include 'src/View/addDemandMission.php';
    }
}

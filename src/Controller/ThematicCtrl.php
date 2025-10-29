<?php

class ThematicCtrl
{
    public $alertError = null;

    public $alertSuccess = null;

    public $thematics;

    public $thematicModel;

    public function __construct($db)
    {
        $this->thematicModel = new ThematicModel($db);
    }

    public function manage()
    {
        $action = filter_input(INPUT_GET, 'action');

        if ($action === 'show') {

            $this->showThematic();

        } else if ($action === 'addThematic') {

            $this->addThematic();
            
        } else if($action === 'toggle') {

            $this->changeStatutThematic();
        }
    }

    public function showThematic()
    {
        $this->thematics = $this->thematicModel->getAll(true);
        require_once 'src/View/thematic.php';
    }

    public function addThematic()
    {
        if (
            isset($_POST['thematics_missions_name']) &&
            !empty($_POST['thematics_missions_name'])
        ) {
            $thematic_name = htmlspecialchars($_POST['thematics_missions_name'], ENT_QUOTES, 'UTF-8');

            $this->thematicModel->addThematic($thematic_name);
        } else {

            $this->alertError = "Veuillez remplir tous les champs !";
        }

        $this->thematics = $this->thematicModel->getAll(true);

        require_once 'src/View/thematic.php';
    }

    public function changeStatutThematic()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $idThematic = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
            $this->thematicModel->updateStatutThematic($idThematic);

            $this->alertSuccess = "Modification apportée !!";
        }

        $this->thematics = $this->thematicModel->getAll(true);
        require_once 'src/View/thematic.php';
    }
}

<?php

class ThematicModel
{
    private $db;

    public $alertError = null;

    public $alertSuccess = null;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getAll($all = false)
    {
        try {

            $where = $all ? ' ORDER BY thematics_missions_is_activated DESC, thematics_missions_name ASC' : 'WHERE thematics_missions_is_activated = 1';
            $request = $this->db->query("SELECT * FROM  thematics_missions" . $where);
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            return $result;
            
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $this->alertError = "Echec lors de la écuperation de tous les thématics: ";
        }
    }

    public function addThematic($thematicName)
    {
        try {

            $request = $this->db->prepare("INSERT INTO thematics_missions (thematics_missions_name) VALUES (?) ");
            $request->execute([$thematicName]);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec lors de l'ajout d'une thématique de mission !";
        }
    }

    public function updateStatutThematic($id)
    {
        try {

            $request = $this->db->prepare("UPDATE thematics_missions SET thematics_missions_is_activated = NOT thematics_missions_is_activated WHERE thematics_missions_id = ? ");
            $request->execute([$id]);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec lors de l'activation d'une thématique de mission !";
        }
    }
}

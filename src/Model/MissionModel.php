<?php

class MissionModel
{
    private $db;

    public $alertError = null;

    public $alertSuccess = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {

            $request = $this->db->query("SELECT * FROM missions");
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $this->alertError = "Echec de la récupération de toutes les missions !";
        }
    }

    public function addMission(
        $mission_name,
        $mission_description,
        $mission_date_start,
        $mission_date_stop,
        $mission_nbre_volontaries,
        $mission_address,
        $mission_duration_hour,
        $mission_date_publication,
        $id_thematic,
        $id_city
    ) {
        try {

            $request = $this->db->prepare("INSERT INTO missions 
            (missions_name,
            missions_description,
            missions_date_start,
            missions_date_stop,
            missions_nbre_volontaries,
            missions_address,
            missions_duration_hour,
            missions_publication_date,
            id_thematics_missions,
            id_city) VALUES (?,?,?,?,?,?,?,?,?,?) ");

            $request->execute(
                [
                    $mission_name,
                    $mission_description,
                    $mission_date_start,
                    $mission_date_stop,
                    $mission_nbre_volontaries,
                    $mission_address,
                    $mission_duration_hour,
                    $mission_date_publication,
                    $id_thematic,
                    $id_city
                ]
            );
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $this->alertError = "Echec de l'ajout d'une mission";
        }
    }

    public function getCity()
    {
        try {

            $request = $this->db->query("SELECT * FROM city");
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $alertError = "Echec lors de la récupération de toutes les Villes !";
        }
    }
    public function getCountry()
    {
        try {

            $request = $this->db->query("SELECT * FROM country");
            $result = $request->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $alertError = "Echec lors de la récupération de tous les pays !";
        }
    }
}

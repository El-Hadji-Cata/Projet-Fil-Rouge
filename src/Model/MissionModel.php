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
    public function getById()
    {
        /* try {

            $request = $this->db->prepare("SELECT * FROM missions WHERE missions_id = ?");
            $request->execute([])
            $result = $request->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $this->alertError = "Echec de la récupération de toutes les missions !";
        } */
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
            $this->alertError = "Echec lors de la récupération de toutes les Villes !";
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
            $this->alertError = "Echec lors de la récupération de tous les pays !";
        }
    }

    public function addDemandMission(
        $demand_mission_date,
        $demand_mission_validation,
        $demand_mission_note,
        $demand_mission_avis,
        $id_users,
        $id_missions
    ) {
        try {

            $request = $this->db->prepare("INSERT INTO demand_mission ( demand_mission_date, 
                                                                        demand_mission_validation,
                                                                        demand_mission_note,
                                                                        demand_mission_avis,
                                                                        id_users,
                                                                        id_missions
                                                                        ) VALUES (?,?,?,?,?,?) ");
            $request->execute([
                $demand_mission_date,
                $demand_mission_validation,
                $demand_mission_note,
                $demand_mission_avis,
                $id_users,
                $id_missions
            ]);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            $this->alertError = "Echec de l'ajout";
        }
    }

    public function alreadyApplied($userId, $idMission)
{
    // On compte le nombre de lignes correspondant à cet utilisateur pour cette mission
    // Remplacez 'candidature' par le nom réel de votre table de liaison
    $sql = "SELECT COUNT(*) FROM candidature WHERE users_id = :userId AND missions_id = :missionId";
    
    $statement = $this->db->prepare($sql);
    $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $statement->bindValue(':missionId', $idMission, PDO::PARAM_INT);
    $statement->execute();

    // Si le compte est supérieur à 0, l'utilisateur a déjà postulé
    return $statement->fetchColumn() > 0;
}

    public function removeDemandMission($userId, $idMission)
    {
        $request = "DELETE FROM demand_mission WHERE id_users = :userId AND id_missions = :missionId";
        $stmt = $this->db->prepare($request);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':missionId', $idMission, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function validateDemand($idDemand, $idMission)
    {
        try {
            // Début de la transaction
            $this->db->beginTransaction();

            // 1. Passer la validation à 1 dans la table demand_mission
            $sqlValidate = "UPDATE demand_mission SET demand_mission_validation = 1 WHERE id_demand_mission = ?";
            $stmt1 = $this->db->prepare($sqlValidate);
            $stmt1->execute([$idDemand]);

            // 2. Décrémenter le compteur dans la table missions (seulement si > 0)
            $sqlDecrement = "UPDATE missions 
                         SET missions_nbre_volontaries = missions_nbre_volontaries - 1 
                         WHERE missions_id = ? AND missions_nbre_volontaries > 0";
            $stmt2 = $this->db->prepare($sqlDecrement);
            $stmt2->execute([$idMission]);

            // Validation finale de la transaction
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, on annule tout
            $this->db->rollBack();
            var_dump($e->getMessage());
            return false;
        }
    }

    public function searchMissions($keyword, $thematicId)
    {
        $sql = "SELECT * FROM missions WHERE 1=1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (missions_name LIKE ?)";
            $params[] = "%$keyword%";
        }

        if (!empty($thematicId)) {
            $sql .= " AND id_thematics_missions = ?";
            $params[] = $thematicId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

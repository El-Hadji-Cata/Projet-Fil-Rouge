<?php

class UserModel
{
    private $db;
    public $alertError = null;
    public $alertSuccess = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /* --- SECTION USER --- */

    public function addUser($firstname, $lastname, $email, $pswrd, $address, $gender, $birthday, $dateCreated, $image, $city, $country)
    {
        try {
            $request = $this->db->prepare('INSERT INTO users(users_firstname, users_lastname, users_email, users_password, users_address, users_gender, users_birthday, users_date_creation, users_img, users_city, users_country) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $request->execute([$firstname, $lastname, $email, $pswrd, $address, $gender, $birthday, $dateCreated, $image, $city, $country]);
        } catch (PDOException $e) {
            $this->alertError = "Echec de l'ajout de l'Utilisateur : " . $e->getMessage();
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $request = $this->db->prepare('SELECT * FROM users WHERE users_email = ? ');
            $request->execute([$email]);
            return $request->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->alertError = "Echec de la récupération de l'utilisateur : " . $e->getMessage();
        }
    }

    public function updateUserProfile($id, $firstname, $lastname, $address, $city, $image)
    {
        try {
            if ($image) {
                $sql = "UPDATE users SET users_firstname = ?, users_lastname = ?, users_address = ?, users_city = ?, users_img = ? WHERE users_id = ?";
                $params = [$firstname, $lastname, $address, $city, $image, $id];
            } else {
                $sql = "UPDATE users SET users_firstname = ?, users_lastname = ?, users_address = ?, users_city = ? WHERE users_id = ?";
                $params = [$firstname, $lastname, $address, $city, $id];
            }
            $request = $this->db->prepare($sql);
            return $request->execute($params);
        } catch (PDOException $e) {
            $this->alertError = "Erreur lors de la mise à jour : " . $e->getMessage();
            return false;
        }
    }

    /* --- SECTION ADMIN AUTH --- */

    public function addAdmin($name, $email, $pswrd, $dateCreated)
    {
        try {
            $request = $this->db->prepare("INSERT INTO admin (admin_name, admin_email, admin_password, admin_date_creation) VALUES (?,?,?,?)");
            $request->execute([$name, $email, $pswrd, $dateCreated]);
        } catch (PDOException $e) {
            $this->alertError = "Echec de l'ajout de l'Administrateur : " . $e->getMessage();
        }
    }

    public function getAdminByEmail($email)
    {
        try {
            $request = $this->db->prepare("SELECT * FROM admin WHERE admin_email = ?");
            $request->execute([$email]);
            return $request->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->alertError = "Echec de la récupération de l'admin : " . $e->getMessage();
        }
    }

    /* --- SECTION DASHBOARD & MISSIONS --- */

    public function getUserMissions($userId)
    {
        $sql = "SELECT m.*, dm.demand_mission_validation 
                FROM missions m
                JOIN demand_mission dm ON m.missions_id = dm.id_missions
                WHERE dm.id_users = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY users_id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMissions()
    {
        $sql = "SELECT * FROM missions ORDER BY missions_id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDemandsByStatus($status)
    {
        // On sélectionne les colonnes essentielles sans deviner le nom de l'ID de la table pivot
        $sql = "SELECT 
                dm.demand_mission_id,
                u.users_firstname, 
                u.users_lastname, 
                u.users_email,
                m.missions_name,
                m.missions_id,
                dm.demand_mission_validation,
                dm.id_users,
                dm.id_missions,
                dm.demand_mission_date
            FROM demand_mission dm
            JOIN users u ON dm.id_users = u.users_id
            JOIN missions m ON dm.id_missions = m.missions_id
            WHERE dm.demand_mission_validation = :status";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(['status' => $status]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Cela nous permettra de voir l'erreur exacte si une autre colonne manque
            echo "Erreur SQL : " . $e->getMessage();
            return [];
        }
    }
    

    public function updateDemandStatus($id, $status)
    {
        try {
            // Remplace 'id_demand_mission' par le nom exact de ta clé primaire
            $sql = "UPDATE demand_mission SET demand_mission_validation = ? WHERE demand_mission_id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}

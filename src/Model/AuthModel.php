<?php

class AuthModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Récupérer un compte par email avec son rôle
    public function getUserByEmail($email) {
        $query = "SELECT a.*, r.roles_name 
                  FROM auth a 
                  LEFT JOIN roles r ON a.id_roles = r.roles_id 
                  WHERE a.auth_email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer le profil complet (User ou Admin) selon id_auth
    public function getProfileByAuthId($authId, $roleName) {
        if (strtolower($roleName) === 'admin') {
            $query = "SELECT * FROM admin WHERE id_auth = :id_auth";
        } else {
            $query = "SELECT * FROM users WHERE id_auth = :id_auth";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id_auth' => $authId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
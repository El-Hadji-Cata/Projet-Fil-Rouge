<?php
class MessageModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    // Récupère toute la conversation entre un utilisateur précis et un admin précis
    public function getConversation($idUsers, $idAdmin)
    {
        $query = "SELECT * FROM message 
                  WHERE id_users = :id_users AND id_admin = :id_admin 
                  ORDER BY message_date ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':id_users' => $idUsers,
            ':id_admin' => $idAdmin
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insère un nouveau message
    public function sendMessage($idUsers, $idAdmin, $content, $isAdminSender = 0)
    {
        $query = "INSERT INTO message (message_date, message_admin, message_content, id_users, id_admin) 
                  VALUES (NOW(), :message_admin, :message_content, :id_users, :id_admin)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':message_admin'   => $isAdminSender, // 1 si admin, 0 si utilisateur
            ':message_content' => $content,
            ':id_users'        => $idUsers,
            ':id_admin'        => $idAdmin
        ]);
    }

    // Récupère la liste de tous les utilisateurs ayant un échange (pour le dashboard Admin)
    public function getUsersWithMessages()
    {
        $query = "SELECT DISTINCT u.id_users, u.firstname, u.lastname 
                  FROM users u 
                  INNER JOIN message m ON u.id_users = m.id_users 
                  ORDER BY m.message_date DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer le premier ID admin disponible dans la BDD
    public function getDefaultAdminId()
    {
        $query = "SELECT admin_id FROM admin LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['admin_id'] : null;
    }

    // Récupère le dernier utilisateur ayant échangé un message
    public function getLastUserWithMessages()
    {
        $query = "SELECT id_users FROM message ORDER BY message_date DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère la liste de tous les utilisateurs ayant échangé des messages
    public function getAllUsersWithMessages()
    {
        $query = "SELECT DISTINCT u.users_id AS id_users, u.users_firstname AS firstname, u.users_lastname AS lastname 
              FROM users u 
              INNER JOIN message m ON u.users_id = m.id_users 
              ORDER BY m.message_date DESC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Compter les messages reçus non lus (ou le total des messages reçus de l'interlocuteur)
    public function countUnreadMessages($userId, $adminId, $isAdmin)
    {
        if ($isAdmin) {
            // Compte uniquement les messages d'utilisateurs NON LUS
            $query = "SELECT COUNT(*) FROM message WHERE message_admin = 0 AND is_read = 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        } else {
            if (!$userId) return 0;
            // Compte uniquement les messages admin NON LUS pour cet utilisateur
            $query = "SELECT COUNT(*) FROM message WHERE message_admin = 1 AND id_users = :id_users AND is_read = 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id_users' => $userId]);
        }

        return (int) $stmt->fetchColumn();
    }

    public function markAsRead($idUsers, $isAdmin)
    {
        if ($isAdmin) {
            // L'admin lit les messages de cet utilisateur
            $query = "UPDATE message SET is_read = 1 WHERE id_users = :id_users AND message_admin = 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id_users' => $idUsers]);
        } else {
            // L'utilisateur lit les messages de l'admin
            $query = "UPDATE message SET is_read = 1 WHERE id_users = :id_users AND message_admin = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id_users' => $idUsers]);
        }
    }
}

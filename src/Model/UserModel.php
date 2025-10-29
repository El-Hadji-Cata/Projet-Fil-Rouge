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

    /* USER */
    public function addUser(
        $firstname,
        $lastname,
        $email,
        $pswrd,
        $address,
        $gender,
        $birthday,
        $dateCreated,
        $image,
        $city,
        $country
    ) {

        try {

            $request = $this->db->prepare('INSERT INTO users(
                                                        users_firstname,
                                                        users_lastname, 
                                                        users_email, 
                                                        users_password, 
                                                        users_address, 
                                                        users_gender, 
                                                        users_birthday, 
                                                        users_date_creation, 
                                                        users_img,
                                                        users_city,
                                                        users_country) VALUES (?,?,?,?,?,?,?,?,?,?,?)');


            $request->execute([
                $firstname,
                $lastname,
                $email,
                $pswrd,
                $address,
                $gender,
                $birthday,
                $dateCreated,
                $image,
                $city,
                $country
            ]);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec de l'ajout de l'Utilisateur" . $e->getMessage();
        }
    }

    public function getUserByEmail($email)
    {
        try {

            $request = $this->db->prepare('SELECT * FROM users WHERE users_email = ? ');
            $request->execute([$email]);
            $result = $request->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec de la récupération de l'email de l'utilisateur" . $e->getMessage();
        }
    }

    /* ADMIN */
    public function addAdmin(
        $name,
        $email,
        $pswrd,
        $dateCreated,
    ) {

        try {

            $request = $this->db->prepare("INSERT INTO admin (
                                                        admin_name,
                                                        admin_email, 
                                                        admin_password, 
                                                        admin_date_creation
                                                         ) VALUES (?,?,?,?)");


            $request->execute([
                $name,
                $email,
                $pswrd,
                $dateCreated,
            ]);
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec de l'ajout de l'Administrateur" . $e->getMessage();
        }
    }

    public function getAdminByEmail($email)
    {
        try {

            $request = $this->db->prepare("SELECT * FROM admin WHERE admin_email = ?");
            $request->execute([$email]);
            $result = $request->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {

            var_dump($e->getMessage());
            $this->alertError = "Echec de la récupération de l'email de l'Administrateur" . $e->getMessage();
        }
    }
}

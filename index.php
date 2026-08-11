<?php
session_start();

/* var_dump($_SESSION); */

require_once 'src/Controller/MessageCtrl.php';
require_once 'src/Controller/MissionCtrl.php';
require_once 'src/Controller/ThematicCtrl.php';
require_once 'src/Controller/UserCtrl.php';

require_once 'src/Model/MessageModel.php';
require_once 'src/Model/MissionModel.php';
require_once 'src/Model/ThematicModel.php';
require_once 'src/Model/UserModel.php';

// NOUVEAU CODE
$host     = getenv('DB_HOST')     ?: 'localhost';
$dbname   = getenv('DB_NAME')     ?: 'les_eclaireurs_solidaires'; // Mettez le nom exact de votre BDD XAMPP
$user     = getenv('DB_USER')     ?: 'root';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

/*
$host = 'localhost';
$dbname = 'eclaireurs_solidaires';
$user = 'root';
$password = '';

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $user,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    
    die("Echec connexion à la BDD" . $e->getMessage());
}*/

$page = filter_input(INPUT_GET, 'page');

$router = [
    "user" => UserCtrl::class,
    "thematic" => ThematicCtrl::class,
    "mission" => MissionCtrl::class,
    "message" => MessageCtrl::class
];

$controller = null;

foreach ($router as $routerValue => $className) {
    if ($page == $routerValue) {
        $controller = new $className($db);
        $controller->manage();
    }
}

if (!$controller) {
    include 'src/View/page404.php';
}

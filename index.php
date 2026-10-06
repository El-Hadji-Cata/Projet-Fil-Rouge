<?php
session_start();

require_once 'src/Controller/MessageCtrl.php';
require_once 'src/Controller/MissionCtrl.php';
require_once 'src/Controller/ThematicCtrl.php';
require_once 'src/Controller/UserCtrl.php';

require_once 'src/Model/MessageModel.php';
require_once 'src/Model/MissionModel.php';
require_once 'src/Model/ThematicModel.php';
require_once 'src/Model/UserModel.php';

$config = require __DIR__ . '/config.php';

try {
    $db = new PDO(
        "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4",
        $config['username'],
        $config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Échec de connexion à la BDD : " . $e->getMessage());
}

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
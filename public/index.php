<?php
session_start();

# chemins vers Twig
use Twig\Loader\FilesystemLoader;
use Twig\Environment;


// dependencies
require_once "../config.php";

// Personal autoload
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require '../' .$class . '.php';
});

// autoload from composer
require_once "../vendor/autoload.php";

// twig
# chemin vers le dossier des templates
$loader = new FilesystemLoader('../view');
# instanciation de l'environnement Twig
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true
]);

// db connection
try {
    $pdo = new PDO(
        DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET . ';port=' . DB_PORT,
        DB_LOGIN,
        DB_PWD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// router

include "../controller/publicController.php";

// close connection (portabilité hors MySQL, mettre en commentaire en cas de connexion permanente)
$pdo = null;
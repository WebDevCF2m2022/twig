<?php
// public/index.php

session_start();

# chemins vers Twig avec use (ne charge pas sans require ou include)
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\String\StringExtension;


// dependencies
require_once "../config.php";

// Personal autoload -> MyModels
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require '../' .$class . '.php';
});

// autoload from composer -> Twig
require_once "../vendor/autoload.php";

// twig
# chemin vers le dossier des templates (que l'on a choisit)
$loader = new FilesystemLoader('../view');
# instanciation de l'environnement Twig
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true
]);
# activation du debug (pour les dump par exemple)
$twig->addExtension(new DebugExtension());
# activation de l'extension String : après installation de twig-extensions via composer : https://packagist.org/packages/twig/string-extra
$twig->addExtension(new StringExtension());

// db connection
try {
    $pdo = new PDO(
        DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET . ';port=' . DB_PORT,
        DB_LOGIN,
        DB_PWD,
        [
            // gestion des erreurs
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // mode de récupération par défaut : FETCH_ASSOC
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// router
// contrôleur public
include "../controller/publicController.php";

// close connection (portabilité hors MySQL, mettre en commentaire en cas de connexion permanente)
$pdo = null;
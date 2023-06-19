<?php
session_start();


// dependencies
require_once "../config.php";

// Personal autoload
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require '../' .$class . '.php';
});

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

$a = new \MyModels\Mapping\permissionMapping(['idpermission' => 1, 'permissionname' => 'test', 'permissionrole' => 5]);

var_dump($a);

$b = new \MyModels\Manager\permissionManager($pdo);

var_dump($b->permissionSelectAll());

// close connection (portabilité hors MySQL, mettre en commentaire en cas de connexion permanente)
$pdo = null;
<?php 

use MyModels\Manager\theuserManager;

$theuserManager = new theuserManager($pdo);

echo 'controlleur privé';

var_dump($_SESSION);

if(isset($_GET['p']) && $_GET['p']=='deconnect'){
    $theuserManager->disconnect();
    header("location: ./");
}

?>

<form action="" method="get">
    <button><a href="?p=deconnect">Deconnect</a></button>
</form>
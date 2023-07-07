<?php 
var_dump($_SESSION);

use MyModels\Manager\theuserManager;
$theuserManager = new theuserManager($pdo);

// pour se déconnecter
if(isset($_GET['p']) && $_GET['p']=='deconnect'){
    $theuserManager->disconnect();
    header("location: ./");
}

?>

<!-- bouton déconnection :  -->
<form action="" method="get">
    <button><a href="?p=deconnect">Deconnect</a></button>
</form>
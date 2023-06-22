<?php

use MyModels\Manager\thesectionManager;

$thesectionManager = new thesectionManager($pdo);

try {
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}


// Path: controller\publicController.php
echo $twig->render("public/public_homepage.html.twig", [
    "mesSections" => $thesection
]);
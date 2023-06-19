<?php

use MyModels\Manager\thesectionManager;

$thesectionManager = new thesectionManager($pdo);

$thesection = $thesectionManager->SelectAllThesection();


// Path: controller\publicController.php
echo $twig->render("public/public_homepage.html.twig", [
    "mesSections" => $thesection
]);
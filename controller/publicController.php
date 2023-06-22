<?php

use MyModels\Manager\thesectionManager;
use MyModels\Manager\thearticleManager;

$thesectionManager = new thesectionManager($pdo);
$thearticleManager = new thearticleManager($pdo);

if(isset($_GET['articlesSlug'])){
    echo $_GET['articlesSlug'];
}elseif(isset($_GET['sectionsSlug'])){
    echo $_GET['sectionsSlug'];
}else {

    try {
        $thesection = $thesectionManager->SelectAllThesection();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
    try {
        $thearticle = $thearticleManager->thearticleSelectAll();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }


// Path: controller\publicController.php
    echo $twig->render("public/public_homepage.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "mesArticles" => $thearticle,
    ]);
}
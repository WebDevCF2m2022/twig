<?php

use MyModels\Manager\thesectionManager;
use MyModels\Manager\thearticleManager;

$thesectionManager = new thesectionManager($pdo);
$thearticleManager = new thearticleManager($pdo);

// menu pour toute la partie publique
try {
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if(isset($_GET['articlesSlug'])){
    echo $_GET['articlesSlug'];
}elseif(isset($_GET['sectionsSlug'])){
    $mesArticlesSection = $thearticleManager->thearticleSelectOneBySlug($_GET['sectionsSlug']);
    echo $twig->render("public/public_thesection.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "mesArticles" => $mesArticlesSection,
        "racine" => MyURL
    ]);
}else {


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
        "racine" => MyURL
    ]);
}
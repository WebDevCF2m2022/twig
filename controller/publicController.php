<?php
// Path: controller\publicController.php

# chemin vers le manager de thesection
use MyModels\Manager\thesectionManager;
# chemin vers le manager de thearticle
use MyModels\Manager\thearticleManager;

# instanciation du manager de thesection
$thesectionManager = new thesectionManager($pdo);
# instanciation du manager de thearticle
$thearticleManager = new thearticleManager($pdo);

// menu pour toute la partie publique
try {
    # récupération de toutes les sections pour le menu
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}


if(isset($_GET['articlesSlug'])){
    echo $_GET['articlesSlug'];
}elseif(isset($_GET['sectionsSlug'])){

    $maSection = $thesectionManager->SelectOneThesectionBySlug($_GET['sectionsSlug']);
    $idSection = $maSection['idthesection'];
    $mesArticlesSection = $thearticleManager->thearticleSelectAllFromSection($idSection);

    echo $twig->render("public/public_thesection.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "maSection" => $maSection,
        "mesArticles" => $mesArticlesSection,
        "racine" => MY_URL
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
        "racine" => MY_URL
    ]);
}
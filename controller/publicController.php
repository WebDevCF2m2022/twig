<?php
// Path: controller\publicController.php

# chemin vers le manager de thesection
use MyModels\Manager\thesectionManager;
# chemin vers le manager de thearticle
use MyModels\Manager\thearticleManager;
use MyModels\Manager\searchManager;
use MyModels\Manager\theuserManager;
use MyModels\Mapping\TheuserMapping;

# instanciation du manager de thesection
$thesectionManager = new thesectionManager($pdo);
# instanciation du manager de thearticle
$thearticleManager = new thearticleManager($pdo);
$thesearchManager = new searchManager($pdo);
$theuserManager = new theuserManager($pdo);


// menu pour toute la partie publique
try {
    # récupération de toutes les sections pour le menu
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}

$erreur = "";
if(isset($_POST['theuserlogin'], $_POST['theuserpwd'])){

    $login = new TheuserMapping([
        "theuserlogin" => $_POST['theuserlogin'],
        "theuserpwd" => $_POST['theuserpwd'],
    ]);
    
    try{
        $connect = $theuserManager->theuserConnectByLoginAndPwd($login);
    }catch(Exception $e){
        $erreur = $e->getMessage();
    }

    if($connect){
        header("location: ./");
    }else{
        $erreur = "Une erreur est survénue, vous n'êtes pas connecté ! ";
    }
}

# Nous sommes sur un article
if(isset($_GET['articlesSlug'])){
        $monArticle = $thearticleManager->thearticleSelectOneBySlug($_GET['articlesSlug']);

        echo $twig->render("public/public_thearticle.html.twig", [
            // passage des sections et des articles à la vue
            "mesSections" => $thesection,
            "monArticle" => $monArticle,
            "racine" => MY_URL
        ]);
# Nous sommes sur une section
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
# Nous voulons nous connecter
}elseif(isset($_GET['connect'])){
    // nous sommes ici, préparation de la vue
    echo $twig->render("public/public_connect.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "erreur" => $erreur,
        "racine" => MY_URL
    ]);
# Nous sommes sur la page d'accueil
} elseif(isset($_GET['q'])) { // suppose que 'q' est le paramètre de recherche dans l'URL

    $query = $_GET['q'];

    $articles = $thesearchManager->thesearchSelectAllBySearch($query);

    $users = $thesearchManager->thesearchSelectAllBySearchUser($query);

    echo $twig->render("public/public_search.html.twig", [
        // passage des sections, des articles et des utilisateurs à la vue
        "mesSections" => $thesection,
        "mesArticles" => $articles,
        "mesUsers" => $users,
        "racine" => MY_URL,
        "q" => $query
    ]);
} else {


    try {
        $thearticle = $thearticleManager->thearticleSelectAll();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }


    echo $twig->render("public/public_homepage.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "mesArticles" => $thearticle,
        "racine" => MY_URL
    ]);
}


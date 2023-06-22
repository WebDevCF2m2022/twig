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

try {
    # récupération de toutes les sections pour le menu
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}

if(isset($_GET['SlugSection'])){
    echo $_GET['SlugSection'];
}elseif(isset($_GET['SlugArticle'])){
    echo $_GET['SlugArticle'];
}else {

    try {
        # récupération de tous les articles pour la page d'accueil
        $thearticle = $thearticleManager->thearticleSelectAll();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

// affichage de la vue qui est de l'environnement twig avec la méthode render et le chemin (il va chercher dans le dossier view)
    echo $twig->render("public/public_homepage.html.twig", [
        // transmission de données à la vue
        "mesSections" => $thesection, // pour le menu
        "mesArticles" => $thearticle, // articles pour la page d'accueil
        "base_url" => MY_URL, // pour les liens
    ]);
}
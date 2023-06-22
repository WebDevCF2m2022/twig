<?php
// Path: controller\publicController.php

# chemin vers le manager de thesection
use MyModels\Manager\thesectionManager;

# instanciation du manager de thesection
$thesectionManager = new thesectionManager($pdo);

try {
    # récupération de toutes les sections pour le menu
    $thesection = $thesectionManager->SelectAllThesection();
} catch (Exception $e) {
    $error = $e->getMessage();
}


// affichage de la vue qui est de l'environnement twig avec la méthode render et le chemin (il va chercher dans le dossier view)
echo $twig->render("public/public_homepage.html.twig", [
    // transmission de données à la vue
    "mesSections" => $thesection, // pour le menu
    "base_url" => MY_URL, // pour les liens
]);
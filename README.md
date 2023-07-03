# Twig

## Moteur de Template Twig


`Twig` est un moteur de modèles `PHP` moderne conçu pour être rapide, sécurisé et flexible. Il a été créé par SensioLabs, les créateurs du `framework Symfony`, pour être utilisé avec Symfony, mais il peut également être utilisé de `manière autonome` ou avec d'autres frameworks PHP.

### Fonctionnalités de Twig

`Syntaxe claire et concise` : Twig utilise une syntaxe simple et lisible qui facilite la création de modèles.

`Sécurité` : Twig protège vos applications contre les attaques XSS (Cross-Site Scripting) grâce à son système d'échappement automatique des données.

`Héritage de modèles` : vous pouvez étendre et remplacer des parties spécifiques de vos modèles grâce au mécanisme d'héritage de Twig.

`Filtres et fonctions` : Twig propose de nombreux filtres intégrés et permet de définir vos propres fonctions pour manipuler les données de manière flexible.

`Boucles et conditions` : vous pouvez utiliser des boucles et des conditions pour effectuer des opérations répétitives ou conditionnelles dans vos modèles.

`Extensions` : Twig offre un système d'extensions qui vous permet d'ajouter de nouvelles fonctionnalités et de personnaliser le comportement du moteur de template.

## Installation

Installez d'abord `Composer` qu'on peut trouver à cette adresse :

https://getcomposer.org/download/

Puis dans l'invite de commande du projet :

```bash
composer require "twig/twig:^3.0"
```

La documentation complète se trouve à cette adresse :

https://twig.symfony.com/doc/3.x/intro.html

Il est important de garder le composer.json pour pouvoir installer les dépendances du projet.

On met le dossier `vendor` dans le `.gitignore` pour ne pas le mettre sur le dépôt.

## Utilisation

Pour utiliser `Twig` dans notre projet, il faut d'abord créer un dossier `view` à la racine du projet (ou un autre dossier de votre choix).

Dans ce dossier, on va créer un fichier `base.html.twig` qui va contenir le squelette de notre site.

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}{% endblock %}</title>
    {% block stylesheets %}{% endblock %}
</head>
<body>
    {% block body %}{% endblock %}
    {% block javascripts %}{% endblock %}
</body>
</html>
```

### Appel de Twig

Pour utiliser `Twig` dans notre projet, on va le charger dans notre contrôleur frontal : `public/index.php` , grâce à l'autoload de `Composer`.

On va également utiliser les `namespaces` pour pouvoir appeler `Twig` dans notre projet avec les `use`.

```php
<?php
// public/index.php

# ...

# chemins vers Twig
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

# ...

// autoload from composer
require_once "../vendor/autoload.php";

# ...

// twig
# chemin vers le dossier des templates
$loader = new FilesystemLoader('../view');
# instanciation de l'environnement Twig
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true
]); // false pour le cache et true pour le debug

# ...

``` 

Puis dans un contrôleur comme `controller/publicController.php`, avec un exemple de page d'accueil :

```php
<?php
// Path: controller\publicController.php

# ...

echo $twig->render("public/public_homepage.html.twig", [
        // passage des sections et des articles à la vue
        "mesSections" => $thesection,
        "mesArticles" => $thearticle,
        "racine" => MY_URL
    ]);

# ...

```



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

### Utilisation de Twig

#### Le système de blocs et d'héritage

Dans notre fichier `base.html.twig`, on a créé des blocs `{% block %}{% endblock %}` qui vont nous permettre d'insérer du contenu dans notre squelette.

On peut ensuite en hériter dans nos autres fichiers `Twig` avec `{% extends %}`. 

**Attention**, on ne peut hériter que d'un seul fichier `Twig` à la fois, et les **balises html (texte en général) doivent être mises dans des blocs dès que l'on a un fichier parent**.

On peut également hériter de plusieurs niveaux de fichiers `Twig` en utilisant `{% extends %}` dans un fichier `Twig` qui hérite déjà d'un autre fichier `Twig` :

`public_homepage.html.twig` hérite de `template.html.twig` qui hérite de `base.html.twig` :

```html
{# public_homepage.html.twig #}
{% extends "base.html.twig" %}

{# Pour hériter du titre du parent, on peut utiliser {{ parent() }} #}
{% block title %}{{ parent() }} Accueil{% endblock %}

{% block body %}
    {# on peut mettre du contenu ici #}

        {# on peut aussi créer de blocs enfants dans le bloc body,
        mais jamais en dehors d'un bloc parent ! #}
        {% block section %}
            <h1>Accueil</h1>
            <p>Bienvenue sur mon site</p>
        {% endblock %}
    <h1>Accueil</h1>
    <p>Bienvenue sur mon site</p>
{% endblock %}
```

Si un bloc n'est pas défini dans le fichier `Twig` qui hérite, il prendra le contenu du bloc du fichier parent.

Sinon, il l'écrasera. On peut néanmoins récupérer le contenu du bloc parent avec `{{ parent() }}`.

#### Les variables

Pour passer des variables à notre fichier `Twig`, on utilise un tableau associatif dans le `render()` de notre contrôleur :

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

On peut ensuite les utiliser dans notre fichier `Twig` avec `{{ }}` :

```html
{% extends "base.html.twig" %}

{% block title %}{{ parent() }} Accueil{% endblock %}

{% block body %}
    <p>La racine de mon site est : {{ racine }}</p>
{% endblock %}
```

#### Les boucles

On peut utiliser des boucles dans nos fichiers `Twig` avec `{% for %}` :

```html
{% extends "base.html.twig" %}

{% block title %}{{ parent() }} Accueil{% endblock %}

{% block body %}
    <p>La racine de mon site est : {{ racine }}</p>
    <ul>
        {% for section in mesSections %}
            <li>{{ section.name }}</li>
        {% endfor %}
    </ul>
{% endblock %}
```
### Pour utiliser le débogage

vous devez activer le débogage dans l'environnement Twig :

```php

# chemin vers le dossier des templates (que l'on a choisit)
$loader = new FilesystemLoader('../view');
# instanciation de l'environnement Twig
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true, // activation du debug
]);
# activation complète du debug (pour les dump par exemple)
$twig->addExtension(new DebugExtension());

```

On peut maintenant utiliser le {{ dump(variable) }} dans nos vues pour voir si sa valeur est correcte.

Par exemple dans `view/public/public_thearticle.html.twig` :

```html
{% block articles %}
<div class="row">
    <div class="col-lg-12">
        <h2 class="fw-bolder">{{ monArticle.thearticletitle }}</h2>
        <h3>Par {{ monArticle.theuserlogin }} le {{ monArticle.theuserdate|date("d/m/Y \à H") }}h</h3>
        <hr>
        {{ dump(monArticle) }}
        {% set sectionTitle = monArticle.thesectiontitle|split('|||') %}
        {% set sectionslug = monArticle.thesectionslug|split('|||') %}
        {% set sectionslug = monArticle.thesectionslug|split('|||') %}
        <p>
            {% for key, section in sectionTitle %}
            <a href="./sections/{{ sectionslug[key] }}" class="badge bg-secondary text-decoration-none link-light">{{ section }}</a>
            {% endfor %}
        </p>
        <hr>
        <p>{{ monArticle.thearticletext|nl2br }}</p>
    </div>
    <hr>
</div>


{% endblock %}
```
On pourra simplement le commenter par la suite.

Vous voyez dans ce code quelques fonctions Twig supplémentaires :

- `set` : permet de créer une variable dans un fichier `Twig`. Ici, on crée deux variables `sectionTitle` et `sectionslug` qui sont des tableaux.
- `split()` : permet de séparer une chaîne de caractères en un tableau, en utilisant un séparateur (ici `|||`).
- `nl2br()` : permet de remplacer les retours à la ligne par des `<br>`.
- `date()` : permet de formater une date. Ici, on affiche le jour, le mois, l'année et l'heure.

### Pour utiliser les filtres

Les filtres permettent de modifier une variable dans un fichier `Twig`.

Pour ne pas couper les mots au milieur des phrases :

```bash
composer require twig/string-extra
````

```html
{{ item.thearticleresume|u.truncate(120, '...', false) }}   
```

Les types de filtres :

https://twig.symfony.com/doc/3.x/filters/index.html
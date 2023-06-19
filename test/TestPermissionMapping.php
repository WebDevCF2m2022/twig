<?php
namespace test;

use Exception;

use MyModels\Mapping\PermissionMapping;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require '../' .$class . '.php';
});

// création d'un objet PermissionMapping sans paramètre (pas d'hydratation)
$a = new PermissionMapping([]);
?>
 <code>$a = new PermissionMapping([]);<br>
     echo $a; // Appel du __toString, qui est obligatoire pour l'abstract parent de PermissionMapping<br>
        // Affiche le nom de la classe : return self::class;
 </code><br>
<?php

// Appel du __toString, qui est obligatoire pour l'abstract parent de PermissionMapping
echo $a;
?>
<h3>Nous utilisons les fluents setters</h3>
<p>C'est à dire qu'on peut mettre les setters les un derrières les autres car on à l'objet retourné après chaque
    affectation : return $this;</p>
<code>$a->setIdpermission(5)
    ->setPermissionname("test")
    ->setPermissionrole(1);</code>
<?php
$a->setIdpermission(5)->setPermissionname("test")
    ->setPermissionrole(1);

var_dump($a);
?>
<h3>On peut aussi utiliser les getters pour afficher</h3>
<code>echo $a->getIdpermission();</code>
<?php
echo $a->getIdpermission();
?>
<h3>hydratation avec un tableau clef->valeurs</h3>
<code>$b = new PermissionMapping([
    "idpermission" => 1,
    "permissionname" => "test",
    "permissionrole" => 1
    ]);</code>
<?php
$b = new PermissionMapping([
    "idpermission" => 1,
    "permissionname" => "mon test",
    "permissionrole" => 1
]);
var_dump($b);
?>
<h3>Vérification d'une erreur prévisible</h3>
<code>$c = new PermissionMapping([
    "idpermission" => 2,
    "permissionname" => "mon test qui dépasse 45 caractèresmon test qui dépasse 45 caractèresmon test qui dépasse 45 caractèresmon test qui dépasse 45 caractères",
    "permissionrole" => 8
]);</code><br>
<h3>Erreur de type, n'est capté par le try catch car dans les paramètres (int $idpermission)</h3>
<?php
try {
    $c = new PermissionMapping([
        "idpermission" => 2,
        "permissionname" => "mon test qui dépasse 45 caractèresmon test qui dépasse 45 caractèresmon test qui dépasse 45 caractèresmon test qui dépasse 45 caractères",
        "permissionrole" => 8
    ]);
}catch (Exception $e){
    echo $e->getMessage();
}

try {
    $d = new PermissionMapping([
        "idpermission" => "lala",
        "permissionname" => "coucou",
        "permissionrole" => 8
    ]);
}catch (Exception $e){
    echo $e->getMessage();
}



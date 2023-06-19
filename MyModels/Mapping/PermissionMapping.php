<?php

namespace MyModels\Mapping;
use MyModels\Abstract\AbstractMapping;
use Exception;
class PermissionMapping extends AbstractMapping
{
    // Propriétés
    private int $idpermission;
    private string $permissionname;
    private int $permissionrole;

    // Getters

    public function getIdpermission(): int
    {
        return $this->idpermission;
    }

    public function getPermissionname(): string
    {
        return $this->permissionname;
    }

    public function getPermissionrole(): int
    {
        return $this->permissionrole;
    }

    // Setters

    public function setIdpermission(int $idpermission): PermissionMapping
    {
        $this->idpermission = $idpermission;
        return $this;
    }

    public function setPermissionname(string $permissionname): PermissionMapping
    {
        // dépasse 45 caractères
        if(strlen($permissionname)>45){
            // affichage de l'erreur
            throw new Exception("Le nom de la permission ne doit pas dépasser 45 caractères");
            return $this;
        }else {
            $this->permissionname = $permissionname;
            return $this;
        }
    }

    public function setPermissionrole(int $permissionrole): PermissionMapping
    {
        $this->permissionrole = $permissionrole;
        return $this;
    }

    // Méthode obligatoire pour l'abstract
    public function __toString(): string
    {
        return self::class;
    }

}
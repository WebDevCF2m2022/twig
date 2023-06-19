<?php

namespace MyModels\Mapping;

// utilisation de classes externes
// classe abstraite
use MyModels\Abstract\AbstractMapping;
use MyModels\Trait\userEntryProtectionTrait as protection;

// trait renommé en protection, on doit utiliser le 'use protection' dans la classe

class theuserMapping extends AbstractMapping
{
    private int $idtheuser;

    // Propriétés
    private string $theuserlogin;
    private string $theuserpwd;
    private string $theusermail;
    private string $theuseruniqid;
    private int    $theuseracivate;
    private int    $permission_idpermission;

    public function __construct(array $tab, bool $new = false)
    {
        parent::__construct($tab);
        if ($new) {
            $this->theuseruniqid  = $this->createUniqueId();
            $this->theuseracivate = 0;
        }
    }

    // importation de la méthode du trait
    use protection;

    // Getters

    private function createUniqueId() : string
    {
        return uniqid(more_entropy: true);
    }


    public function getIdtheuser() : int
    {
        return $this->idtheuser;
    }

    public function setIdtheuser(int $idtheuser) : TheuserMapping
    {

        $this->idtheuser = $idtheuser;
        return $this;
    }

    public function getTheuserlogin() : string
    {
        return $this->theuserlogin;
    }

    public function setTheuserlogin(string $theuserlogin) : TheuserMapping
    {
        if (strlen($theuserlogin) > 50) {
            trigger_error("L'ID de l'utilisateur ne peut pas dépasser 50 caractères", E_USER_NOTICE);
        }
        else {
            $theuserlogin       = protection::userEntryProtection($theuserlogin);
            $this->theuserlogin = $theuserlogin;
        }
        return $this;
    }

    public function getTheuserpwd() : string
    {
        return $this->theuserpwd;
    }

    public function setTheuserpwd(string $theuserpwd) : TheuserMapping
    {
        if (strlen($theuserpwd) > 255) {
            trigger_error("Le mot de passe est trop long ! ", E_USER_NOTICE);
        }
        else {
            $this->theuserpwd = $theuserpwd;
        }
        return $this;
    }

    // Setters

    public function getTheusermail() : string
    {
        return $this->theusermail;
    }

    public function setTheusermail(string $theusermail) : TheuserMapping
    {

        if ((strlen($theusermail) > 255) && (!filter_var(trim($theusermail), FILTER_VALIDATE_EMAIL))) {
            trigger_error("L'adresse e-mail est trop longue  ou le format est invalide ! ", E_USER_NOTICE);
        }
        else {
            $this->theusermail = $theusermail;
        }
        return $this;
    }

    public function getTheuseruniqid() : string
    {
        return $this->theuseruniqid;
    }

    public function setTheuseruniqid(string $theuseruniqid) : TheuserMapping
    {
        if (strlen($theuseruniqid) > 255) {
            trigger_error("La clef unique est trop longue ! ");
        }
        else {
            $this->theuseruniqid = $theuseruniqid;
        }
        return $this;
    }

    public function getTheuseractivate() : int
    {
        return $this->theuseracivate;
    }

    public function getPermissionIdpermission() : int
    {
        return $this->permission_idpermission;
    }

    public function setPermissionIdpermission(int $permission_idpermission) : TheuserMapping
    {
        if ($permission_idpermission < 1 || $permission_idpermission > 3) {
            trigger_error("La permission introduite n'existe pas !", E_USER_NOTICE);
        }
        else {
            $this->permission_idpermission = $permission_idpermission;
        }
        return $this;
    }

    public function setTheuseractivate(int $theuseractivate) : TheuserMapping
    {
        if (!($theuseractivate >= 0 && $theuseractivate < 3) || (!$theuseractivate)) {
            trigger_error("Identifiant de l'état d'activité invalide !");
        }
        else {
            $this->theuseracivate = $theuseractivate;
        }
        return $this;
    }
}
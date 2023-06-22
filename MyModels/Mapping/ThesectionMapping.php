<?php

namespace MyModels\Mapping;

use MyModels\Abstract\AbstractMapping;
use Exception;

class ThesectionMapping extends AbstractMapping
{
    // Propriétés
    private int $idthesection;
    private string $thesectiontitle;
    private string $thesectionslug;
    private string $thesectiondesc;

    // Getters

    public function getidthesection(): int
    {
        return $this->idthesection;
    }

    public function getthesectiontitle(): string
    {
        return $this->thesectiontitle;
    }

    public function getthesectionslug(): string
    {
        return $this->thesectionslug;
    }

    public function getthesectiondesc(): string
    {
        return $this->thesectiondesc;
    }


    // Setters

    public function setidthesection(int $idthesection): thesectionMapping
    {
        $this->idthesection = $idthesection;
        return $this;
    }


    public function setthesectiontitle(string $thesectiontitle): thesectionMapping
    {
        // dépasse 60 caractères
        if(strlen($thesectiontitle)>60){
            // affichage de l'erreur
            throw new Exception("Le nom de la permission ne doit pas dépasser 60 caractères");
            return $this;
        }else {
            $this->thesectiontitle = $thesectiontitle;
            return $this;
        }
    }

    public function setthesectionslug(string $thesectionslug): thesectionMapping
    {
        // dépasse 60 caractères
        if(strlen($thesectionslug)>60){
            // affichage de l'erreur
            throw new Exception("Le nom de la permission ne doit pas dépasser 60 caractères");
            return $this;
        }else {
            $this->thesectionslug = $thesectionslug;
            return $this;
        }
    }

    public function setthesectiondesc(string $thesectiondesc): thesectionMapping
    {
        // dépasse 300 caractères
        if(strlen($thesectiondesc)>600){
            // affichage de l'erreur
            throw new Exception("Le nom de la permission ne doit pas dépasser 300 caractères");
            return $this;
        }else {
            $this->thesectiondesc = $thesectiondesc;
            return $this;
        }
    }

    // Méthode obligatoire pour l'abstract
    public function __toString(): string
    {
        return self::class;
    }

}
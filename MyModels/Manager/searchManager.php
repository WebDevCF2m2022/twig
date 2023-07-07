<?php

namespace MyModels\Manager;

use Exception;
use MyModels\Interface\ManagerInterface;
use MyModels\Mapping\TheuserMapping;
use MyModels\Mapping\thearticleMapping;
use PDO;

class thesearchManager implements ManagerInterface
{

    private PDO $connect;

    public function __construct(PDO $db)
    {
        $this->connect = $db;
    }

// function pour la barre de recherche de l'utilisateur (dans le menu) permetant de retrouver un article grace à des mots clés dans son titre ou de retrouver un utilisateur grace à son theuserlogin
    public function thesearchSelectAllBySearch(string $search)
    {
        $sql = "SELECT * FROM `thearticle` WHERE `thearticletitle` LIKE :search OR `thearticlecontent` LIKE :search";
        $result = $this->connect->prepare($sql);
        $result->bindValue(":search", "%" . $search . "%", PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, thearticleMapping::class);
        $articles = $result->fetchAll();
        $result->closeCursor();
        return $articles;
    }

    public function thesearchSelectAllBySearchUser(string $search)
    {
        $sql = "SELECT * FROM `theuser` WHERE `theuserlogin` LIKE :search";
        $result = $this->connect->prepare($sql);
        $result->bindValue(":search", "%" . $search . "%", PDO::PARAM_STR);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, TheuserMapping::class);
        $users = $result->fetchAll();
        $result->closeCursor();
        return $users;
    }
}
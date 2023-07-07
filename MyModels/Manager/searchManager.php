<?php

namespace MyModels\Manager;

use Exception;
use MyModels\Interface\ManagerInterface;
use MyModels\Mapping\TheuserMapping;
use MyModels\Mapping\ThearticleMapping;
use PDO;

class searchManager implements ManagerInterface
{

    private PDO $connect;

    public function __construct(PDO $db)
    {
        $this->connect = $db;
    }

// function pour la barre de recherche de l'utilisateur (dans le menu) permetant de retrouver un article grace à des mots clés dans son titre ou de retrouver un utilisateur grace à son theuserlogin
    public function thesearchSelectAllBySearch(string $search): ?array
    {
        $sql = "SELECT * FROM `thearticle` WHERE `thearticletitle` LIKE :search OR `thearticletext` LIKE :search";
        $result = $this->connect->prepare($sql);
        $result->bindValue(":search", "%" . $search . "%", PDO::PARAM_STR);
        $result->execute();
        if($result->rowCount()===0){
            return null;
        }
        $resultArticle = $result->fetchAll();
        $articles=[];
        foreach ($resultArticle as $article) {
            $articles[] = new ThearticleMapping($article);
        }
        //var_dump($articles);
        $result->closeCursor();
        return $articles;
    }

    public function thesearchSelectAllBySearchUser(string $search):?array
    {
        $sql = "SELECT * FROM `theuser` WHERE `theuserlogin` LIKE :search";
        $result = $this->connect->prepare($sql);
        $result->bindValue(":search", "%" . $search . "%", PDO::PARAM_STR);
        $result->execute();
        if($result->rowCount()===0){
            return null;
        }
        $user = $result->fetchAll();
        foreach ($user as $u) {
            $users[] = new TheuserMapping($u);
        }
        $result->closeCursor();
        return $users;
    }
}
<?php

namespace MyModels\Manager;

// utilisation de l'interface des Manager
use MyModels\Interface\ManagerInterface;
use MyModels\Trait\userEntryProtectionTrait;
use PDO;
use Exception;
use MyModels\Mapping\ThesectionMapping;

class thesectionManager implements ManagerInterface
{

    private PDO $connect;

    public function __construct(PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectAllThesection(): string|array{
        $prepare = $this->connect->prepare("SELECT idthesection, thesectiontitle, thesectionslug FROM thesection  ORDER BY idthesection ASC;");
        try {
            $prepare->execute();
            $prepare->fetchAll();
        }catch (Exception $e) {
            return $e->getMessage();
        }
        foreach ($prepare as $row){
            $thesection[] = new ThesectionMapping($row);
        }
        return $thesection;
    }


    // ICI

    use userEntryProtectionTrait;

    public function SelectOneThesectionBySlug(string $slug): array|string
    {
        // utilisation du trait de protection
        $slug = $this->userEntryProtection($slug);
        $sql = "SELECT * FROM thesection WHERE thesectionslug=?";
        $prepare = $this->connect->prepare($sql);
        try{
            $prepare->execute([$slug]);
            return $prepare->fetch(\PDO::FETCH_ASSOC);
        }catch(\Exception $e){
            return $e->getMessage();
        }

    }


}
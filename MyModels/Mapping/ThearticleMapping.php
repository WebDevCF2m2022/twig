<?php

namespace MyModels\Mapping;

use MyModels\Abstract\AbstractMapping;
use MyModels\Trait\SlugifyTrait;
use Exception;

class ThearticleMapping extends AbstractMapping
{

    // Propriétés
    private int    $idthearticle;
    private string $thearticletitle;
    private string $thearticleslug;
    private string $thearticleresume;
    private string $thearticletext;
    private string $thearticledate;
    private int    $thearticleactivate;
    private int    $theuser_idtheuser;

    use SlugifyTrait;

    public function __construct(array $tab, bool $new = false)
    {
        parent::__construct($tab);
        if ($new) {
            $this->slugifyTitle();
            $this->summarize();
        }
    }

    private function slugifyTitle() : void
    {
        $this->setThearticleslug(self::slugify($this->thearticletitle));
    }

    public function setThearticleslug(string $thearticleslug) : thearticleMapping
    {
        // dépasse 120 caractères
        if (strlen($thearticleslug) > 120) {
            // affichage de l'erreur
            throw new Exception("La longueur du slug ne doit pas dépasser 120 caractères");
            return $this;
        }
        else {
            $this->thearticleslug = $thearticleslug;
            return $this;
        }
    }

    // Getters

    private function summarize(int $offset = 0, int $substr = 250) : void
    {
        $this->setThearticleresume(substr($this->thearticletext, $offset, $substr));
    }


    public function setThearticleresume(string $thearticleresume) : thearticleMapping
    {
        // dépasse 120 caractères
        if (strlen($thearticleresume) > 250) {
            // affichage de l'erreur
            throw new Exception("La longueur du résumé ne doit pas dépasser 250 caractères");
            return $this;
        }
        else {
            $this->thearticleresume = $thearticleresume;
            return $this;
        }
    }

    public function getTheuserIdtheuser() : int
    {
        return $this->theuser_idtheuser;
    }

    public function setTheuserIdtheuser(int $theuser_idtheuser) : thearticleMapping
    {
        $this->theuser_idtheuser = $theuser_idtheuser;
        return $this;
    }

    public function getIdthearticle() : int
    {
        return $this->idthearticle;
    }

    public function setIdthearticle(int $idthearticle) : thearticleMapping
    {
        $this->idthearticle = $idthearticle;
        return $this;
    }

    public function getArticleTitle() : string
    {
        return $this->thearticletitle;
    }

    // Setters

    public function getArticleSlug() : string
    {
        return $this->thearticleslug;
    }

    public function getArticleResume() : string
    {
        return $this->thearticleresume;
    }


    public function getArticleText() : string
    {
        return $this->thearticletext;
    }

    public function getArticleDate() : string
    {
        return $this->thearticledate;
    }


    public function getArticleActivate() : string
    {
        return $this->thearticleactivate;
    }

    public function setThearticletitle(string $thearticletitle) : thearticleMapping
    {
        // dépasse 120 caractères
        if (strlen($thearticletitle) > 120) {
            // affichage de l'erreur
            throw new Exception("La longueur du titre ne doit pas dépasser 120 caractères");
            return $this;
        }
        else {
            $this->thearticletitle = $thearticletitle;
            return $this;
        }
    }

    public function setThearticletext(string $thearticletext) : thearticleMapping
    {
        $this->thearticletext = $thearticletext;
        return $this;
    }

    public function setThearticledate(string $thearticledate) : thearticleMapping
    {
        $this->thearticledate = $thearticledate;
        return $this;
    }

    public function setThearticleactivate(int $thearticleactivate) : thearticleMapping
    {
        $this->thearticleactivate = $thearticleactivate;
        return $this;
    }

    public function __toString() : string
    {
        return $this->getArticleTitle();
    }
}
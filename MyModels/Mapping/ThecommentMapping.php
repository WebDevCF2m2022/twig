<?php
namespace MyModels\Mapping;

use MyModels\Abstract\AbstractMapping;
use Exception;
class ThecommentMapping extends AbstractMapping{
        private int $idthecomment;
        private int $theuser_idtheuser;
        private string $thecommenttext;
        private string $thecommentdate;
        private int $thecommentactive;


    public function getIdthecomment(): int
    {
        return $this->idthecomment;
    }

    public function getTheuserIdtheuser(): int
    {
        return $this->theuser_idtheuser;
    }

    public function getThecommenttext(): string
    {
        return $this->thecommenttext;
    }

    public function getThecommentdate(): string
    {
        return $this->thecommentdate;
    }

    public function getThecommentactive(): int
    {
        return $this->thecommentactive;
    }

    public function setIdpermission(int $idpermission): thecommentMapping
    {
        $this->idthecomment = $idpermission;
        return $this;
    }

    public function setTheuserIdtheuser(int $theuser_idtheuser): thecommentMapping
    {
        $this->theuser_idtheuser = $theuser_idtheuser;
        return $this;
    }

    public function setThecommenttext(string $thecommenttext): thecommentMapping
    {
        if(strlen($thecommenttext)>850) {
            throw new Exception("Le texte du commentaire ne doit pas dépasser 45 caractères", E_USER_NOTICE);
            return $this;
        }else{
                $this->thecommenttext = $thecommenttext;
                return $this;
            }
    }

    public function setThecommentactive(int $thecommentactive): thecommentMapping
    {
        $this->thecommentactive = $thecommentactive;
        return $this;
    }

    public function setIdthecomment(int $idthecomment): thecommentMapping
    {
        $this->idthecomment = $idthecomment;
        return $this;
    }

    public function setThecommentdate(string $thecommentdate): thecommentMapping
    {
        $this->thecommentdate = $thecommentdate;
        return $this;
    }

    public function __toString(): string
    {
        return self::class;
    }

}

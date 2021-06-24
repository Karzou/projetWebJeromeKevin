<?php

class Etudiant
{
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $mdp2;
    private $stage;
    private $nbrStage;

    public function setNbrStage($nbrStage)
    {
        $this->nbrStage = $nbrStage;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setMdp2($mdp2)
    {
        $this->mdp2 = $mdp2;
    }

    public function setStage($stage)
    {
        $this->stage = $stage;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getMdp2()
    {
        return $this->mdp2;
    }

    public function getStage()
    {
        return $this->stage;
    }

    
    public function getNbrStage()
    {
        return $this->nbrStage;
    }
}
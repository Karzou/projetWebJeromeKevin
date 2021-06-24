<?php

class Sujet 
{
    private $descriptif;
    private $superviseur;
    
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    }

    public function getSuperviseur()
    {
        return $this->superviseur;
    }

    public function setSuperviseur($superviseur)
    {
        $this->superviseur = $superviseur;
    }
}
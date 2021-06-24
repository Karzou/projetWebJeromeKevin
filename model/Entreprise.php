<?php

class Entreprise 
{
    private $id;
    private $nomEntreprise;
    private $adresseEntreprise;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }
    /**
     * @param mixed $nomEntreprise
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;
    }
    /**
     * @return mixed
     */
    public function getAdresseEntreprise()
    {
        return $this->adresseEntreprise;
    }
    /**
     * @param mixed $adresseEntreprise
     */
    public function setAdresseEntreprise($adresseEntreprise)
    {
        $this->adresseEntreprise = $adresseEntreprise;
    }    
}

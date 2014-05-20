<?php

namespace Eklerni\DatabaseBundle\Entity;

use Eklerni\BackBundle\Utils\EklerniUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Eleve
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\EleveRepository")
 */
class Eleve extends Personne {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var Classe
     * @ORM\ManyToOne(targetEntity="Classe", inversedBy="eleves")
     * @ORM\JoinColumn(name="idClasse", referencedColumnName="id")
     */
    private $classe;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="eleve")
     * @ORM\JoinColumn(name="idResultat", referencedColumnName="id")
     */
    private $resultats;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Attribuer", mappedBy="eleve")
     *
     */
    private $listeAttribution;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Classe $classe
     * @return Eleve
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $resultats
     * @return Eleve
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array('ROLE_ELEVE');
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $listeAttribution
     * @return Eleve
     */
    public function setListeAttribution($listeAttribution)
    {
        $this->listeAttribution = $listeAttribution;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getListeAttribution()
    {
        return $this->listeAttribution;
    }

    public function getParent() {
        return $this->getClasse()->getNom() . " => ". $this->getFullName();
    }

    /**
     * @param integer $nb
     * @return bool|string
     */
    public function generateUsername($nb) {
        if(is_int($nb) && $nb > 0) {
            if($nb <= strlen($this->prenom)) {
                return $this->username = EklerniUtils::cleanUsername(substr($this->prenom,0,$nb) . "." . $this->nom);
            } else {
                return $this->username = EklerniUtils::cleanUsername($this->prenom . "." . $this->nom . ($nb - strlen($this->prenom)));
            }
        } else {
            return false;
        }

    }

}
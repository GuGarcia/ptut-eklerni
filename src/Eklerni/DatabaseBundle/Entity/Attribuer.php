<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Attribuer
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\AttribuerRepository")
 * @ORM\Table(name="t_attribuer")
 */
class Attribuer
{
    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var Eleve
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="listeAttribution")
     * @ORM\JoinColumn(name="idEleve", referencedColumnName="id")
     */
    private $eleve;

    /**
     * @var Serie
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="listeAttribution")
     * @ORM\JoinColumn(name="idSerie", referencedColumnName="id")
     */
    private $serie;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="attribution")
     * @ORM\JoinColumn(name="idResultat", referencedColumnName="id")
     */
    private $resultats;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateAttribution", type="datetime")
     */
    private $dateAttribution;

    /**
     * @var boolean
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive = false;

    /**
     * @var boolean
     * @ORM\Column(name="isDelete", type="boolean")
     */
    private $isDelete = false;

    /**
     * @var boolean
     * @ORM\Column(name="isClasse", type="boolean")
     */
    private $isClasse;

    /********************
     * CONSTRUCTORS
     ********************/

    function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \DateTime $dateAttribution
     * @return Attribuer
     */
    public function setDateAttribution($dateAttribution)
    {
        $this->dateAttribution = $dateAttribution;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAttribution()
    {
        return $this->dateAttribution;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Eleve $eleve
     * @return Attribuer
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param ArrayCollection $resultats
     * @return Attribuer
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * @param Serie $serie
     * @return Attribuer
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
        return $this;
    }

    /**
     * @return Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param boolean $isActive
     * @return Attribuer
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isClasse
     */
    public function setIsClasse($isClasse)
    {
        $this->isClasse = $isClasse;
    }

    /**
     * @return boolean
     */
    public function getIsClasse()
    {
        return $this->isClasse;
    }

    /**
     * @param boolean $isDelete
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;
    }

    /**
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }
}
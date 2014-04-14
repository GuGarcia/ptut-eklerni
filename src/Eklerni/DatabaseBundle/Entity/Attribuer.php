<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Attribuer
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity
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
     */
    public function setDateAttribution($dateAttribution)
    {
        $this->dateAttribution = $dateAttribution;
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
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
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
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;
    }

    /**
     * @return ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * @param mixed $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resultat
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\ResultatRepository")
 * @ORM\Table(name="t_resultat")
 */
class Resultat extends BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * Apprentissage ou Exercice
     * @var Boolean
     * @ORM\Column(name="isTest", type="boolean")
     */
    private $isTest;

    /**
     * @var integer
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var Eleve
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="resultats")
     * @ORM\JoinColumn(name="idEleve", referencedColumnName="id")
     */
    private $eleve;

    /**
     * @var Serie
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="resultats")
     * @ORM\JoinColumn(name="idSerie", referencedColumnName="id")
     */
    private $serie;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Reponse", mappedBy="resultats")
     */
    private $reponses;

    /**
     * @var Attribuer
     * @ORM\ManyToOne(targetEntity="Attribuer", inversedBy="resultats")
     * @ORM\JoinColumns({
         * @ORM\JoinColumn(name="idSerie", referencedColumnName="idSerie"),
         * @ORM\JoinColumn(name="idEleve", referencedColumnName="idEleve")
     * })
     */
    private $attribution;

    /********************
     * GETTERS AND SETTERS
     ********************/

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
     * @param boolean $isTest
     */
    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    /**
     * @return boolean
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Serie $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Attribuer $attribution
     */
    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Attribuer
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $reponses
     */
    public function setReponses($reponses)
    {
        $this->reponses = $reponses;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * @param int $note
     * @return Resultat
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }





} 
<?php

namespace Eklerni\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Serie
 * @package Eklerni\EntityBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_serie")
 */

class Serie extends EklerniEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $difficulte;

    /**
     * @var Activite
     * @ORM\ManyToOne(targetEntity="Activite", inversedBy="series")
     * @ORM\JoinColumn(name="idActivite", referencedColumnName="id")
     */
    private $activite;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Question", mappedBy="serie")
     */
    private $questions;

    /**
     * @var Enseignant
     * @ORM\ManyToOne(targetEntity="Enseignant", inversedBy="series")
     * @ORM\JoinColumn(name="idEnseignant", referencedColumnName="id")
     */
    private $enseignant;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="serie")
     */
    private $resultats;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param Activite $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }

    /**
 * @return Activite
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param int $difficulte
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
    }

    /**
     * @return int
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }


}

?>
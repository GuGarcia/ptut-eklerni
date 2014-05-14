<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Serie
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\SerieRepository")
 * @ORM\Table(name="t_serie")
 */
class Serie extends BaseEntity
{
    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct() {
        parent::__construct();
        $this->questions = new ArrayCollection();
        $this->listeAttribution = new ArrayCollection();
        $this->resultats = new ArrayCollection();
    }

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * Type: CP,CE1,CE2,CM1,CM2
     * @var string
     * @ORM\Column(name="niveau", type="string", length=20)
     */
    private $niveau;

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
     * @ORM\OneToMany(targetEntity="Question", mappedBy="serie", cascade={"persist", "remove"}, orphanRemoval=true)
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

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Attribuer", mappedBy="serie")
     */
    private $listeAttribution;

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
     * @param \Eklerni\DatabaseBundle\Entity\Enseignant $enseignant
     *
     * @return Serie
     */
    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Enseignant
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $resultats
     * @return Serie
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
     * @param \Doctrine\Common\Collections\ArrayCollection $questions
     */
    public function setQuestions($questions)
    {
        /** @var Question $question */
        foreach($questions as $question) {
            $question->setSerie($this);
        }
        $this->questions = $questions;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     */
    public function addQuestion(Question $question)
    {
        $question->setSerie($this);

        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }
    }

    /**
     * @param Question $question
     * @return Serie
     */
    public function removeQuestion(Question $question)
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }
    }

    /**
     * @param string $nom
     * @return Serie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $description
     * @return Serie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $niveau
     * @return Serie
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param boolean $public
     * @return Serie
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $listeAttribution
     */
    public function setListeAttribution($listeAttribution)
    {
        $this->listeAttribution = $listeAttribution;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getListeAttribution()
    {
        return $this->listeAttribution;
    }

    /**
     * @return Serie
     */
    public function duplicate()
    {
        $serie = new Serie();

        $serie->setNom($this->nom);
        $serie->setDescription($this->description);
        $serie->setNiveau($this->niveau);
        $serie->setDifficulte($this->difficulte);
        $serie->setActivite($this->activite);
        $serie->setPublic(false);

        foreach ($this->questions as $question) {
            $newQuestion = $question->duplicate();
            $newQuestion->setSerie($serie);
            $serie->questions->add($newQuestion);
        }

        return $serie;
    }

    /**
     * @return string
     */
    public function getParent() {
        return $this->getActivite()->getMatiere()->getName()." => ".$this->getActivite()->getName()." => ".$this->nom;
    }
}
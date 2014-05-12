<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Classe
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\ClasseRepository")
 * @ORM\Table(name="t_classe")
 */
class Classe extends BaseEntity
{
    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct() {
        parent::__construct();
        $this->eleves = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
    }

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * Type: CP,CE1,CE2,CM1,CM2
     * @var string
     * @ORM\Column(name="niveau", type="string", length=20)
     */
    private $niveau;

    /**
     * @var integer
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Eleve", mappedBy="classe")
     */
    private $eleves;

    /**
     * @var Ecole
     * @ORM\ManyToOne(targetEntity="Ecole", inversedBy="classes")
     * @ORM\JoinColumn(name="idEcole", referencedColumnName="id")
     */
    private $ecole;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Matiere", mappedBy="classes")
     * @ORM\JoinTable(name="t_classeMatiere")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $matieres;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Enseignant", mappedBy="classes")
     */
    private $enseignants;

    /********************
     * GETTERS AND SETTERS
     ********************/

    public function getFullName()
    {
        return $this->nom . ' (' . $this->niveau . ')';
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Ecole $ecole
     * @return Classe
     */
    public function setEcole($ecole)
    {
        $this->ecole = $ecole;
        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $eleves
     * @return Classe
     */
    public function setEleves($eleves)
    {
        $this->eleves = $eleves;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * @param string $niveau
     * @return Classe
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
     * @param string $nom
     * @return Classe
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
     * @param \Doctrine\Common\Collections\ArrayCollection $matieres
     * @return Classe
     */
    public function setMatieres($matieres)
    {
        $this->matieres = $matieres;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatieres()
    {
        return $this->matieres;
    }

    /**
     * @param Matiere $matiere
     * @return Classe
     */
    public function addMatiere(Matiere $matiere) {
        $this->matieres->add($matiere);
        return $this;
    }

    /**
     * @param mixed $enseignants
     * @return Classe
     */
    public function setEnseignants(ArrayCollection $enseignants)
    {
        $this->enseignants = $enseignants;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnseignants()
    {
        return $this->enseignants;
    }

    /**
     * @param Enseignant $e
     * @return Classe
     */
    public function addEnseignant(Enseignant $e)
    {
        $this->enseignants->add($e);
        return $this;
    }

    /**
     * @param int $annee
     * @return Classe
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }


} 
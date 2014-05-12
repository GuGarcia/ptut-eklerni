<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Matiere
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\MatiereRepository")
 * @ORM\Table(name="t_matiere")
 */
class Matiere extends BaseEntity
{

    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct()
    {
        parent::__construct();
        $this->activites = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }
    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Activite", mappedBy="matiere")
     */
    private $activites;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Classe", inversedBy="matieres", cascade={"remove", "persist"})
     * @ORM\JoinTable(name="t_classeMatiere")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $classes;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $activites
     */
    public function setActivites($activites)
    {
        $this->activites = $activites;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getActivites()
    {
        return $this->activites;
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
     * @param \Doctrine\Common\Collections\ArrayCollection $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param Classe $classe
     * @return Matiere
     */
    public function addClasse(Classe $classe) {
        $this->classes->add($classe);
        return $this;
    }

}
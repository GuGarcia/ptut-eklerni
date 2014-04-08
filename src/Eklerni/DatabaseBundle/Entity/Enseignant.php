<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:25
 */

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Enseignant
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\EnseignantRepository")
 */
class Enseignant extends Personne
{

    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct() {
        parent::__construct();
        $this->classes = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Classe", inversedBy="enseignants")
     * @ORM\JoinTable(name="t_classeEnseignant")
     */
    private $classes;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="enseignant")
     */
    private $series;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $classes
     * @return Enseignant
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param Classe $c
     * @return Enseignant
     */
    public function addClasses(Classe $c) {
        $this->classes->add($c);
        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $series
     * @return Enseignant
     */
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param Serie $s
     * @return Enseignant $this
     */
    public function addSerie(Serie $s) {
        $this->series->add($s);
        return $this;
    }


    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array('ROLE_ENSEIGNANT');
    }
}
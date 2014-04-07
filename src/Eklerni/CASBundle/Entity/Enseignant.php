<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:25
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Enseignant
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\CASBundle\Repository\EnseignantRepository")
 */
class Enseignant extends Personne{

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Classe", mappedBy="enseignants")
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
     * @param \Doctrine\Common\Collections\ArrayCollection $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSeries()
    {
        return $this->series;
    }


    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array('ROLE_ENSEIGNANT');
    }
}
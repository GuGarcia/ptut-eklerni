<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:23
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ecole
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_ecole")
 */
class Ecole extends BaseEntity{

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="ville", type="text")
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(name="codePostal", type="text")
     */
    private $codePostal;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Classe", mappedBy="ecole")
     */
    private $classes;

    /********************
     * GETTERS AND SETTERS
     ********************/

    public function getFullName()
    {
        return $this->nom . ' - ' . $this->codePostal . ' ' . $this->ville;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $classes
     * @return Ecole
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
     * @param string $codePostal
     * @return Ecole
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param string $nom
     * @return Ecole
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
     * @param string $ville
     * @return Ecole
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }



} 
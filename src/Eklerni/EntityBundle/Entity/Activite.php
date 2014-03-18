<?php

namespace Eklerni\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Activite
 * @package Eklerni\EntityBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_activite")
 */
class Activite extends EklerniEntity {
    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=200)
     */
    protected $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="activite")
     */
    protected $series;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Matiere", inversedBy="activites")
     * @ORM\JoinColumn(name="idMatiere", referencedColumnName="id")
     */
    protected $matiere;

    /**
     * @param int $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return int
     */
    public function getMatiere()
    {
        return $this->matiere;
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
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

}

?>
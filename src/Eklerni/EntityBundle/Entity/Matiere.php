<?php

namespace Eklerni\EntityBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Matiere
 * @package Eklerni\EntityBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_matiere")
 */
class Matiere extends EklerniEntity {
    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Activite", mappedBy="matiere")
     */
    protected $activites;

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
}

?>
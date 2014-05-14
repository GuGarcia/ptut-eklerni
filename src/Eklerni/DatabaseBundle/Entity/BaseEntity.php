<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntity
 * @package Eklerni\DatabaseBundle\Entity
 */
class BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var \DateTime
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    protected $dateCreation;
    /**
     * @var \Datetime
     * @ORM\Column(name="dateModification", type="datetime")
     */
    protected $dateModification;

    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->dateModification = new \DateTime();
    }

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \DateTime $dateCreation
     * @return BaseEntity
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \Datetime $dateModification
     * @return BaseEntity
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * @return \Datetime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }
}
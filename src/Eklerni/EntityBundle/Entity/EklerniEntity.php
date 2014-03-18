<?php
/**
 * Created by PhpStorm.
 * User: GV
 * Date: 18/03/14
 * Time: 09:42
 */

namespace Eklerni\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EklerniEntity
 * @package Eklerni\EntityBundle\Entity
 */
class EklerniEntity {

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
     * @return EklerniEntity
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
     * @return EklerniEntity
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
}
<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Activite
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\ActiviteRepository")
 * @ORM\Table(name="t_activite")
 */
class Activite extends BaseEntity
{

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="activite")
     * @ORM\OrderBy({"nom" = "ASC"})
     */
    private $series;

    /**
     * @var Matiere
     * @ORM\ManyToOne(targetEntity="Matiere", inversedBy="activites")
     * @ORM\JoinColumn(name="idMatiere", referencedColumnName="id")
     */
    private $matiere;

    /**
     * @var Media
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="questionMedia", referencedColumnName="id")
     */
    private $questionMedia;

    /**
     * @var Media
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="reponseMedia", referencedColumnName="id")
     */
    private $reponseMedia;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param Matiere $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return Matiere
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

    /**
     * @return Media
     */
    public function getQuestionMedia()
    {
        return $this->questionMedia;
    }

    /**
     * @return Media
     */
    public function getReponseMedia()
    {
        return $this->reponseMedia;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Media $questionMedia
     * @return \Eklerni\DatabaseBundle\Entity\Activite
     */
    public function setQuestionMedia(Media $questionMedia)
    {
        $this->questionMedia = $questionMedia;

        return $this;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Media $reponseMedia
     * @return \Eklerni\DatabaseBundle\Entity\Activite
     */
    public function setReponseMedia(Media $reponseMedia)
    {
        $this->reponseMedia = $reponseMedia;

        return $this;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return $this->getMatiere()->getName() . " => " . $this->name;
    }
}
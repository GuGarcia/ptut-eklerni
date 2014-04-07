<?php
/**
 * Created by PhpStorm.
 * User: Cindy
 * Date: 07/04/14
 * Time: 15:11
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Attribuer
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_attribuer")
 */
class Attribuer extends BaseEntity
{
    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var Eleve
     * @Id @Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="listeAttribution")
     * @ORM\JoinColumn(name="idEleve", referencedColumnName="id")
     */
    private $eleve;

    /**
     * @var Serie
     * @Id @Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="listeAttribution")
     * @ORM\JoinColumn(name="idSerie", referencedColumnName="id")
     */
    private $serie;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="eleve")
     */
    private $resultats;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateAttribution", type="datetime")
     */
    private $dateAttribution;

    /********************
     * CONSTRUCTORS
     ********************/

    function __construct()
    {
        $this->resultats = new ArrayCollection();
    }

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \DateTime $dateAttribution
     */
    public function setDateAttribution($dateAttribution)
    {
        $this->dateAttribution = $dateAttribution;
    }

    /**
     * @return \DateTime
     */
    public function getDateAttribution()
    {
        return $this->dateAttribution;
    }

    /**
     * @param \Eklerni\CASBundle\Entity\Eleve $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param \Eklerni\CASBundle\Entity\ArrayCollection $resultats
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * @param mixed $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
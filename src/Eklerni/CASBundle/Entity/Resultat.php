<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 11:43
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resultat
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_resultat")
 */
class Resultat extends BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * Apprentissage ou Exercice
     * @var Boolean
     * @ORM\Column(name="isTest", type="boolean")
     */
    private $isTest;

    /**
     * @var Eleve
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="resultats")
     * @ORM\JoinColumn(name="idEleve", referencedColumnName="id")
     */
    private $eleve;

    /**
     * @var Serie
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="resultats")
     * @ORM\JoinColumn(name="idSerie", referencedColumnName="id")
     */
    private $serie;

    /********************
     * GETTERS AND SETTERS
     ********************/

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
     * @param boolean $isTest
     */
    public function setIsTest($isTest)
    {
        $this->isTest = $isTest;
    }

    /**
     * @return boolean
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * @param \Eklerni\CASBundle\Entity\Serie $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }





} 
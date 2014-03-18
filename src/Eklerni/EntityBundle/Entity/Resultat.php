<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 11:43
 */

namespace Eklerni\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resultat
 * @package Eklerni\EntityBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_resultat")
 */
class Resultat extends EklerniEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * Apprentissage ou Exercice
     * @var Boolean
     * @ORM\Column(name="mode", type="boolean")
     */
    private $mode;

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
     * @param \Eklerni\EntityBundle\Entity\Eleve $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return \Eklerni\EntityBundle\Entity\Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param boolean $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return boolean
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param \Eklerni\EntityBundle\Entity\Serie $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return \Eklerni\EntityBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }





} 
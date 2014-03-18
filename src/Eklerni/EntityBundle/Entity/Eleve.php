<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:25
 */

namespace Eklerni\EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Eleve
 * @package Eklerni\EntityBundle\Entity
 * @ORM\Entity
 */
class Eleve extends Personne {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var Classe
     * @ORM\ManyToOne(targetEntity="Classe", inversedBy="eleves")
     * @ORM\JoinColumn(name="idClasse", referencedColumnName="id")
     */
    private $classe;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Resultat", mappedBy="eleve")
     */
    private $resultats;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \Eklerni\EntityBundle\Entity\Classe $classe
     * @return Eleve
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return \Eklerni\EntityBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }


} 
<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:25
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Eleve
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity(repositoryClass="Eklerni\CASBundle\Repository\EleveRepository")
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
     * @param \Eklerni\CASBundle\Entity\Classe $classe
     * @return Eleve
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
        return $this;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $resultats
     * @return Eleve
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array('ROLE_ELEVE');
    }
}
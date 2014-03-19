<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:23
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Classe
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_classe")
 */
class Classe extends BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * Type: CP,CE1,CE2,CM1,CM2
     * @var string
     * @ORM\Column(name="niveau", type="string", length=3)
     */
    private $niveau;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Eleve", mappedBy="classe")
     */
    private $eleves;

    /**
     * @var Enseignant
     * @ORM\ManyToOne(targetEntity="Enseignant", inversedBy="classes")
     * @ORM\JoinColumn(name="idEnseignant", referencedColumnName="id")
     */
    private $enseignant;

    /**
     * @var Ecole
     * @ORM\ManyToOne(targetEntity="Ecole", inversedBy="classes")
     * @ORM\JoinColumn(name="idEcole", referencedColumnName="id")
     */
    private $ecole;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Matiere", mappedBy="classes")
     */
    private $matieres;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param \Eklerni\CASBundle\Entity\Ecole $ecole
     * @return Classe
     */
    public function setEcole($ecole)
    {
        $this->ecole = $ecole;
        return $this;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $eleves
     * @return Classe
     */
    public function setEleves($eleves)
    {
        $this->eleves = $eleves;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * @param mixed $enseignant
     * @return Classe
     */
    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnseignant()
    {
        return $this->enseignant;
    }

    /**
     * @param string $niveau
     * @return Classe
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
        return $this;
    }

    /**
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param string $nom
     * @return Classe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $matieres
     */
    public function setMatieres($matieres)
    {
        $this->matieres = $matieres;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatieres()
    {
        return $this->matieres;
    }


} 
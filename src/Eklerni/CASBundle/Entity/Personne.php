<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 18/03/2014
 * Time: 09:24
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Personne
 * @package Eklerni\CASBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_personne")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"enseignant" = "Enseignant", "eleve" = "Eleve"})
 */
abstract class Personne extends BaseEntity{

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     * @ORM\Column(name="nom", type="text")
     */
    protected $nom;

    /**
     * @var string
     * @ORM\Column(name="prenom", type="text")
     */
    protected $prenom;

    /**
     * @var string
     * @ORM\Column(name="login", type="text")
     */
    protected $login;

    /**
     * @var string
     * @ORM\Column(name="password", type="text")
     */
    protected $passWord;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateNaissance", type="datetime")
     */
    protected $dateNaissance;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param mixed $dateNaissance
     * @return Personne
     */

    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $login
     * @return Personne
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $nom
     * @return Personne
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
     * @param mixed $passWord
     * @return Personne
     */
    public function setPassWord($passWord)
    {
        $this->passWord = $passWord;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassWord()
    {
        return $this->passWord;
    }

    /**
     * @param mixed $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }





} 
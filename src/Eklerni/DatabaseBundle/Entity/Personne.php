<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class Personne
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="t_personne")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"enseignant" = "Enseignant", "eleve" = "Eleve"})
 */
abstract class Personne extends BaseEntity implements AdvancedUserInterface, \Serializable
{

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
     * @ORM\Column(name="username", type="string", length=80, unique=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(name="salt", type="string", length=32)
     */
    protected $salt;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=88)
     */
    protected $password;

    /**
     * Variable used to change password
     *
     * @var string
     */
    protected $newPassword;

    /**
     * @var boolean
     * @ORM\Column(name="isActive", type="boolean")
     */
    protected $isActive;

    /**
     * @var \DateTime
     * @ORM\Column(name="dateNaissance", type="datetime", nullable=true)
     */
    protected $dateNaissance;


    public function __construct()
    {
        parent::__construct();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }



    /********************
     * GETTERS AND SETTERS
     ********************/


    /**
     * @param string $salt
     * @return Personne
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param boolean $isActive
     * @return Personne
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param \DateTime $dateNaissance
     * @return Personne
     */

    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param string $username
     * @return Personne
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
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
     * @param string $password
     * @return Personne
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $newPassword
     * @return Personne
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }


    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(
            array(
                $this->id,
                $this->username,
                $this->password,
                $this->salt,
                $this->isActive
            )
        );
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
            $this->isActive
            ) = unserialize($serialized);
    }
} 
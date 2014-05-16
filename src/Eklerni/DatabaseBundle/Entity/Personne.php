<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

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
     * CONSTRUCTORS
     ********************/

    public function __construct()
    {
        parent::__construct();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

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

    /**
     * @var string
     * @ORM\Column(name="picture", type="string", length=20, nullable=true)
     */
    protected $picture;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var UploadedFile
     * @Assert\File(maxSize="1M")
     */
    private $file;


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
     * @param string $email
     * @return Personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $picture
     * @return Personne
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        if (null != $this->picture) {
            return 'uploads/profile/'.$this->picture;
        } else {
            return 'uploads/profile/no-image.jpg';
        }
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            __DIR__.'/../../../../web/uploads/profile/',
            $this->id . "." . $this->getFile()->getClientOriginalExtension()
        );

        // set the path property to the filename where you've saved the file
        $this->picture = $this->id . "." . $this->getFile()->getClientOriginalExtension();

        // clean up the file property as you won't need it anymore
        $this->file = null;
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

    public function getFullName() {
        return $this->nom . " " . $this->getPrenom();
    }
} 
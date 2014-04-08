<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Reponse
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Table(name="t_reponse")
 * @ORM\Entity
 */
class Reponse extends BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text")
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="mediaUrl", type="text")
     */
    private $mediaUrl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="idMedia", referencedColumnName="id")
     */
    private $media;

    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="reponses")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Resultat", inversedBy="reponses")
     * @ORM\JoinTable(name="t_resultatReponse")
     */
    private $resultats;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param string $label
     *
     * @return Reponse
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Media $media
     *
     * @return Reponse
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param string $mediaUrl
     *
     * @return Reponse
     */
    public function setMediaUrl($mediaUrl)
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaUrl()
    {
        return $this->mediaUrl;
    }

    /**
     * @param boolean $valid
     *
     * @return Reponse
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param \Eklerni\DatabaseBundle\Entity\Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $resultats
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getResultats()
    {
        return $this->resultats;
    }



}
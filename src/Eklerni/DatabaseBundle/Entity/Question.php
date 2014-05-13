<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Table(name="t_question")
 * @ORM\Entity
 */
class Question extends BaseEntity
{
    /********************
     * CONSTRUCTORS
     ********************/

    public function __construct() {
        parent::__construct();
        $this->reponses = new ArrayCollection();
    }
    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="mediaUrl", type="text", nullable=true)
     */
    private $mediaUrl;

    /**
     * @var Serie
     *
     * @ORM\ManyToOne(targetEntity="Serie", inversedBy="questions")
     * @ORM\JoinColumn(name="idSerie", referencedColumnName="id")
     */
    private $serie;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Media")
     * @ORM\JoinColumn(name="idMedia", referencedColumnName="id")
     */
    private $media;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Reponse", mappedBy="question", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $reponses;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param string $label
     *
     * @return Question
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
     * @return Question
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
     * @return Question
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
     * @param \Eklerni\DatabaseBundle\Entity\Serie $serie
     *
     * @return Question
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return \Eklerni\DatabaseBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $reponses
     */
    public function setReponses($reponses)
    {
        /** @var Reponse $reponse */
        foreach ($reponses as $reponse) {
            $reponse->setQuestion($this);
        }
        $this->reponses = $reponses;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * @param Reponse $reponse
     */
    public function addReponse(Reponse $reponse)
    {
        $reponse->setQuestion($this);

        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
        }
    }

    /**
     * @param Reponse $reponse
     */
    public function removeReponse(Reponse $reponse)
    {
        if ($this->reponses->contains($reponse)) {
            $this->reponses->removeElement($reponse);
        }
    }

}
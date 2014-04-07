<?php
/**
 * Created by PhpStorm.
 * User: GV
 * Date: 18/03/14
 * Time: 09:24
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 * @package Eklerni\CASBundle\Entity
 * @ORM\Table(name="t_question")
 * @ORM\Entity
 */
class Question extends BaseEntity {

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
     * @ORM\ManyToMany(targetEntity="Reponse", mappedBy="question")
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
     * @param \Eklerni\CASBundle\Entity\Media $media
     *
     * @return Question
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Media
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
     * @param \Eklerni\CASBundle\Entity\Serie $serie
     *
     * @return Question
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Serie
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
        $this->reponses = $reponses;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getReponses()
    {
        return $this->reponses;
    }

}
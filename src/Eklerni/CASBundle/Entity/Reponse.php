<?php
/**
 * Created by PhpStorm.
 * User: GV
 * Date: 18/03/14
 * Time: 09:24
 */

namespace Eklerni\CASBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Reponse
 * @package Eklerni\CASBundle\Entity
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
     * @var ArrayCollecion
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
     * @param \Eklerni\CASBundle\Entity\Media $media
     *
     * @return Reponse
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
     * @param \Eklerni\CASBundle\Entity\Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param \Eklerni\CASBundle\Entity\ArrayCollecion $resultats
     */
    public function setResultats($resultats)
    {
        $this->resultats = $resultats;
    }

    /**
     * @return \Eklerni\CASBundle\Entity\ArrayCollecion
     */
    public function getResultats()
    {
        return $this->resultats;
    }



}
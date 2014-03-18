<?php
/**
 * Created by PhpStorm.
 * User: GV
 * Date: 18/03/14
 * Time: 09:24
 */

namespace Eklerni\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Reponse
 *
 * @package Eklerni\EntityBundle\Entity
 *
 * @ORM\Table(name="t_reponse")
 * @ORM\Entity
 */
class Reponse extends EklerniEntity {
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
     * @ORM\JoinColumn(name="idMedia", referencedColumnName="")
     */
    private $media;

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
     * @param \Eklerni\EntityBundle\Entity\Media $media
     *
     * @return Reponse
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return \Eklerni\EntityBundle\Entity\Media
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
}
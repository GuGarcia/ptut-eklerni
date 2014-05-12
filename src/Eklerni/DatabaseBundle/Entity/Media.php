<?php

namespace Eklerni\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Media
 * @package Eklerni\DatabaseBundle\Entity
 * @ORM\Table(name="t_media")
 * @ORM\Entity(repositoryClass="Eklerni\DatabaseBundle\Repository\MediaRepository")
 */
class Media extends BaseEntity {

    /********************
     * ATTRIBUTES
     ********************/

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=50)
     */
    private $media;

    /********************
     * GETTERS AND SETTERS
     ********************/

    /**
     * @param string $media
     *
     * @return Media
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }
}
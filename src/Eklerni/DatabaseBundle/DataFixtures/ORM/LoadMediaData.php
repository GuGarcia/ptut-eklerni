<?php

namespace Eklerni\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eklerni\DatabaseBundle\Entity\Media;

class LoadMediaData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    function load(ObjectManager $manager)
    {
        $listMedia = array("text", "audio", "video", "image", "font");

        foreach ($listMedia as $mediaName) {
            $media = new Media();
            $media->setMedia($mediaName);

            $manager->persist($media);
            $manager->flush();
        }

    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 40;
    }
}
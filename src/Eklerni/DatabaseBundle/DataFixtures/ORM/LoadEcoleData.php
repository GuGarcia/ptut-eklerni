<?php

namespace Eklerni\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eklerni\DatabaseBundle\Entity\Ecole;

class LoadEcoleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    function load(ObjectManager $manager)
    {
        $ecole = new Ecole();
        $ecole->setNom("Grand Trou");
        $ecole->setCodePostal("69008");
        $ecole->setVille("Lyon 8");

        $manager->persist($ecole);
        $manager->flush();

    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
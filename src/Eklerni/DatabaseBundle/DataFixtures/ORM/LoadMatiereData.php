<?php

namespace Eklerni\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eklerni\DatabaseBundle\Entity\Matiere;

class LoadMatiereData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    function load(ObjectManager $manager)
    {
        $listMatiere = array("Lecture", "Dictée", "Conjugaison", "Maths", "Calcul");

        foreach ($listMatiere as $matiereName) {
            $matiere = new Matiere();
            $matiere->setName($matiereName);

            $manager->persist($matiere);
            $manager->flush();

            $this->addReference($matiere->getName(), $matiere);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
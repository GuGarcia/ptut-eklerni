<?php

namespace Eklerni\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eklerni\DatabaseBundle\Entity\Activite;

class LoadActiviteData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    function load(ObjectManager $manager)
    {
        $listLecture = array("Syllabes", "Lettres", "Mots", "Phrases");
        $listDictee = array("Syllabes", "Lettres", "Mots");
        $listConjugaison = array("Présent", "Futur", "Imparfait");
        $listMaths = array("Compter", "Lire", "Ecrire", "Ranger");
        $llistCalcul = array("Additions", "Soustractions", "Divers", "Multiplications");

        foreach ($listLecture as $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Lecture"));

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Lecture.".$activite->getName(), $activite);
        }
        foreach ($listDictee as $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Dictée"));

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Dictée.".$activite->getName(), $activite);
        }
        foreach ($listConjugaison as $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Conjugaison"));

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Conjugaison.".$activite->getName(), $activite);
        }
        foreach ($listMaths as $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Maths"));

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Maths.".$activite->getName(), $activite);
        }
        foreach ($llistCalcul as $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Calcul"));

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Calcul.".$activite->getName(), $activite);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
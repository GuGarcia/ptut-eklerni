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
        $QMLecture = array(
            $this->getReference("Media.audio"),
            $this->getReference("Media.audio"),
            $this->getReference("Media.audio"),
            $this->getReference("Media.text")
        );
        $RMLecture = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.font"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        
        $listDictee = array("Syllabes", "Lettres", "Mots");
        $QMDictee = array(
            $this->getReference("Media.audio"),
            $this->getReference("Media.audio"),
            $this->getReference("Media.audio")
        );
        $RMDictee = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        
        $listConjugaison = array("Présent", "Futur", "Imparfait");
        $QMConjugaison = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        $RMConjugaison = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        
        $listMaths = array("Compter", "Lire", "Ecrire", "Ranger");
        $QMMaths = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.audio"),
            $this->getReference("Media.audio"),
            $this->getReference("Media.text")
        );
        $RMMaths = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        
        $llistCalcul = array("Additions", "Soustractions", "Divers", "Multiplications");
        $QMCalcul = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );
        $RMCalcul = array(
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text"),
            $this->getReference("Media.text")
        );

        foreach ($listLecture as $key => $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Lecture"));
            $activite->setQuestionMedia($QMLecture[$key]);
            $activite->setReponseMedia($RMLecture[$key]);

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Lecture.".$activite->getName(), $activite);
        }
        foreach ($listDictee as $key => $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Dictée"));
            $activite->setQuestionMedia($QMDictee[$key]);
            $activite->setReponseMedia($RMDictee[$key]);

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Dictée.".$activite->getName(), $activite);
        }
        foreach ($listConjugaison as $key => $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Conjugaison"));
            $activite->setQuestionMedia($QMConjugaison[$key]);
            $activite->setReponseMedia($RMConjugaison[$key]);

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Conjugaison.".$activite->getName(), $activite);
        }
        foreach ($listMaths as $key => $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Maths"));
            $activite->setQuestionMedia($QMMaths[$key]);
            $activite->setReponseMedia($RMMaths[$key]);

            $manager->persist($activite);
            $manager->flush();

            $this->addReference("Maths.".$activite->getName(), $activite);
        }
        foreach ($llistCalcul as $key => $activiteName) {
            $activite = new Activite();
            $activite->setName($activiteName);
            $activite->setMatiere($this->getReference("Calcul"));
            $activite->setQuestionMedia($QMCalcul[$key]);
            $activite->setReponseMedia($RMCalcul[$key]);

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
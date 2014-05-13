<?php
/**
 * Created by PhpStorm.
 * User: Cindy
 * Date: 14/04/14
 * Time: 15:22
 */

namespace Eklerni\DatabaseBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eklerni\DatabaseBundle\Entity\Serie;

class LoadSerieData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    function load(ObjectManager $manager)
    {
        $lectureSyllabes = array('Majuscule', 'Attaché', 'Script');
        $lectureMots = array('Jours de la semaine', 'Nombres de 10 à 20');
        $lecturePhrases = array('Niveau 1', 'Niveau 2', 'Niveau 3');
        $dicteeSyllabes = array('Série 1', 'Série 2', 'Série 3');
        $dicteeMots = array('Jours de la semaine', 'Nombres de 10 à 20');
        $conjugaisonPresent = array('Chanter', 'Finir', 'Etre');
        $conjugaisonImparfait = array('Chanter', 'Finir', 'Etre');
        $mathsCompter = array('Nombres inférieur à 10', 'Nombres inférieur à 20');
        $mathsLire = array('Chiffres', 'Dizaines');
        $mathsRanger = array('Nombres inférieur à 10', 'Nombres inférieur à 20');
        $calculAdditions = array('Table de 1', 'Table de 2');
        $calculSoustractions = array('Table de 1', 'Table de 2');
        $calculDivers = array('Compléments à 10', 'Doubles', 'Moitiés');
        $calculMultiplications = array('Table de 1', 'Table de 2');

        $isPublic = true;

        foreach ($lectureSyllabes as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Lecture.Syllabes"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($lectureMots as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Lecture.Mots"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($lecturePhrases as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Lecture.Phrases"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($dicteeSyllabes as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Dictée.Syllabes"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($dicteeMots as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Dictée.Mots"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($conjugaisonPresent as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Conjugaison.Présent"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($conjugaisonImparfait as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Conjugaison.Imparfait"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($mathsCompter as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Maths.Compter"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($mathsLire as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Maths.Lire"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($mathsRanger as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Maths.Ranger"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($calculAdditions as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Calcul.Additions"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($calculSoustractions as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Calcul.Soustractions"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($calculDivers as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Calcul.Divers"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }

        foreach ($calculMultiplications as $serieName) {
            $serie = new Serie();
            $serie->setNom($serieName);
            $serie->setActivite($this->getReference("Calcul.Multiplications"));
            $serie->setDifficulte(1);
            $serie->setEnseignant($this->getReference("admin"));
            $serie->setDifficulte(3);
            $serie->setNiveau("CE1");

            if ($isPublic == true) {
                $serie->setPublic(true);
            }
            else {
                $serie->setPublic(false);
            }

            $manager->persist($serie);
            $manager->flush();

            $isPublic = !$isPublic;
        }
    }

    /**
     * {@inheritdoc}
     */
    function getOrder()
    {
        return 30;
    }
} 
<?php

namespace Eklerni\RESTBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\Personne;
use Eklerni\DatabaseBundle\Entity\Question;
use Eklerni\DatabaseBundle\Entity\Reponse;
use Eklerni\DatabaseBundle\Entity\Resultat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function usersAction(Request $request)
    {
        $retour = array();
        $this->putPersonnesInArray(
            $retour,
            $this->get('eklerni.manager.eleve')->findAll()
        );
        return new Response(json_encode($retour));
    }

    public function exercicesAction(Request $request, $idEleve)
    {
        $retour = array();
            $eleve = $this->get('eklerni.manager.eleve')->findById($idEleve);
            $attributions = $this->get('eklerni.manager.attribuer')->findByEleve($eleve);
            $this->putAttributionsInArray(
                $retour,
                $attributions
            );
        return new Response(json_encode($retour));
    }

    private function putAttributionsInArray(array &$array, $attributions)
    {
        /**
           $retour = array(
                'idmatiere' => array(
                    "id" => $idMatiere
                    "nom" => $nomMatiere
                    "activites" => array(
                        'idactivite' => array(
                            "id" => $idActivite
                            "nom" => $nomActivite
                            "exercices" => array(
                                "id" => idSerie,
                                "nom" => nomSerie,
                                "description" => descriptionSerie,
                                "difficulte" => difficulteSerie,
                                "niveau" => niveauSerie
                                "questions" => array(
                                    questionId => array(

                                        "id" => questionId,
                                        "label" => questionLabel,
                                        "media" => questionMediaUrl,
                                        "mediaType" => questionMedia,
                                        "reponses" => array(
                                            idreponse => array(

                                                "id" => reponseId,
                                                "label" => reponseLabel,
                                                "media" => reponseMediaUrl,
                                                "mediaType" => reponseMedia,

                                            ), ... others reponses
                                        )
                                    ), ... others questions
                                )
                            ),
                         'idactivite" => array(),
                         ...
                        )
                    )
                ),
                'idmatiere' => array(),
                ...
           )
         **/
        /** @var Attribuer $attribution */
        foreach ($attributions as $attribution) {
            if ($attribution->getIsActive()) {
                $matiere = $attribution->getSerie()->getActivite()->getMatiere();
                $activite = $attribution->getSerie()->getActivite();
                $serie = $attribution->getSerie();

                if (!isset($array[$matiere->getId()])) {
                    $array[$matiere->getId()] = array(
                        "id" => $matiere->getId(),
                        "nom" => $matiere->getName(),
                        "activites" => array()
                    );
                }
                if (!isset($array[$matiere->getId()]["activites"][$activite->getId()])) {
                    $array[$matiere->getId()]["activites"][$activite->getId()] = array(
                        "id" => $activite->getId(),
                        "nom" => $activite->getName(),
                        "exercices" => array()
                    );
                }
                $exercice = array(
                    "id" => $serie->getId(),
                    "nom" => $serie->getNom(),
                    "description" => $serie->getDescription(),
                    "difficulte" => $serie->getDifficulte(),
                    "niveau" => $serie->getNiveau(),
                    "questions" => array()
                );

                /** @var Question $question */
                foreach ($serie->getQuestions() as $question) {
                    $exercice["questions"][$question->getId()] = array(
                        "id" => $question->getId(),
                        "label" => $question->getLabel(),
                        "media" => $question->getMediaUrl(),
                        "mediaType" => $question->getMedia()->getMedia(),
                        "reponses" => array()
                    );
                    /** @var Reponse $reponse */
                    foreach ($question->getReponses() as $reponse) {
                        $exercice["questions"][$question->getId()]["reponses"][$reponse->getId()] = array(
                            "id" => $reponse->getId(),
                            "label" => $reponse->getLabel(),
                            "media" => $reponse->getMediaUrl(),
                            "mediaType" => $reponse->getMedia()->getMedia(),
                            "valid" => $reponse->getValid()
                        );
                    }
                }
                $array[$matiere->getId()]["activites"][$activite->getId()]["exercice"][$serie->getId()] = $exercice;
            }
        }
    }

    private function putPersonnesInArray(array &$array, $personnes)
    {
        /** @var Personne $personne */
        foreach ($personnes as $personne) {
            if ($personne->getIsActive()) {
                $temp = array(
                    "id" => $personne->getId(),
                    "pseudo" => $personne->getUsername(),
                    "password" => $personne->getPassword(),
                    "salt" => $personne->getSalt(),
                    "nom" => $personne->getNom(),
                    "prenom" => $personne->getPrenom()
                );
                $array[$personne->getId()] = $temp;
            }
        }
    }

    public function generateResultatAction($nb = 1) {
        $eleves = $this->get('eklerni.manager.eleve')->findAll();
        for($i=0;$i<$nb;$i++) {
            shuffle($eleves);
            /** @var Attribuer $attribution */
            $attributions = $this->get('eklerni.manager.attribuer')->findByEleve($eleves[0]);
            shuffle($attributions);
            $attribution = $attributions[0];
            $resultat = new Resultat();
            $resultat->setEleve($eleves[0]);
            $resultat->setSerie($attribution->getSerie());

            $note = rand(0,100);
            $resultat->setIsTest((rand(0,1) > 0.5)?false:true);

            if($resultat->getIsTest()) {
                $requete = $this->get('eklerni.manager.resultat')->findResults(array(
                    "serie" => $resultat->getSerie(),
                    "eleve" => $resultat->getEleve(),
                    "isTest" => true
                ));
                if(count($requete) > 0) {
                    /** @var Resultat $resultat */
                    $resultat = $requete[0];
                    if($note < $resultat->getNote()) {
                        $note = $resultat->getNote();
                        $resultat->setIsTest(false);
                    }
                }
            }
            $resultat->setNote($note);
            $resultat->setAttribution($attribution);


            $this->get('eklerni.manager.resultat')->save($resultat);
            //sleep(1);
        }
        return new Response();
    }

}

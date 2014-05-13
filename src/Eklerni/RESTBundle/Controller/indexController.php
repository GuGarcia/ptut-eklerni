<?php

namespace Eklerni\RESTBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\Personne;
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
            $eleve = $this->get('eklerni.manager.eleve')->findById($idEleve)[0];
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
                                //TODO ADD QUESTION REPONSE

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
                        "exercice" => array()
                    );
                }
                $array[$matiere->getId()]["activites"][$activite->getId()]["exercice"][$serie->getId()] = array(
                    "id" => $serie->getId(),
                    "nom" => $serie->getNom(),
                    "description" => $serie->getDescription(),
                    "difficulte" => $serie->getDifficulte(),
                    "niveau" => $serie->getNiveau()
                );

                //TODO ADD QUESTION & REPONSE
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

}

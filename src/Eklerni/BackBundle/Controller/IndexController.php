<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $enseignant = $this->getUser();
        $eleves = $this->get("eklerni.manager.eleve")->findByProf($enseignant);
        $classes = $this->get("eklerni.manager.classe")->findByProf($enseignant);
        $resultats = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "enseignant" => $enseignant,
            ),
            10,
            array(
                "champs" => "r.dateCreation",
                "order" => "desc"
            )
        );

        return $this->render(
            'EklerniBackBundle:Index:index.html.twig',
            array(
                "title" => $this->get('translator')->trans("title.accueil"),
                "eleves" => $eleves,
                "enseignant" => $enseignant,
                "classes" => $classes,
                "resultats" => $resultats
            )
        );
    }
} 
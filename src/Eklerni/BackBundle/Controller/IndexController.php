<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function lastresutlatAction(Request $request)
    {
        $reponse = new Response();
        if ($request->isXmlHttpRequest()) {
            $lastdate = $request->get("lastdate");
            $lastdate = str_replace("/", "-", $lastdate);
            $resultats = $this->get('eklerni.manager.resultat')->findResults(
                array(
                    "dateCreate" => new \DateTime($lastdate),
                    "enseignant" => $this->getUser()
                ), 10,
                array(
                    "champs" => "r.dateCreation",
                    "order" => "desc"
                )
            );
            $reponse->setContent(
                $this->render(
                    "@EklerniBack/Index/lastresultat.html.twig",
                    array(
                        "resultats" => $resultats,
                        "lastresultat" => new \DateTime($lastdate)
                    )
                )
            );
        }
        return $reponse;
    }
} 
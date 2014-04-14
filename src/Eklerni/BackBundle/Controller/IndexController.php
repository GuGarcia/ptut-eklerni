<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $enseignant = $this->get("eklerni.manager.enseignant")->findById($this->get("security.context")->getToken()->getUser()->getId())[0];
        $eleves = $this->get("eklerni.manager.eleve")->findByProf($enseignant);
        $classes = $this->get("eklerni.manager.classe")->findByProf($enseignant);

        return $this->render(
            'EklerniBackBundle:Index:index.html.twig',
            array(
                "title" => $this->get('translator')->trans("title.accueil"),
                "eleves" => $eleves,
                "enseignant" => $enseignant,
                "classes" => $classes,
            )
        );
    }
} 
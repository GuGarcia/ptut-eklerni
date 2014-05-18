<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectionController extends Controller
{
    public function indexAction()
    {
        $ecoles = $this->get("eklerni.manager.ecole")->findAll();
        $enseignants = $this->get("eklerni.manager.enseignant")->findAll();
        $matieres = $this->get("eklerni.manager.matiere")->findAll();
        
        return $this->render(
            'EklerniBackBundle:Direction:index.html.twig',
            array(
                "ecoles" => $ecoles,
                "enseignants" => $enseignants,
                "matieres" => $matieres,
                "title" => $this->get('translator')->trans("title.direction")
            )
        );
    }
    
    public function ajouterProfesseurAction(Request $request)
    {
        return new Response();
    }
}

<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eklerni\DatabaseBundle\Entity\Ecole;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectionController extends Controller
{
    public function indexAction()
    {
        //TODO list of ecole
        $ecoles = $this->get("eklerni.manager.ecole")->findAll();
        //TODO list of professeur
        $enseignants = $this->get("eklerni.manager.enseignant")->findAll();
        
        return $this->render(
            'EklerniBackBundle:Direction:index.html.twig',
            array(
                "ecoles" => $ecoles,
                "enseignants" => $enseignants,
                "title" => $this->get('translator')->trans("title.direction")
            )
        );
    }
    
    public function ajouterEcoleAction(Request $request)
    {
        $ecole = new Ecole();

        $form = $this->createForm('eklerni_ecole', $ecole);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.ecole")->save($ecole);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render(
                'EklerniBackBundle:Ecole:ajouter.html.twig',
                array("form" => $form->createView(), "title" => $this->get('translator')->trans("title.create_ecole"))
            );
        }
    }
    
    public function ajouterProfesseurAction(Request $request)
    {
        return new Response();
    }
}

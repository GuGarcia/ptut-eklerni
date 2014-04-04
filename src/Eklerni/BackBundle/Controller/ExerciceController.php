<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExerciceController extends Controller {

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EklerniBackBundle:Exercice:index.html.twig', array("title" => "Exercice"));
    }
} 
<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EleveController extends Controller{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EklerniBackBundle:Eleve:index.html.twig', array("title" => "Élève"));
    }
} 
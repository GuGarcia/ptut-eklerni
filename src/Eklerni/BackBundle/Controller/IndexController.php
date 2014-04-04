<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EklerniBackBundle:Index:index.html.twig', array("title" => "Accueil"));
    }
} 
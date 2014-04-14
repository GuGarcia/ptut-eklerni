<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EklerniBackBundle:Statistique:index.html.twig', array("title" => $this->get('translator')->trans("title.statistiques")));
    }
} 
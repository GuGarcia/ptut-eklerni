<?php

namespace Eklerni\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eklerni\CASBundle\Manager\ClasseManager;

class ClasseController extends Controller
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $classes = $this->get("eklerni.manager.classe")->findAll();
        return $this->render('EklerniBackBundle:Classe:index.html.twig', array("classes" => $classes));
    }

    public function updateAction() {

    }


}

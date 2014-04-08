<?php

namespace Eklerni\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EklerniFrontBundle:Default:index.html.twig');
    }
}

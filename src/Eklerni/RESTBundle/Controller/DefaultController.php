<?php

namespace Eklerni\RESTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EklerniRESTBundle:Default:index.html.twig', array('name' => $name));
    }
}

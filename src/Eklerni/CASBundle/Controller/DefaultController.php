<?php

namespace Eklerni\CASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('EklerniCASBundle:Default:index.html.twig');
    }
}

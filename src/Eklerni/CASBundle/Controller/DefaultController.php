<?php

namespace Eklerni\CASBundle\Controller;

use Eklerni\CASBundle\Form\Type\ClasseType;
use Eklerni\CASBundle\Form\Type\EcoleType;
use Eklerni\CASBundle\Form\Type\EnseignantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm('eklerni_eleve');

        return $this->render('EklerniCASBundle:Default:index.html.twig', array(
                'form' => $form->createView()
            )
        );
    }
}

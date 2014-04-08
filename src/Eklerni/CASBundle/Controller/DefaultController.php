<?php

namespace Eklerni\CASBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Eleve;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $eleve = new Eleve();
        $form = $this->createForm('eklerni_eleve', $eleve);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($eleve);
            $password = $encoder->encodePassword($eleve->getPassword(), $eleve->getSalt());

            if (!$encoder->isPasswordValid($password, $eleve->getPassword(), $eleve->getSalt())) {
                throw new \Exception('Password incorrectly encoded during user registration');
            } else {
                $eleve->setPassword($password);
            }

            $this->get('eklerni.manager.eleve')->save($eleve, true);
        }

        return $this->render('EklerniCASBundle:Default:index.html.twig', array(
                'form' => $form->createView()
            )
        );
    }
}

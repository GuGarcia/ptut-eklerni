<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EnseignantController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $enseignant = new Enseignant();

        $form = $this->createForm('eklerni_enseignant', $enseignant);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($enseignant);
            $password = $encoder->encodePassword($enseignant->getNewPassword(), $enseignant->getSalt());

            if (!$encoder->isPasswordValid($password, $enseignant->getNewPassword(), $enseignant->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.encode_error');
            } else {
                $enseignant->setPassword($password);
            }

            $this->get("eklerni.manager.enseignant")->save($enseignant);

            return $this->redirect(
                $this->generateUrl(
                    'eklerni_back_direction'
                )
            );
        } else {
            return $this->render(
                'EklerniBackBundle:Enseignant:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("enseignant.add")
                )
            );
        }
    }

    public function modifierAction($idEnseignant)
    {

    }
}
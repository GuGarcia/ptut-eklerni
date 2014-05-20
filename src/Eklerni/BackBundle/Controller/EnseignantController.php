<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eklerni\BackBundle\Utils\EklerniUtils;

class EnseignantController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $enseignant = new Enseignant();

        $form = $this->createForm('eklerni_enseignant_create', $enseignant);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');
            $enseignant->setPassword(EklerniUtils::cleanUsername($enseignant->getNom().".".$enseignant->getPrenom()));
            echo EklerniUtils::cleanUsername($enseignant->getNom().".".$enseignant->getPrenom());
            $encoder = $factory->getEncoder($enseignant);
            $password = $encoder->encodePassword($enseignant->getPassword(), $enseignant->getSalt());

            if (!$encoder->isPasswordValid($password, $enseignant->getPassword(), $enseignant->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.encode_error');
            } else {
                $enseignant->setPassword($password);
            }
            $this->get('eklerni.manager.enseignant')->defineUsername($enseignant);
            $enseignant->upload();
            $this->get("eklerni.manager.enseignant")->save($enseignant);


            $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("enseignant.add.success"));
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
}
<?php

namespace Eklerni\CASBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{

    public function registerAction(Request $request)
    {
        $enseignant = new Enseignant();
        $form = $this->createForm('eklerni_register', $enseignant);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');


            $encoder = $factory->getEncoder($enseignant);
            $password = $encoder->encodePassword($enseignant->getPassword(), $enseignant->getSalt());

            if (!$encoder->isPasswordValid($password, $enseignant->getPassword(), $enseignant->getSalt())) {
                throw new \Exception($this->get('translator')->trans('register.encode_error'));
            } else {
                $enseignant->setPassword($password);
            }

            $this->get('eklerni.manager.enseignant')->save($enseignant, true);

            return $this->redirect($this->generateUrl('eklerni_cas_login'));
        }

        return $this->render('EklerniCASBundle:Register:register.html.twig', array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.registration")
            )
        );
    }
}
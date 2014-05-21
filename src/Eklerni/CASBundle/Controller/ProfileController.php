<?php

namespace Eklerni\CASBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function changePasswordAction(Request $request)
    {
        /** @var Enseignant $enseignant */
        $enseignant = $this->get("security.context")->getToken()->getUser();
        $formError = null;

        $formProfile = $this->createForm('eklerni_password_change', $enseignant);

        $oldPassword = $enseignant->getPassword();

        $formProfile->handleRequest($request);

        if ($formProfile->isValid()) {
            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($enseignant);
            $password = $encoder->encodePassword($enseignant->getNewPassword(), $enseignant->getSalt());


            if (!$encoder->isPasswordValid($password, $enseignant->getNewPassword(), $enseignant->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.encode_error');
            } elseif ($oldPassword !== $encoder->encodePassword($enseignant->getPassword(), $enseignant->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.old_password_different');
            } else {
                $enseignant->setPassword($password);
            }

            if (!$formError) {
                $this->get('eklerni.manager.enseignant')->save($enseignant);

                $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("password_change.success"));
                return $this->redirect($this->generateUrl('eklerni_back_homepage'));
            }

        }

        return $this->render('EklerniCASBundle:Profile:passwordChange.html.twig', array(
                'form' => $formProfile->createView(),
                'form_error' => $formError,
                'title' => $this->get('translator')->trans("title.password_change")
            )
        );
    }

    public function updateProfileAction(Request $request)
    {
        /** @var Enseignant $enseignant */
        $enseignant = $this->get("security.context")->getToken()->getUser();
        $formProfile = $this->createForm('eklerni_profile_update', $enseignant);

        $formProfile->handleRequest($request);

        if ($formProfile->isValid()) {

            $this->get('eklerni.manager.enseignant')->save($enseignant);

            $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("profile.modify.success"));
            return $this->redirect($this->generateUrl('eklerni_back_homepage'));
        }

        return $this->render('EklerniCASBundle:Profile:profile.html.twig', array(
                'form' => $formProfile->createView(),
                'title' => $this->get('translator')->trans("title.profile")
            )
        );
    }
    public function redirectAction(Request $request)
    {
        $securityContext = $this->container->get('security.context');

        if ($securityContext->isGranted('ROLE_DIRECTEUR') || $securityContext->isGranted('ROLE_ENSEIGNANT')) {
            $response = new RedirectResponse($this->generateUrl('eklerni_back_homepage'));
        } elseif ($securityContext->isGranted('ROLE_ELEVE')) {
            $response = new RedirectResponse($this->generateUrl('eklerni_front_homepage'));
        }

        return $response;
    }
} 
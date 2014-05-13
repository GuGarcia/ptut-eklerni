<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller{

    /**
     * @param $idEleve
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idEleve)
    {
        $eleve = $this->get("eklerni.manager.eleve")->findById($idEleve)[0];
        $resultats = $this->get('eklerni.manager.resultat')->findByEleve($eleve, 10, array("champs" => "dateCreation", "order" => "desc"));
        return $this->render('EklerniBackBundle:Eleve:index.html.twig', array(
            "title" => "Élève ".$eleve->getNom()." ".$eleve->getPrenom(),
            "eleve" => $eleve,
            "resultats" => $resultats
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        /** @var Enseignant $prof */
        $prof = $this->get('security.context')->getToken()->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);

        return $this->render('EklerniBackBundle:Eleve:list.html.twig', array("title" => "Listes des Elèves par Classes","classes" => $classes));
    }

    public function modifierAction(Request $request, $idEleve) {
        /** @var Eleve $eleve */
        $eleve = $this->get("eklerni.manager.eleve")->findById($idEleve)[0];

        $form = $this->createForm('eklerni_eleve', $eleve);
        $form->handleRequest($request);

        $formError = null;

        if ($form->isValid()) {

            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($eleve);
            $password = $encoder->encodePassword($eleve->getNewPassword(), $eleve->getSalt());

            if (!$encoder->isPasswordValid($password, $eleve->getNewPassword(), $eleve->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.encode_error');
            } else {
                $eleve->setPassword($password);
            }

            if (!$formError) {
                $this->get('eklerni.manager.eleve')->save($eleve, true);
                return $this->redirect($this->generateUrl('eklerni_back_eleve'));
            }
        } else {
            return $this->render(
                'EklerniBackBundle:Eleve:modifier.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.modify_eleve")
                )
            );
        }
    }
} 
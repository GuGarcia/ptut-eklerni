<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EleveController extends Controller{

    /**
     * @param $idEleve
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idEleve)
    {
        $eleve = $this->get("eklerni.manager.eleve")->findById($idEleve)[0];
        return $this->render('EklerniBackBundle:Eleve:index.html.twig', array("title" => "Élève ".$eleve->getNom()." ".$eleve->getPrenom(), "eleve" => $eleve));
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
} 
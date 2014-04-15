<?php

namespace Eklerni\BackBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AttributionController extends Controller {

    public function indexAction() {
        $seriesProf = $this->get("eklerni.manager.serie")->findAllOrderByMatiereActiviteByProf($this->getUser());
        $prof = $this->get("eklerni.manager.enseignant")->findById($this->getUser()->getId())[0];
        return $this->render('EklerniBackBundle:Attribution:index.html.twig', array("title" => "Attribution des Exercice", "seriesProf" => $seriesProf, "prof" => $prof));
    }
}
<?php

namespace Eklerni\BackBundle\Controller;


use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributionController extends Controller
{

    public function indexAction()
    {
        $seriesProf = $this->get("eklerni.manager.serie")->findAllOrderByMatiereActiviteByProf($this->getUser());
        $prof = $this->get("eklerni.manager.enseignant")->findById($this->getUser()->getId())[0];
        return $this->render('EklerniBackBundle:Attribution:index.html.twig', array("title" => "Attribution des Exercices", "seriesProf" => $seriesProf, "prof" => $prof));
    }

    public function addSerieEleveAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $serie = $this->get("eklerni.manager.serie")->findById($request->get("idSerie"))[0];
            $eleve = $this->get("eklerni.manager.eleve")->findById($request->get("idEleve"))[0];
            $this->saveAttribution($serie, $eleve);
        }
        return new Response(json_encode(array()));
    }

    public function addSerieClasseAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var \Eklerni\DatabaseBundle\Entity\Serie * */
            $serie = $this->get("eklerni.manager.serie")->findById($request->get("idSerie"))[0];
            $classe = $this->get("eklerni.manager.classe")->findById($request->get("idClasse"))[0];

            foreach ($classe->getEleves() as $eleve) {
                $this->saveAttribution($serie, $eleve);
            }
        }
        return new Response(json_encode(array()));
    }

    private function saveAttribution(Serie $serie, Eleve $eleve)
    {
        $attribution = new Attribuer();
        $attribution->setEleve($eleve);
        $attribution->setSerie($serie);
        $attribution->setDateAttribution(new \DateTime());
        $attribution->setIsActive(false);
        $this->getDoctrine()->getManager()->persist($attribution);
        $this->getDoctrine()->getManager()->flush();
    }

}
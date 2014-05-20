<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributionController extends Controller
{

    public function indexAction()
    {
        $prof = $this->getUser();
        $seriesProf = $this->get("eklerni.manager.serie")->findAllOrderByMatiereActiviteByProf($prof);
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);
        $attributionClasses = array();
        foreach ($classes as $classe) {
            $attributionClasses[$classe->getId()] = $this->get("eklerni.manager.attribuer")->findByClasse($classe);
        }
        return $this->render('EklerniBackBundle:Attribution:index.html.twig', array(
            "title" => $this->get('translator')->trans("title.exercice.attribution"),
            "seriesProf" => $seriesProf,
            "prof" => $prof,
            "attributionClasses" => $attributionClasses
        ));
    }

    public function addSerieEleveAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $serie = $this->get("eklerni.manager.serie")->findById($request->get("idSerie"));
            $eleve = $this->get("eklerni.manager.eleve")->findById($request->get("idEleve"));
            $this->saveAttribution($serie, $eleve);
        }
        return new Response(json_encode(array()));
    }

    public function addSerieClasseAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var \Eklerni\DatabaseBundle\Entity\Serie * */
            $serie = $this->get("eklerni.manager.serie")->findById($request->get("idSerie"));
            $classe = $this->get("eklerni.manager.classe")->findById($request->get("idClasse"));

            foreach ($classe->getEleves() as $eleve) {
                $this->saveAttribution($serie, $eleve, true);
            }
        }
        return new Response(json_encode(array()));
    }

    public function activerAttributionAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $idType = $request->get("idType");
            $serie = $request->get("idSerie");
            $active = ($request->get("active") == "true")?true:false;
            $type = $request->get("type");
            $serie = $this->get("eklerni.manager.serie")->findById($serie);
            if ($type == "eleve") {
                $eleve = $idType;
                /** @var Eleve $eleve */
                $eleve = $this->get("eklerni.manager.eleve")->findById($eleve);
                $this->saveAttribution($serie, $eleve, false, $active);
            } else if ($type == "classe") {
                $classe = $idType;
                /** @var Classe $classe */
                $classe = $this->get("eklerni.manager.classe")->findById($classe);
                foreach ($classe->getEleves() as $eleve) {
                    $this->saveAttribution($serie, $eleve, true, $active);
                }
            }

        }
        return new Response(json_encode(array()));
    }

    public function deleteAttributionAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            if ($serie = $request->get("idSerie")) {
                /** @var Serie $serie */
                $serie = $this->get("eklerni.manager.serie")->findById($serie);
                if ($eleve = $request->get("idEleve")) {
                    /** @var Eleve $eleve */
                    $eleve = $this->get("eklerni.manager.eleve")->findById($eleve);
                    /** @var Attribuer $attribution */
                    $attribution = $this->get("eklerni.manager.attribuer")->findById($eleve, $serie)[0];
                    $this->get('eklerni.manager.attribuer')->remove($attribution);
                } else if ($classe = $request->get("idClasse")) {
                    /** @var Classe $classe */
                    $classe = $this->get("eklerni.manager.classe")->findById($classe);
                    foreach ($classe->getEleves() as $eleve) {
                        /** @var Attribuer $attribution */
                        $attribution = $this->get("eklerni.manager.attribuer")->findById($eleve, $serie)[0];
                        $this->get('eklerni.manager.attribuer')->remove($attribution);
                    }
                }
            }
        }
        return new Response(json_encode(array()));
    }



    private function saveAttribution(Serie $serie, Eleve $eleve, $isClasse = false, $isActive = false)
    {
        $query = $this->get("eklerni.manager.attribuer")->findById($eleve, $serie);
        if(isset($query[0])) {
            /** @var Attribuer $attribution */
            $attribution = $query[0];
            $attribution->setIsClasse($isClasse);
            $attribution->setIsActive($isActive);
        } else {
            $attribution = new Attribuer();
            $attribution->setEleve($eleve);
            $attribution->setSerie($serie);
            $attribution->setDateAttribution(new \DateTime());
            $attribution->setIsActive($isActive);
            $attribution->setIsClasse($isClasse);
        }
        $this->getDoctrine()->getManager()->persist($attribution);
        $this->getDoctrine()->getManager()->flush();
    }

}
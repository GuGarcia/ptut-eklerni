<?php

namespace Eklerni\BackBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Eklerni\DatabaseBundle\Entity\Attribuer;
use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TabletController extends Controller
{
    public function indexAction() {
        $classes = $this->get("eklerni.manager.classe")->findByProf($this->getUser());

        return $this->render('EklerniBackBundle:Tablet:index.html.twig', array(
            "title" => $this->get('translator')->trans("title.tablet"),
            "classes" => $classes
        ));
    }

    public function viewTabletAction(Request $request) {
        // [idActivite] => [attribution,attribution,...]
        $retour = array();
        if ($request->isXmlHttpRequest()) {
            $idType = $request->get("idType");
            $type = $request->get("type");
            if($type == "classe") {
                /** @var Classe $classe */
                $classe = $this->get("eklerni.manager.classe")->findById($idType)[0];
                $attributions = $this->get("eklerni.manager.attribuer")->findByClasse($classe);
                $this->putInView($retour, $attributions);
            } else if ($type == "eleve") {
                /** @var Eleve $eleve */
                $eleve = $this->get("eklerni.manager.eleve")->findById($idType)[0];
                $attributions = $this->get("eklerni.manager.attribuer")->findByEleve($eleve);
                $this->putInView($retour, $attributions);
            }
        }
        $matieres = $this->get("eklerni.manager.matiere")->findAll();
        return $this->render('EklerniBackBundle:Tablet:viewTablet.html.twig', array("attributions" => $retour, "matieres" => $matieres));
    }

    private function putInView(array &$array, $attributions) {
        /** @var Attribuer $attribution */
        foreach($attributions as $attribution) {
            if($attribution->getIsActive()) {
                $activite = $attribution->getSerie()->getActivite();
                $array[$activite->getId()][] = $attribution;
            }
        }
    }

} 
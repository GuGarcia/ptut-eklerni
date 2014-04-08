<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Ecole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eklerni\DatabaseBundle\Manager\ClasseManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    public function indexAction($idClasse)
    {
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
        $enseignants = $this->get("eklerni.manager.enseignant")->findAll();
        $i=0;
        foreach($enseignants as $enseignant) {
            foreach($classe->getEnseignants() as $prof) {
                if($enseignant->getId() == $prof->getId()) {
                    unset($enseignants[$i]);
                    break;
                }
            }
            $i++;
        }

        return $this->render('EklerniBackBundle:Classe:index.html.twig', array("classe" => $classe, "enseignants" => $enseignants, "title" => $classe->getNom()));
    }

    public function listAction()
    {
        $prof = $this->get('security.context')->getToken()->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);

        return $this->render('EklerniBackBundle:Classe:list.html.twig', array("classes" => $classes, "title" => "Classe"));
    }

    public function ajouterAction(Request $request)
    {
        $classe = new Classe();
        $enseignant = $this->get("security.context")->getToken()->getUser();
        $form = $this->createFormBuilder($classe);
        $this->get("eklerni.form.type.classe")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $classe->addEnseignant($enseignant);
            $enseignant->addClasse($classe);
            $this->get("eklerni.manager.classe")->save($classe);
            $this->get("eklerni.manager.enseignant")->save($enseignant);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render('EklerniBackBundle:Classe:ajouter.html.twig', array("form" => $form->createView(), "title" => "Création d'une Classe"));
        }
    }

    public function ajouterEcoleAction(Request $request)
    {
        $ecole = new Ecole();
        $form = $this->createFormBuilder($ecole);
        $this->get("eklerni.form.type.ecole")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.ecole")->save($ecole);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render('EklerniBackBundle:Classe:ajouter.html.twig', array("form" => $form->createView(), "title" => "Création d'une Ecole"));
        }
    }

    public function ajouterEleveAction(Request $request, $idClasse)
    {
        $eleve = new Eleve();
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
        $eleve->setClasse($classe);
        $form = $this->createFormBuilder($eleve);
        $this->get("eklerni.form.type.eleve")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.eleve")->save($eleve);
            return $this->redirect($this->generateUrl('eklerni_back_classe_fiche', array("id" => $idClasse)));
        } else {
            return $this->render('EklerniBackBundle:Classe:ajouter.html.twig', array("form" => $form->createView(), "title" => "Ajout d'un Eleve à la Classe : ".$classe->getNom()));
        }
    }
    public function ajouterEnseignantAction(Request $request, $idClasse) {
        if ($request->isXmlHttpRequest()) {
            $enseignant = $this->get("eklerni.manager.enseignant")->findById($request->get("idEnseignant"))[0];
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
            $enseignant->addClasse($classe);
            $classe->addEnseignant($enseignant);
            $this->get("eklerni.manager.classe")->save($classe);

            return new Response(json_encode(array()));
        }
    }

    public function updateAction()
    {

    }


}

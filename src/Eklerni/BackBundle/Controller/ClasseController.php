<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\CASBundle\Entity\Classe;
use Eklerni\CASBundle\Entity\Ecole;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eklerni\CASBundle\Manager\ClasseManager;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    public function indexAction($id) {
        $classe = $this->get("eklerni.manager.classe")->findById($id);

        return $this->render('EklerniBackBundle:Classe:index.html.twig', array("classe" => $classe, "title" => $classe[0]->getNom()));
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
        $form = $this->createFormBuilder($classe);
        $this->get("eklerni.form.type.classe")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $classe->setEnseignant($this->get("security.context")->getToken()->getUser());
            $this->get("eklerni.manager.classe")->save($classe);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render('EklerniBackBundle:Classe:ajouter.html.twig', array("form" => $form->createView(), "title" => "Création d'une Classe"));
        }
    }

    public function ajouterEcoleAction(Request $request) {
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

    public function updateAction()
    {

    }


}

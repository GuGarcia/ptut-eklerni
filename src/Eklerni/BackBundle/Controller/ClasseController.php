<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\CASBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eklerni\CASBundle\Manager\ClasseManager;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $prof = $this->get('security.context')->getToken()->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);
        return $this->render('EklerniBackBundle:Classe:index.html.twig', array("classes" => $classes, "title" => "Classe"));
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
            return $this->render('EklerniBackBundle:Classe:ajouter.html.twig', array("form" => $form->createView(), "title" => "Cration d'une Classe"));
        }
    }

    public function updateAction()
    {

    }


}

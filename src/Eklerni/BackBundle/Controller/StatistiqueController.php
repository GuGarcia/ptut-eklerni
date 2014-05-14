<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\BackBundle\Form\Type\ResultatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StatistiqueController extends Controller{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(
            new ResultatType(
                $this->get('security.context')->getToken()->getUser()
            ), null
        );
        $form->handleRequest($request);
        $resultats = null;
        if ($form->isValid()) {
           /* if($form->get("eleve")) {
                $condition['eleve'] = $form->get('eleve')->;
            }
            if($form->get("matiere")) {
                $condition['matiere'] = $form->get('matiere');
            }
            if($form->get("activite")) {
                $condition['activite'] = $form->get('activite');
            }
            if($form->get("serie")) {
                $condition['serie'] = $form->get('serie');
            }*/
            $resultats = $this->get('eklerni.manager.resultat')->findResults($form->getData(), 10);

        }

        return $this->render(
            'EklerniBackBundle:Statistique:index.html.twig',
            array(
                'title' => $this->get('translator')->trans("title.Statistiques"),
                'form' => $form->createView(),
                'resultats' => $resultats
            )
        );
    }
} 
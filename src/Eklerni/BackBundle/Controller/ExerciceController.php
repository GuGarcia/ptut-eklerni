<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Serie;
use Proxies\__CG__\Eklerni\CASBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExerciceController extends Controller {

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // Lister matière

        return $this->render('EklerniBackBundle:Exercice:index.html.twig', array(
                "title" => "Exercice"
            )
        );
    }

    public function ajouterAction(Request $request) {
        $serie = new Serie();
        /** @var \Eklerni\DatabaseBundle\Entity\Enseignant $enseignant */
        $enseignant = $this->get("security.context")->getToken()->getUser();
        $form = $this->createForm('eklerni_serie', $serie);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $serie->setEnseignant($enseignant);
            $enseignant->addSerie($serie);
            $this->get('eklerni.manager.serie')->save($serie, true);
        }

        return $this->render('EklerniBackBundle:Exercice:ajouter.html.twig', array(
                'form'  => $form->createView(),
                'title' => 'Création d\'une série',
            )
        );
    }

    public function listerMatiereAction() {

    }
} 
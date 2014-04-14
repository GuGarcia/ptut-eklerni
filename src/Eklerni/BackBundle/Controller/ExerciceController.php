<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Activite;
use Eklerni\DatabaseBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExerciceController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // Lister matière
        $matieres = $this->get('eklerni.manager.matiere')->findAll();

        return $this->render(
            'EklerniBackBundle:Exercice:index.html.twig',
            array(
                "title" => $this->get('translator')->trans("title.exercice"),
                "matieres" => $matieres,
            )
        );
    }

    public function ajouterAction(Request $request, $idActivite)
    {
        /** @var Activite $activite */
        $activite = $this->get('eklerni.manager.activite')->findById($idActivite)[0];

        if (!$activite) {
            throw new \Exception($this->get('translator')->trans('activite.notfound'));
        }

        $serie = new Serie();
        /** @var \Eklerni\DatabaseBundle\Entity\Enseignant $enseignant */
        $enseignant = $this->get("security.context")->getToken()->getUser();

        $form = $this->createForm('eklerni_serie', $serie);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $serie->setActivite($activite);
            $serie->setEnseignant($enseignant);
            $enseignant->addSerie($serie);

            $this->get('eklerni.manager.serie')->save($serie, true);
            return $this->redirect($this->generateUrl('eklerni_back_exercice'));
        }

        return $this->render(
            'EklerniBackBundle:Exercice:ajouter.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.create_serie"),
            )
        );
    }

    public function listerMatiereAction()
    {

    }
} 
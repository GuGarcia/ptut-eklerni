<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\BackBundle\Form\Type\SerieType;
use Eklerni\DatabaseBundle\Entity\Activite;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Eklerni\DatabaseBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciceController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        // Liste des matières
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
        /** @var Enseignant $enseignant */
        $enseignant = $this->get("security.context")->getToken()->getUser();

        $form = $this->createForm(
            new SerieType(
                ucfirst($activite->getQuestionMedia()->getMedia()),
                ucfirst($activite->getReponseMedia()->getMedia())
            ), $serie
        );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $serie->setActivite($activite);
            $serie->setEnseignant($enseignant);
            $enseignant->addSerie($serie);

            $this->get('eklerni.manager.serie')->save($serie, true);
            return $this->redirect($this->generateUrl('eklerni_back_exercice'));
        }

        return $this->render(
            'EklerniBackBundle:Exercice:form.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.create_serie"),
            )
        );
    }

    public function modifierAction(Request $request, $idSerie)
    {
        /** @var Serie $serie */
        $serie = $this->get('eklerni.manager.serie')->findById($idSerie)[0];

        if (!$serie) {
            throw new \Exception($this->get('translator')->trans('serie.notfound'));
        }

        $form = $this->createForm(
            new SerieType(
                ucfirst($serie->getActivite()->getQuestionMedia()->getMedia()),
                ucfirst($serie->getActivite()->getReponseMedia()->getMedia())
            ), $serie
        );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('eklerni.manager.serie')->save($serie, true);

            return $this->redirect($this->generateUrl('eklerni_back_exercice'));
        }

        return $this->render(
            'EklerniBackBundle:Exercice:form.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.modify_serie"),
            )
        );
    }

    public function supprimerAction(Request $request, $idSerie)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Serie $serie */
            $serie = $this->get('eklerni.manager.serie')->findById($idSerie)[0];

            /** @var Enseignant $enseignants */
            $enseignant = $this->get("security.context")->getToken()->getUser();

            if ($serie) {
                if ($serie->getListeAttribution()->count() == 0 and
                    $serie->getResultats()->count() == 0 and $serie->getEnseignant() == $enseignant) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($serie);
                    $em->flush();

                    return new Response(
                        json_encode(
                            array(
                                "success" => true,
                                "message" => $this->get('translator')->trans('serie.delete.success')
                            )
                        )
                    );
                }
            }
        }

        return new Response(
            json_encode(
                array(
                    "success" => false,
                    "message" => $this->get('translator')->trans('serie.delete.fail')
                )
            )
        );
    }
} 
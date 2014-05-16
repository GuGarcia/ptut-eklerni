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

    public function indexAction($idSerie) {
        /** @var Serie $serie */
        $serie = $this->get('eklerni.manager.serie')->findById($idSerie)[0];
        $lastResult = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "serie" => $serie
            ), 10,
            array(
                "champs" => "r.dateCreation",
                "order" => "desc"
            )
        );
        $moyenne = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "serie" => $serie,
                "moyenne" => "total"
            )
        )[0]["note"];
        return $this->render(
            'EklerniBackBundle:Exercice:index.html.twig',
            array(
                "title" => $this->get('translator')->trans("title.exercice")." ".ucfirst($serie->getNom()),
                "serie" => $serie,
                "resultats" => $lastResult,
                "note" => $moyenne
            )
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        // Liste des matières
        $matieres = $this->get('eklerni.manager.matiere')->findAll();

        return $this->render(
            'EklerniBackBundle:Exercice:newlist.html.twig',
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

            $this->get('eklerni.manager.serie')->save($serie);
            return $this->redirect($this->generateUrl('eklerni_back_exercice'));
        }

        return $this->render(
            'EklerniBackBundle:Exercice:form.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.exercice.create"),
            )
        );
    }

    public function modifierAction(Request $request, $idSerie)
    {
        /** @var Serie $serie */
        $serie = $this->get('eklerni.manager.serie')->findById($idSerie)[0];

        if (!$serie) {
            throw new \Exception($this->get('translator')->trans('exercice.notfound'));
        }

        $form = $this->createForm(
            new SerieType(
                ucfirst($serie->getActivite()->getQuestionMedia()->getMedia()),
                ucfirst($serie->getActivite()->getReponseMedia()->getMedia())
            ), $serie
        );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('eklerni.manager.serie')->save($serie);

            return $this->redirect($this->generateUrl('eklerni_back_exercice'));
        }

        return $this->render(
            'EklerniBackBundle:Exercice:form.html.twig',
            array(
                'form' => $form->createView(),
                'title' => $this->get('translator')->trans("title.exercice.modify"),
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
                                "message" => $this->get('translator')->trans('exercice.delete.success')
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
                    "message" => $this->get('translator')->trans('exercice.delete.fail')
                )
            )
        );
    }

    public function dupliquerAction(Request $request, $idSerie)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Serie $serie */
            $serie = $this->get('eklerni.manager.serie')->findById($idSerie)[0];

            $newSerie = $serie->duplicate();
            $newSerie->setEnseignant($this->get("security.context")->getToken()->getUser());

            $this->get('eklerni.manager.serie')->save($newSerie);

            return new Response(
                json_encode(
                    array(
                        "success" => true,
                        "message" => $this->get('translator')->trans('exercice.duplicate.success')
                    )
                )
            );
        }

        return new Response(
            json_encode(
                array(
                    "success" => false,
                    "message" => $this->get('translator')->trans('exercice.duplicate.fail')
                )
            )
        );
    }
}

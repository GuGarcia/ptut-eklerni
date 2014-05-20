<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Activite;
use Eklerni\DatabaseBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiviteController extends Controller
{
    public function ajouterAction(Request $request, $idMatiere)
    {
        /** @var Matiere $matiere */
        $matiere = $this->get('eklerni.manager.matiere')->findById($idMatiere);
        if (!$matiere) {
            throw $this->createNotFoundException($this->get("translator")->trans("matiere.notfound"));
        }

        /** @var Activite $activite */
        $activite = new Activite();

        $activite->setMatiere($matiere);

        $form = $this->createForm('eklerni_activite', $activite);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.activite")->save($activite);

            $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("activite.add.success"));
            return $this->redirect($this->generateUrl('eklerni_back_direction'));
        } else {
            return $this->render(
                'EklerniBackBundle:Activite:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.create_activite")
                )
            );
        }
    }

    public function modifierAction(Request $request, $idActivite)
    {
        /** @var Activite $activite */
        $activite = $this->get("eklerni.manager.activite")->findById($idActivite);
        if (!$activite) {
            throw $this->createNotFoundException($this->get("translator")->trans("activite.notfound"));
        }
        
        $form = $this->createForm('eklerni_activite', $activite);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.activite")->save($activite);

            $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("activite.modify.success"));
            return $this->redirect($this->generateUrl('eklerni_back_direction'));
        } else {
            return $this->render(
                'EklerniBackBundle:Activite:modifier.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.modify_activite")
                )
            );
        }
    }

    public function supprimerAction(Request $request, $idActivite)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Activite $activite */
            $activite = $this->get("eklerni.manager.activite")->findById($idActivite);
            if (!$activite) {
                return new Response(
                    json_encode(
                        array(
                            "success" => false,
                            'message' => $this->get("translator")->trans("activite.notfound")
                        )
                    )
                );
            }
            
            if (0 === $activite->getSeries()->count()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($activite);
                $em->flush();

                return new Response(
                    json_encode(
                        array(
                            "success" => true,
                            'message' => $this->get('translator')->trans('activite.delete.success')
                        )
                    )
                );
            }
        }
        return new Response(
            json_encode(
                array(
                    "success" => false,
                    'message' => $this->get('translator')->trans('activite.delete.fail')
                )
            )
        );
    }
}

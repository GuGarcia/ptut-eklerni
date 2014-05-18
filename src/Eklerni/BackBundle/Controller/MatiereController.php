<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatiereController extends Controller
{
    public function ajouterAction(Request $request)
    {
        /** @var Matiere $matiere */
        $matiere = new Matiere();

        $form = $this->createForm('eklerni_matiere', $matiere);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.matiere")->save($matiere);
            return $this->redirect($this->generateUrl('eklerni_back_direction'));
        } else {
            return $this->render(
                'EklerniBackBundle:Matiere:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.create_matiere")
                )
            );
        }
    }

    public function modifierAction(Request $request, $idMatiere)
    {
        /** @var Matiere $matiere */
        $matiere = $this->get("eklerni.manager.matiere")->findById($idMatiere);
        if (!$matiere) {
            throw $this->createNotFoundException($this->get("translator")->trans("matiere.notfound"));
        }

        $form = $this->createForm('eklerni_matiere', $matiere);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.matiere")->save($matiere);
            return $this->redirect($this->generateUrl('eklerni_back_direction'));
        } else {
            return $this->render(
                'EklerniBackBundle:Matiere:modifier.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.modify_matiere")
                )
            );
        }
    }

    public function supprimerAction(Request $request, $idMatiere)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Matiere $matiere */
            $matiere = $this->get("eklerni.manager.matiere")->findById($idMatiere);
            if (!$matiere) {
                throw $this->createNotFoundException($this->get("translator")->trans("matiere.notfound"));
            }

            if ($matiere) {
                if (0 === $matiere->getActivites()->count()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($matiere);
                    $em->flush();

                    return new Response(
                        json_encode(
                            array(
                                "success" => true,
                                'message' => $this->get('translator')->trans('matiere.delete.success')
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
                    'message' => $this->get('translator')->trans('matiere.delete.fail')
                )
            )
        );
    }
}

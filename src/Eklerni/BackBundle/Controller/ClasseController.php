<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Eklerni\DatabaseBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    public function indexAction($idClasse)
    {
        /** @var Classe $classe */
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
        $enseignants = $this->get("eklerni.manager.enseignant")->findAll();
        $i = 0;

        foreach ($enseignants as $enseignant) {
            foreach ($classe->getEnseignants() as $prof) {
                if ($enseignant->getId() == $prof->getId()) {
                    unset($enseignants[$i]);
                    break;
                }
            }
            $i++;
        }
        $matieres = $this->get("eklerni.manager.matiere")->findAll();

        $bests = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "classe" => $classe,
                "moyenne" => "eleve"
            ),
            3,
            array(
                "champs" => "note",
                "order" => "desc"
            )
        );

        $worsts = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "classe" => $classe,
                "moyenne" => "eleve"
            ),
            5,
            array(
                "champs" => "note",
                "order" => "asc"
            )
        );

        return $this->render(
            'EklerniBackBundle:Classe:index.html.twig',
            array(
                "classe" => $classe,
                "enseignants" => $enseignants,
                "title" => $this->get('translator')->trans("Classe %name%", array("%name%" => $classe->getNom())),
                "matieres" => $matieres,
                "bests" => $bests,
                "worsts" => $worsts
            )
        );
    }

    public function listAction()
    {
        $prof = $this->get('security.context')->getToken()->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);

        return $this->render(
            'EklerniBackBundle:Classe:list.html.twig',
            array(
                "classes" => $classes,
                "title" => $this->get('translator')->trans("title.classe")
            )
        );
    }

    public function ajouterAction(Request $request)
    {
        $classe = new Classe();
        /** @var Enseignant $enseignants */
        $enseignant = $this->get("security.context")->getToken()->getUser();

        $form = $this->createForm('eklerni_classe', $classe);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $classe->addEnseignant($enseignant);
            $enseignant->addClasse($classe);
            $this->get("eklerni.manager.classe")->save($classe);
            $this->get("eklerni.manager.enseignant")->save($enseignant);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render(
                'EklerniBackBundle:Classe:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.create_classe")
                )
            );
        }
    }

    public function modifierAction(Request $request, $idClasse)
    {
        /** @var Classe $classe */
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

        $form = $this->createForm('eklerni_classe', $classe);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.classe")->save($classe);

            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render(
                'EklerniBackBundle:Classe:modifier.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.modify_classe")
                )
            );
        }
    }

    public function supprimerAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Classe $classe */
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

            if ($classe) {
                if ($classe->getEleves()->count() == 0) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($classe);
                    $em->flush();

                    return new Response(
                        json_encode(
                            array(
                                "success" => true,
                                'message' => $this->get('translator')->trans('classe.delete.success')
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
                    'message' => $this->get('translator')->trans('classe.delete.fail')
                )
            )
        );
    }

    public function ajouterEnseignantAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Enseignant $enseignant */
            $enseignant = $this->get("eklerni.manager.enseignant")->findById($request->get("idEnseignant"))[0];
            /** @var Classe $classe */
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

            if ($classe) {
                $enseignant->addClasse($classe);
                $classe->addEnseignant($enseignant);

                $this->get("eklerni.manager.classe")->save($classe);

                return new Response(
                    json_encode(
                        array(
                            "success" => true,
                            'message' => $this->get('translator')->trans('classe.add.enseignant.success')
                        )
                    )
                );
            }
        }
        return new Response(
            json_encode(
                array(
                    "success" => false,
                    'message' => $this->get('translator')->trans('classe.add.enseignant.fail')
                )
            )
        );
    }

    public function saveMatieresAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Classe $classe */
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

            if ($classe) {
                $this->get("eklerni.manager.classe")->clearMatieres($classe);
                if ($request->get("matieres")) {
                    foreach ($request->get("matieres") as $idMatiere) {
                        /** @var Matiere $matiere */
                        $matiere = $this->get("eklerni.manager.matiere")->findById($idMatiere)[0];

                        if (get_class($matiere) == "Eklerni\\DatabaseBundle\\Entity\\Matiere") {
                            $classe->getMatieres()->removeElement($matiere);
                            $matiere->addClasse($classe);
                            $this->get("eklerni.manager.matiere")->save($matiere);
                            $classe->addMatiere($matiere);
                        }
                    }
                    $this->get("eklerni.manager.classe")->save($classe);
                }

                return new Response(
                    json_encode(
                        array(
                            "success" => true,
                            'message' => $this->get('translator')->trans('classe.save.matiere.success')
                        )
                    )
                );
            }
        }
        return new Response(
            json_encode(
                array(
                    "success" => false,
                    'message' => $this->get('translator')->trans('classe.save.matiere.fail')
                )
            )
        );
    }

    public function deleteEnseignantClasseAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var Classe $classe */
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

            if ($classe) {
                $this->get("eklerni.manager.classe")->clearEnseignants($classe);

                foreach ($request->get("profs") as $idEnseignant) {
                    /** @var Enseignant $prof */
                    $prof = $this->get("eklerni.manager.enseignant")->findById($idEnseignant)[0];

                    if (get_class($prof) == "Eklerni\\DatabaseBundle\\Entity\\Enseignant") {
                        $prof->addClasse($classe);
                        $this->get("eklerni.manager.enseignant")->save($prof);
                        $classe->addEnseignant($prof);
                    }
                }
                $this->get("eklerni.manager.classe")->save($classe);

                return new Response(
                    json_encode(
                        array(
                            "success" => true,
                            'message' => $this->get('translator')->trans('classe.delete.enseignant.success')
                        )
                    )
                );
            }
        }
        return new Response(
            json_encode(
                array(
                    "success" => false,
                    'message' => $this->get('translator')->trans('classe.delete.enseignant.fail')
                )
            )
        );
    }
}

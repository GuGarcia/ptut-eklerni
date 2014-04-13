<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Ecole;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    public function indexAction($idClasse)
    {
        /** @var Classe $classe */
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
        /** @var Enseignant $enseignants */
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

        return $this->render(
            'EklerniBackBundle:Classe:index.html.twig',
            array(
                "classe" => $classe,
                "enseignants" => $enseignants,
                "title" => "Classe " . $classe->getNom(),
                "matieres" => $matieres
            )
        );
    }

    public function listAction()
    {
        $prof = $this->get('security.context')->getToken()->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);

        return $this->render(
            'EklerniBackBundle:Classe:list.html.twig',
            array("classes" => $classes, "title" => "Classe")
        );
    }

    public function ajouterAction(Request $request)
    {
        $classe = new Classe();
        /** @var Enseignant $enseignants */
        $enseignant = $this->get("security.context")->getToken()->getUser();

        $form = $this->createFormBuilder($classe);
        $this->get("eklerni.form.type.classe")->buildForm($form, array());
        $form = $form->getForm();
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
                array("form" => $form->createView(), "title" => "Création d'une Classe")
            );
        }
    }

    public function ajouterEcoleAction(Request $request)
    {
        $ecole = new Ecole();
        $form = $this->createFormBuilder($ecole);
        $this->get("eklerni.form.type.ecole")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.ecole")->save($ecole);
            return $this->redirect($this->generateUrl('eklerni_back_classe'));
        } else {
            return $this->render(
                'EklerniBackBundle:Ecole:ajouter.html.twig',
                array("form" => $form->createView(), "title" => "Création d'une Ecole")
            );
        }
    }

    public function ajouterEleveAction(Request $request, $idClasse)
    {
        $eleve = new Eleve();
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
        $eleve->setClasse($classe);
        $form = $this->createFormBuilder($eleve);
        $this->get("eklerni.form.type.eleve")->buildForm($form, array());
        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("eklerni.manager.eleve")->save($eleve);
            return $this->redirect(
                $this->generateUrl(
                    'eklerni_back_classe_fiche',
                    array("idClasse" => $idClasse)
                )
            );
        } else {
            return $this->render(
                'EklerniBackBundle:Classe:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => "Ajout d'un Eleve à la Classe : " . $classe->getNom()
                )
            );
        }
    }

    public function ajouterEnseignantAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            $enseignant = $this->get("eklerni.manager.enseignant")->findById($request->get("idEnseignant"))[0];
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
            $enseignant->addClasse($classe);
            $classe->addEnseignant($enseignant);
            $this->get("eklerni.manager.classe")->save($classe);

            return new Response(json_encode(array()));
        }
    }

    public function saveMatieresAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];

            $this->get("eklerni.manager.classe")->clearMatieres($classe);
            foreach ($request->get("matieres") as $idMatiere) {
                $matiere = $this->get("eklerni.manager.matiere")->findById($idMatiere)[0];
                if (get_class($matiere) == "Eklerni\\DatabaseBundle\\Entity\\Matiere") {
                    $classe->getMatieres()->removeElement($matiere);
                    $matiere->addClasse($classe);
                    $this->get("eklerni.manager.matiere")->save($matiere);
                    $classe->addMatiere($matiere);
                }
            }
            $this->get("eklerni.manager.classe")->save($classe);

            return new Response(json_encode(array($classe)));
        }
    }

    public function deleteEnseignantClasseAction(Request $request, $idClasse)
    {
        if ($request->isXmlHttpRequest()) {
            $classe = $this->get("eklerni.manager.classe")->findById($idClasse)[0];
            $this->get("eklerni.manager.classe")->clearEnseignants($classe);
            foreach ($request->get("profs") as $idEnseignant) {
                $prof = $this->get("eklerni.manager.enseignant")->findById($idEnseignant)[0];
                if (get_class($prof) == "Eklerni\\DatabaseBundle\\Entity\\Enseignant") {
                    $prof->addClasse($classe);
                    $this->get("eklerni.manager.enseignant")->save($prof);
                    $classe->addEnseignant($prof);
                }
            }
            $this->get("eklerni.manager.classe")->save($classe);

            return new Response(json_encode(array($classe)));
        }
    }

    public function updateAction()
    {

    }


}

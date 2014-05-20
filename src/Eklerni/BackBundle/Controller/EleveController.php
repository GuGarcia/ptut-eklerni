<?php

namespace Eklerni\BackBundle\Controller;

use Eklerni\DatabaseBundle\Entity\Classe;
use Eklerni\DatabaseBundle\Entity\Eleve;
use Eklerni\DatabaseBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{
    public function indexAction($idEleve)
    {
        /** @var Eleve $eleve */
        $eleve = $this->get("eklerni.manager.eleve")->findById($idEleve);
        if (!$eleve) {
            throw $this->createNotFoundException($this->get("translator")->trans("eleve.notfound"));
        }

        $elevesClasse = $this->get("eklerni.manager.eleve")->findByClasse($eleve->getClasse());
        
        $resultats = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "eleve" => $eleve
            ),
            10,
            array(
                "champs" => "r.dateCreation",
                "order" => "desc"
            )
        );
        $moyennes = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "eleve" => $eleve,
                "moyenne" => "matiere",
                "istest" => true
            ),
            null,
            array(
                "champs" => "m.name",
                "order" => "asc"
            )
        );

        $moyennesClasse = $this->get('eklerni.manager.resultat')->findResults(
            array(
                "classe" => $eleve->getClasse(),
                "moyenne" => "matiere",
                "istest" => true
            ),
            null,
            array(
                "champs" => "m.name",
                "order" => "asc"
            )
        );

        return $this->render('EklerniBackBundle:Eleve:index.html.twig', array(
            "title" => $this->get("translator")->trans(
                "eleve.%nom%.%prenom%",
                array("%nom%" => $eleve->getNom(), "%prenom%" => $eleve->getPrenom())
            ),
            "eleve" => $eleve,
            "elevesClasse" => $elevesClasse,
            "resultats" => $resultats,
            "moyennes" => $moyennes,
            "moyennesClasse" => $moyennesClasse
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        /** @var Enseignant $prof */
        $prof = $this->getUser();
        $classes = $this->get("eklerni.manager.classe")->findByProf($prof);

        return $this->render(
            'EklerniBackBundle:Eleve:list.html.twig',
            array(
                "title" => $this->get('translator')->trans("eleve.list.by.classe"), 
                "classes" => $classes
            )
        );
    }

    public function ajouterAction(Request $request, $idClasse)
    {
        $eleve = new Eleve();
        /** @var Classe $classe */
        $classe = $this->get("eklerni.manager.classe")->findById($idClasse);
        if (!$classe) {
            throw $this->createNotFoundException($this->get("translator")->trans("classe.notfound"));
        }
        

        $form = $this->createForm('eklerni_eleve', $eleve);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $eleve->setClasse($classe);

            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($eleve);
            $password = $encoder->encodePassword($eleve->getPassword(), $eleve->getSalt());

            if (!$encoder->isPasswordValid($password, $eleve->getPassword(), $eleve->getSalt())) {
                throw new \Exception($this->get('translator')->trans('register.encode_error'));
            } else {
                $eleve->setPassword($password);
            }

            $this->get("eklerni.manager.eleve")->save($eleve);

            $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("eleve.add.success"));
            return $this->redirect(
                $this->generateUrl(
                    'eklerni_back_classe_fiche',
                    array("idClasse" => $idClasse)
                )
            );
        } else {
            return $this->render(
                'EklerniBackBundle:Eleve:ajouter.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans(
                            "Ajout d'un Eleve à la Classe : %name%",
                            array("%name%" => $classe->getNom())
                        )
                )
            );
        }
    }

    public function modifierAction(Request $request, $idEleve)
    {
        /** @var Eleve $eleve */
        $eleve = $this->get("eklerni.manager.eleve")->findById($idEleve);
        if (!$eleve) {
            throw $this->createNotFoundException($this->get("translator")->trans("eleve.notfound"));
        }

        $form = $this->createForm('eklerni_eleve', $eleve);
        $form->handleRequest($request);

        $formError = null;

        if ($form->isValid()) {

            /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactory $factory */
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($eleve);
            $password = $encoder->encodePassword($eleve->getNewPassword(), $eleve->getSalt());

            if (!$encoder->isPasswordValid($password, $eleve->getNewPassword(), $eleve->getSalt())) {
                $formError = $this->get('translator')->trans('password_change.encode_error');
            } else {
                $eleve->setPassword($password);
            }

            if (!$formError) {
                $this->get('eklerni.manager.eleve')->save($eleve);

                $this->get("session")->getFlashBag()->add("notice", $this->get("translator")->trans("eleve.modify.success"));
                return $this->redirect($this->generateUrl('eklerni_back_eleve_fiche', array("idEleve" => $eleve->getId())));
            }
        } else {
            return $this->render(
                'EklerniBackBundle:Eleve:modifier.html.twig',
                array(
                    "form" => $form->createView(),
                    "title" => $this->get('translator')->trans("title.modify_eleve")
                )
            );
        }
    }
} 
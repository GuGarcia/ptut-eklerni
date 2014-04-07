<?php
/**
 * Created by PhpStorm.
 * User: DiDiNe
 * Date: 20/03/14
 * Time: 13:18
 */

namespace Eklerni\CASBundle\Controller;


use Eklerni\CASBundle\Entity\Enseignant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller{

    public function registerAction(Request $request)
    {
        $enseignant = new Enseignant();
        $form = $this->createForm('eklerni_enseignant', $enseignant);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($enseignant);
            $password = $encoder->encodePassword($enseignant->getPassword(), $enseignant->getSalt());
            
            if (!$encoder->isPasswordValid($password, $enseignant->getPassword(), $enseignant->getSalt())) {
                throw new \Exception('Password incorrectly encoded during user registration');
            } else {
                $enseignant->setPassword($password);
            }
            //@todo correction of form type
            $enseignant->setDateNaissance(new \DateTime());
            $this->get('eklerni.manager.enseignant')->save($enseignant, true);
            
            return $this->redirect($this->generateUrl('eklerni_cas_login'));
        }

        return $this->render('EklerniCASBundle:Default:index.html.twig', array(
                'form' => $form->createView()
            )
        );
    }
}
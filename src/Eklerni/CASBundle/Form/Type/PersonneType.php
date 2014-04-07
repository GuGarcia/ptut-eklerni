<?php
/**
 * Created by PhpStorm.
 * User: Cindy
 * Date: 07/04/14
 * Time: 10:00
 */

namespace Eklerni\CASBundle\Form\Type;

use Eklerni\CASBundle\Repository\ClasseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'Nom d\'utilisateur'
            )
        );

        $builder->add(
            'password', 'password', array(
                'label' => 'Mot de passe'
            )
        );

        $builder->add(
            'nom', 'text', array(
                'label' => 'Nom'
            )
        );

        $builder->add(
            'prenom', 'text', array(
                'label' => 'Prénom'
            )
        );

        $builder->add(
            'dateNaissance', 'text', array(
                'label' => 'Date de Naissance'
            )
        );

        $builder->add('classe', 'entity', array(
                'label' => 'Classe',
                'class' => 'EklerniCASBundle:Classe',
                'property' => 'fullName',
                'query_builder' => function (ClasseRepository $cr) {
                        return $cr->findAll();
                },
            )
        );

        $builder->add(
            'valider', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-default'
                )
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_personne';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'inherit_data' => true
            ));
    }

}
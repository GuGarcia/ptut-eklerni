<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:36
 */

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'Nom d\'utilisateur'
            )
        );

        $builder->add(
            'password', 'text', array(
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
        return 'enseignant';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Enseignant',
        ));
    }
} 
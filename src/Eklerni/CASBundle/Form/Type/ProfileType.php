<?php

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'personne.username',
                'disabled' => true,
                'attr' => array(
                    'placeholder' => 'personne.username',
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'nom', 'text', array(
                'label' => 'personne.lastname',
                'attr' => array(
                    'autofocus' => 'autofocus',
                    'placeholder' => "personne.lastname",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'prenom', 'text', array(
                'label' => 'personne.firstname',
                'attr' => array(
                    'placeholder' => "personne.firstname",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'dateNaissance', 'date', array(
            'label' => 'personne.birthdate',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => array(
                'class' => 'masked_date form-control',
            )
        ));

        $builder->add(
            'valider', 'submit', array(
                'label' => "button.validation",
                'attr' => array(
                    'class' => 'btn bg-olive btn-block'
                )
            )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'intention' => 'update_profile'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_profile_update';
    }

}
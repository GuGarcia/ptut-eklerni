<?php

namespace Eklerni\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'personne.username',
                'attr' => array(
                    'placeholder' => 'personne.username',
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'password', 'password', array(
                'label' => 'personne.password',
                'attr' => array(
                    'placeholder' => "personne.password",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'nom', 'text', array(
                'label' => 'personne.lastname',
                'attr' => array(
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
                'label' => "personne.birthdate",
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'form-control masked_date'
                )
            )
        );

        $builder->add(
            'valider', 'submit', array(
                'label' => "button.validation",
                'attr' => array(
                    'class' => 'btn bg-olive btn-block'
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
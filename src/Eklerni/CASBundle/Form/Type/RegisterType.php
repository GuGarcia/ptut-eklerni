<?php

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'personne.username',
                'attr' => array(
                    'autofocus' => 'autofocus',
                    'placeholder' => 'personne.username',
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'personne.password.notequal',
                'options' => array('required' => true),
                'first_options' => array(
                    'label' => 'personne.password',
                    'attr' => array(
                        'placeholder' => 'personne.password',
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array(
                    'label' => 'personne.password.retype',
                    'attr' => array(
                        'placeholder' => 'personne.password',
                        'class' => 'form-control'
                    )
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
            'intention' => 'register'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_register';
    }

}
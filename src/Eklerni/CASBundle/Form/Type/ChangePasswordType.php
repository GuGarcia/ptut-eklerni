<?php

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
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
            'password', 'password', array(
                'label' => 'personne.password.old',
                'attr' => array(
                    'autofocus' => 'autofocus',
                    'placeholder' => "personne.password",
                    'class' => 'form-control'
                ),
                'required' => false
            )
        );

        $builder->add(
            'newpassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'personne.password.notequal',
                'required' => false,
                'first_options' => array(
                    'label' => 'personne.password.new',
                    'attr' => array(
                        'placeholder' => 'personne.password',
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array(
                    'label' => 'personne.password.new.retype',
                    'attr' => array(
                        'placeholder' => 'personne.password',
                        'class' => 'form-control'
                    )
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
            'intention' => 'password_change'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_password_change';
    }

}
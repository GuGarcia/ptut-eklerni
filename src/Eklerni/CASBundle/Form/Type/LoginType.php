<?php

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
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
            'intention' => 'authentication'
        ));
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_login';
    }

}
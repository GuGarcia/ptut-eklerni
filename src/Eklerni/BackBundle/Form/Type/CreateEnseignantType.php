<?php

namespace Eklerni\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateEnseignantType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'nom',
            'text',
            array(
                'label' => 'personne.lastname',
                'attr' => array(
                    'placeholder' => "personne.lastname",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'prenom',
            'text',
            array(
                'label' => 'personne.firstname',
                'attr' => array(
                    'placeholder' => "personne.firstname",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'email',
            'email',
            array(
                'max_length' => 255,
                'label' => 'personne.mail',
                'attr' => array(
                    'placeholder' => "personne.mail",
                    'class' => 'form-control'
                ),
                'required' => false
            )
        );

        $builder->add(
            'dateNaissance',
            'date',
            array(
                'label' => "personne.birthdate",
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'form-control masked_date'
                ),
                'required' => false
            )
        );

        $builder->add(
            'file',
            'file',
            array(
                'label' => 'personne.picture',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            )
        );

        $builder->add(
            'valider',
            'submit',
            array(
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
        return 'eklerni_enseignant_create';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'inherit_data' => false
            )
        );
    }


} 
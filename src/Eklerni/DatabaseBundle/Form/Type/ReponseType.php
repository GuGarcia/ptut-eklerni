<?php

namespace Eklerni\DatabaseBundle\Form\Type;

use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'label', 'text', array(
                'label' => 'reponse.label',
                'attr' => array(
                    'placeholder' => "reponse.label",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'mediaUrl', 'file', array(
                'label' => 'reponse.media.file',
                'attr' => array(
                    'placeholder' => "reponse.media.file",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'media', 'entity', array(
                'label' => 'reponse.media.type',
                'query_builder' => function (MediaRepository $er) {
                        return $er->findAll();
                    },
                'attr' => array(
                    'placeholder' => "reponse.media.type",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            "valid", "checkbox", array(
                'label'     => "reponse.valid",
                'required'  => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_reponse';
    }
} 
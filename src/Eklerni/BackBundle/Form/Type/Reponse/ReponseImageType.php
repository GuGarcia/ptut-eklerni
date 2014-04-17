<?php

namespace Eklerni\BackBundle\Form\Type\Reponse;

use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReponseImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'mediaUrl',
            'file',
            array(
                'label' => 'reponse.media.file.image',
                'attr' => array(
                    'placeholder' => "reponse.media.file",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'media',
            'entity',
            array(
                'class' => "EklerniDatabaseBundle:Media",
                'property' => 'media',
                'label' => 'reponse.media.type',
                'query_builder' => function (MediaRepository $er) {
                        return $er->findAll();
                    },
                'data' => 'image',
                'disabled' => true,
                'attr' => array(
                    'placeholder' => "reponse.media.type",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            "valid",
            "checkbox",
            array(
                'label' => "reponse.valid",
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'delete',
            'button',
            array(
                'attr' => array(
                    'class' => 'deleteReponse',
                    'label' => 'utils.delete'
                ),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_reponse_image';
    }
} 
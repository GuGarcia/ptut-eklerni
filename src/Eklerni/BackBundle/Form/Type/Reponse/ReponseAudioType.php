<?php

namespace Eklerni\BackBundle\Form\Type\Reponse;

use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReponseAudioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'mediaUrl',
            'url',
            array(
                'label' => 'reponse.media.file.audio',
                'attr' => array(
                    'placeholder' => "reponse.media.file.audio",
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
                        return $er->findByMedia('audio');
                    },
                'read_only' => true,
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
        return 'eklerni_reponse_audio';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Reponse',
            )
        );
    }
}
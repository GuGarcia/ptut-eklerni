<?php

namespace Eklerni\BackBundle\Form\Type\Question;

use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionImageType extends AbstractType
{
    private $_reponseMedia;

    public function __construct($reponseMedia)
    {
        $this->_reponseMedia = $reponseMedia;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'mediaUrl',
            'file',
            array(
                'label' => 'question.media.file.image',
                'attr' => array(
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
                'label' => 'question.media.type',
                'query_builder' => function (MediaRepository $er) {
                        return $er->findAll();
                    },
                'data' => 'image',
                'disabled' => true,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $reponseMediaType = "Eklerni\\BackBundle\\Form\\Type\\Reponse\\Reponse" . $this->_reponseMedia. "Type";
        $builder->add(
            'reponses',
            'collection',
            array(
                'type' => new $reponseMediaType(),
                'prototype_name' => '__reponse__',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        );

        $builder->add(
            'delete',
            'button',
            array(
                'attr' => array(
                    'class' => 'deleteQuestion',
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
        return 'eklerni_question_image';
    }
}
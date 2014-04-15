<?php

namespace Eklerni\DatabaseBundle\Form\Type;


use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'label', 'text', array(
                'label' => 'question.label',
                'attr' => array(
                    'placeholder' => "question.label",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'mediaUrl', 'file', array(
                'label' => 'question.media.file',
                'attr' => array(
                    'placeholder' => "question.media.file",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'media', 'entity', array(
                'label' => 'question.media.type',
                'query_builder' => function (MediaRepository $er) {
                    return $er->findAll();
                },
                'attr' => array(
                    'placeholder' => "question.media.type",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'reponses', 'collection', array(
                'type' => new ReponseType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_question';
    }
}
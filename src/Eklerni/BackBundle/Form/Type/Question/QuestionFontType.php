<?php

namespace Eklerni\BackBundle\Form\Type\Question;

use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionFontType extends AbstractType
{
    private $_reponseMedia;

    public function __construct($reponseMedia)
    {
        $this->_reponseMedia = $reponseMedia;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //todo label in choicetype with defined fonts
        $builder->add(
            'label',
            'text',
            array(
                'label' => 'question.label',
                'attr' => array(
                    'placeholder' => "question.label",
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
                        return $er->findByMedia("font");
                    },
                'read_only' => true,
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
                    'class' => 'deleteQuestion btn btn-danger',
                    'label' => 'question.delete'
                ),
            )
        );

        $builder->add(
            'addreponse',
            "button",
            array(
                'attr' => array(
                    'class' => 'addReponse btn btn-primary'
                ),
                'label' => 'reponse.add'
            )
        );

        $reponseMediaType = "Eklerni\\BackBundle\\Form\\Type\\Reponse\\Reponse" . $this->_reponseMedia . "Type";
        $builder->add(
            'reponses',
            'collection',
            array(
                'type' => new $reponseMediaType(),
                'prototype_name' => '__reponse__',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => "reponses.text"
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_question_font';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Question',
            )
        );
    }
}
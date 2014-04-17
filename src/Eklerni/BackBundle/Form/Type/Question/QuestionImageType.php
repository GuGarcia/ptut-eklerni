<?php

namespace Eklerni\BackBundle\Form\Type;

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

        $reponseMediaType = "Reponse" . $this->_questionMedia . "Type";
        $builder->add(
            'reponses',
            'collection',
            array(
                'type' => new $reponseMediaType($this->_reponseMedia),
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
        return 'eklerni_question_image';
    }
}
<?php

namespace Eklerni\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SerieQuestionType extends AbstractType
{

    private $_questionMedia;
    private $_reponseMedia;

    /**
     * @param string $questionMedia
     * @param string $reponseMedia
     */
    public function __construct($questionMedia, $reponseMedia)
    {
        $this->_questionMedia = $questionMedia;
        $this->_reponseMedia = $reponseMedia;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $questionMediaType = "Eklerni\\BackBundle\\Form\\Type\\Question\\Question" . $this->_questionMedia . "Type";
        $builder->add(
            'questions', 'collection', array(
                'type' => new $questionMediaType($this->_reponseMedia),
                'prototype_name' => '__question__',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
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
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_seriequestion';
    }
}
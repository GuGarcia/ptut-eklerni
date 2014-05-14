<?php

namespace Eklerni\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType
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
        $builder->add(
            'nom',
            'text',
            array(
                'label' => 'serie.name',
                'attr' => array(
                    'placeholder' => "serie.name",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'description',
            'textarea',
            array(
                'label' => 'serie.description',
                'attr' => array(
                    'placeholder' => "serie.description",
                    'class' => 'form-control'
                ),
                'required' => false
            )
        );

        $builder->add(
            'niveau', 'choice', array(
                'label' => 'serie.level',
                'choices' => array(
                    'CP'  => 'grade.year1',
                    'CE1' => 'grade.year2',
                    'CE2' => 'grade.year3',
                    'CM1' => 'grade.year4',
                    'CM2' => 'grade.year5'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'difficulte',
            'choice',
            array(
                'label' => "serie.difficulty",
                'choices' => array(
                    '1' => 'difficulte.niveau1',
                    '2' => 'difficulte.niveau2',
                    '3' => 'difficulte.niveau3',
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            "public",
            "checkbox",
            array(
                'label' => "serie.public",
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $questionMediaType = "Eklerni\\BackBundle\\Form\\Type\\Question\\Question" . $this->_questionMedia . "Type";
        $builder->add(
            'questions', 'collection', array(
                'type' => new $questionMediaType($this->_reponseMedia),
                'prototype_name' => '__question__',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => "questions.text"
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
        return 'eklerni_serie';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Serie',
            )
        );
    }
} 
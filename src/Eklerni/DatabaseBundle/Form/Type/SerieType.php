<?php

namespace Eklerni\DatabaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'nom', 'text', array(
                'label' => 'serie.name',
                'attr' => array(
                    'placeholder' => "serie.name",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'difficulte', 'choice', array(
                'label' => "serie.difficulty",
                'choices' => array(
                    '1' => 'difficulte.niveau.1',
                    '2' => 'difficulte.niveau.2',
                    '3' => 'difficulte.niveau.3',
                    '4' => 'difficulte.niveau.4',
                    '5' => 'difficulte.niveau.5'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            "public", "checkbox", array(
                'label'     => "serie.public",
                'required'  => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'valider', 'submit', array(
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
    public function getName() {
        return 'eklerni_serie';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\DatabaseBundle\Entity\Serie',
        ));
    }
} 
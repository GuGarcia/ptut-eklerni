<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:38
 */

namespace Eklerni\DatabaseBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'nom', 'text', array(
                'label' => 'serie.name'
            )
        );

        $builder->add(
            'difficulte', 'choice', array(
                'label' => "serie.difficulty",
                'choices' => array(
                    '1' => 'Niveau 1',
                    '2' => 'Niveau 2',
                    '3' => 'Niveau 3',
                    '4' => 'Niveau 4',
                    '5' => 'Niveau 5'
                )
            )
        );

        $builder->add(
            "public", "chackbox", array(
                'label' => "serie.public"
            )
        );

        $builder->add(
            'valider', 'submit', array(
                'label' => "button.validation"
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
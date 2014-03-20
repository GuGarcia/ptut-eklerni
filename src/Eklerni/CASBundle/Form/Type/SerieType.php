<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:38
 */

namespace Eklerni\CASBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SerieType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'name', 'text', array(
                'label' => 'Nom'
            )
        );

        $builder->add(
            'difficulte', 'choice', array(
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
            'valider', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-default'
                )
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return 'serie';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Serie',
        ));
    }
} 
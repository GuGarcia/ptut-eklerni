<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:30
 */

namespace Eklerni\CASBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'nom', 'text', array(
                'label' => 'Nom'
            )
        );

        $builder->add(
            'niveau', 'choice', array(
                'label' => 'Niveau',
                'choices' => array(
                    '1' => 'CP',
                    '2' => 'CE1',
                    '3' => 'CE2',
                    '4' => 'CM1',
                    '5' => 'CM2'
                )
            )
        );

        $builder->add('ecole', 'entity', array(
                'label' => 'Ecole',
                'class' => 'EklerniCASBundle:Ecole',
                'property' => 'fullName'
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
        return 'classe';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Classe',
        ));
    }
} 
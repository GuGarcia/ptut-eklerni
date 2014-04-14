<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:33
 */

namespace Eklerni\DatabaseBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EcoleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'nom', 'text', array(
                'label' => 'ecole.name',
                'attr' => array(
                    'placeholder' => "ecole.name",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'codePostal', 'text', array(
                'label' => 'ecole.postcode',
                'attr' => array(
                    'placeholder' => "ecole.postcode",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'ville', 'text', array(
                'label' => 'ecole.city',
                'attr' => array(
                    'placeholder' => "ecole.city",
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
        return 'eklerni_ecole';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\DatabaseBundle\Entity\Ecole',
        ));
    }
}
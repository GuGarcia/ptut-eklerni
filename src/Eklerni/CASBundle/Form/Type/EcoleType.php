<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:33
 */

namespace Eklerni\CASBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EcoleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'nom', 'text', array(
                'label' => 'ecole.name'
            )
        );

        $builder->add(
            'codePostal', 'text', array(
                'label' => 'ecole.postcode'
            )
        );

        $builder->add(
            'ville', 'text', array(
                'label' => 'ecole.city'
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
        return 'eklerni_ecole';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Ecole',
        ));
    }
}
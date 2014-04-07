<?php
/**
 * Created by PhpStorm.
 * User: Cindy
 * Date: 07/04/14
 * Time: 10:00
 */

namespace Eklerni\CASBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username', 'text', array(
                'label' => 'personne.username',
                'attr' => array(
                    'placeholder' => 'personne.username'
                )
            )
        );

        $builder->add(
            'password', 'password', array(
                'label' => 'personne.password',
                'attr' => array(
                    'placeholder' => "personne.password"
                )
            )
        );

        $builder->add(
            'nom', 'text', array(
                'label' => 'personne.lastname',
                'attr' => array(
                    'placeholder' => "personne.lastname"
                )
            )
        );

        $builder->add(
            'prenom', 'text', array(
                'label' => 'personne.firstname',
                'attr' => array(
                    'placeholder' => "personne.firstname"
                )
            )
        );

        $builder->add(
            'dateNaissance', 'date', array(
                'label' => "personne.birthdate",
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'placeholder' => "personne.birthdate"
                )
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
    public function getName()
    {
        return 'eklerni_personne';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'inherit_data' => true
            ));
    }

}
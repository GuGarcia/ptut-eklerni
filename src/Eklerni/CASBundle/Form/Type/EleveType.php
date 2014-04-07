<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:37
 */

namespace Eklerni\CASBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('eleve', new PersonneType(), array(
                'data_class' => 'Eklerni\CASBundle\Entity\Eleve'
            )
        );

        $builder->add(
            'classe', 'entity', array(
                'label'         => 'Classe',
                'class'         => 'EklerniCASBundle:Classe',
                'property'      => 'fullName',
                'query_builder' => function (ClasseRepository $cr) {
                        return $cr->findAll();
                    },
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_eleve';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Eleve',
        ));
    }
} 
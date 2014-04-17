<?php

namespace Eklerni\BackBundle\Form\Type;

use Eklerni\DatabaseBundle\Repository\ClasseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'enseignant',
            new PersonneType(),
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Enseignant'
            )
        );
        /*
                $builder->add(
                    'classes', 'entity', array(
                        'label' => 'Classe',
                        'property' => 'fullName',
                        'class' => 'EklerniDatabaseBundle:Classe',
                        'query_builder' => function (ClasseRepository $cr) {
                                return $cr->findAll();
                            },
                    )
                );*/
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'eklerni_enseignant';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Enseignant',
            )
        );
    }
} 
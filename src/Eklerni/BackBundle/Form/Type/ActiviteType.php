<?php

namespace Eklerni\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Eklerni\DatabaseBundle\Repository\MediaRepository;
use Eklerni\DatabaseBundle\Repository\MatiereRepository;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            'text',
            array(
                'label' => 'activite.name',
                'attr' => array(
                    'placeholder' => "activite.name",
                    'class' => 'form-control'
                )
            )
        );
        
        $builder->add(
            'description',
            'textarea',
            array(
                'label' => 'activite.description',
                'attr' => array(
                    'placeholder' => "activite.description",
                    'class' => 'form-control'
                )
            )
        );
        
        $builder->add(
            "questionMedia",
            "entity",
            array(
                'label' => 'question.media',
                'property' => 'media',
                'class' => 'EklerniDatabaseBundle:Media',
                'query_builder' => function (MediaRepository $cr) {
                        return $cr->findAll();
                },
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );
        
        $builder->add(
            "reponseMedia",
            "entity",
            array(
                'label' => 'reponse.media',
                'property' => 'media',
                'class' => 'EklerniDatabaseBundle:Media',
                'query_builder' => function (MediaRepository $cr) {
                        return $cr->findAll();
                },
                'attr' => array(
                    'class' => 'form-control'
                )
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
        return 'eklerni_activite';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Eklerni\DatabaseBundle\Entity\Activite',
            )
        );
    }
}

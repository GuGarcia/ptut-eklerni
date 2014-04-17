<?php

namespace Eklerni\BackBundle\Form\Type;

use Eklerni\DatabaseBundle\Repository\EcoleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nom', 'text', array(
                'label' => 'classe.name',
                'attr' => array(
                    'placeholder' => "classe.name",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'niveau', 'choice', array(
                'label' => 'classe.grade',
                'choices' => array(
                    'CP' => 'grade.year1',
                    'CE1' => 'grade.year2',
                    'CE2' => 'grade.year3',
                    'CM1' => 'grade.year4',
                    'CM2' => 'grade.year5'
                ),
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );
        $builder->add(
            'annee', 'integer', array(
                'label' => 'classe.year',
                'data' => date("Y"),
                'attr' => array(
                    'placeholder' => "classe.year",
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'ecole',
            'entity',
            array(
                'label' => 'classe.school',
                'class' => 'EklerniDatabaseBundle:Ecole',
                'query_builder' => function (EcoleRepository $er) {
                        return $er->findAll();
                },
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
    public function getName()
    {
        return 'eklerni_classe';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\DatabaseBundle\Entity\Classe',
        ));
    }
} 
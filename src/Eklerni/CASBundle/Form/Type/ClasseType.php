<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:30
 */

namespace Eklerni\CASBundle\Form\Type;

use Eklerni\CASBundle\Repository\EcoleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nom', 'text', array(
                'label' => 'classe.name'
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
                )
            )
        );

        $builder->add('ecole', 'entity', array(
                'label' => 'classe.school',
                'class' => 'EklerniCASBundle:Ecole',
                'query_builder' => function (EcoleRepository $er) {
                        return $er->findAll();
                    },
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
        return 'eklerni_classe';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eklerni\CASBundle\Entity\Classe',
        ));
    }
} 
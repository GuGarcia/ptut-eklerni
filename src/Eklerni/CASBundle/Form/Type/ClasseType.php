<?php
/**
 * Created by PhpStorm.
 * User: Robert-U
 * Date: 20/03/14
 * Time: 10:30
 */

namespace Eklerni\CASBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
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
                'label' => 'Nom'
            )
        );

        $builder->add(
            'niveau', 'choice', array(
                'label' => 'Niveau',
                'choices' => array(
                    'CP' => 'CP',
                    'CE1' => 'CE1',
                    'CE2' => 'CE2',
                    'CM1' => 'CM1',
                    'CM2' => 'CM2'
                )
            )
        );

        $builder->add('ecole', 'entity', array(
                'label' => 'Ecole',
                'class' => 'EklerniCASBundle:Ecole',
                'query_builder' => function (EcoleRepository $er) {
                        return $er->findAll();
                    },
            )
        );

        $builder->add(
            'valider', 'submit'
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
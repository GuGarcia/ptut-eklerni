<?php
/**
 * Created by PhpStorm.
 * User: GarciaGuillaume
 * Date: 14/05/2014
 * Time: 11:18
 */

namespace Eklerni\BackBundle\Form\Type;

use Eklerni\DatabaseBundle\Entity\Enseignant;
use Eklerni\DatabaseBundle\Repository\ActiviteRepository;
use Eklerni\DatabaseBundle\Repository\ClasseRepository;
use Eklerni\DatabaseBundle\Repository\EleveRepository;
use Eklerni\DatabaseBundle\Repository\MatiereRepository;
use Eklerni\DatabaseBundle\Repository\SerieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResultatType extends AbstractType
{

    private $enseignant;

    public function __construct(Enseignant $enseignant)
    {
        $this->enseignant = $enseignant;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'eleve',
            'entity',
            array(
                'label' => 'eleve.text',
                'class' => 'EklerniDatabaseBundle:Eleve',
                'query_builder' => function (EleveRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "parent",
                'empty_value' => 'eleve.choose',
                'required' => false,
            )
        );

        $builder->add(
            'matiere',
            'entity',
            array(
                'label' => 'matiere.text',
                'class' => 'EklerniDatabaseBundle:Matiere',
                'query_builder' => function (MatiereRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "name",
                'empty_value' => 'matiere.choose',
                'required' => false,
            )
        );

        $builder->add(
            'classe',
            'entity',
            array(
                'label' => 'classe.text',
                'class' => 'EklerniDatabaseBundle:Classe',
                'query_builder' => function (ClasseRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "nom",
                'empty_value' => 'classe.choose',
                'required' => false,
            )
        );

        $builder->add(
            'activite',
            'entity',
            array(
                'label' => 'activite.text',
                'class' => 'EklerniDatabaseBundle:Activite',
                'query_builder' => function (ActiviteRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "parent",
                'empty_value' => 'activite.choose',
                'required' => false,
            )
        );

        $builder->add(
            'serie',
            'entity',
            array(
                'label' => 'exercice.text',
                'class' => 'EklerniDatabaseBundle:Serie',
                'query_builder' => function (SerieRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "parent",
                'empty_value' => 'exercice.choose',
                'required' => false,
            )
        );

        $builder->add(
            'limit',
            'integer',
            array(
                'label' => 'limit.text',
                'data' => 100,
                'attr' => array(
                    'class' => 'form-control'
                ),
            )
        );

        $builder->add(
            'date',
            'text',
            array(
                'label' => 'date.text',
                'attr' => array(
                    'class' => 'form-control datepicker'
                ),
                'required' => false,
            )
        );

        $builder->add(
            'tri',
            'integer',
            array(
                'label' => 'limit.text',
                'data' => 10,
                'attr' => array(
                    'class' => 'form-control'
                ),
            )
        );

        $builder->add(
            "moyenne",
            "choice",
            array(
                'choices' => array(
                    "" => 'aucun',
                    'eleve' => 'stats.moyenne.by.eleve',
                    'classe' => 'stats.moyenne.by.classe',
                    'matiere' => 'stats.moyenne.by.matiere',
                    'total' => 'stats.moyenne.by.all'
                ),
                'label' => "moyenne.text",
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        );

        $builder->add(
            'istest',
            'choice',
            array(
                'choices' => array(
                    "" => 'aucun',
                    "true" => 'utils.yes',
                    "false" => 'utils.no'
                ),
                'label' => 'istest.text',
                'required' => false,
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
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'eklerni_resultat';
    }

}
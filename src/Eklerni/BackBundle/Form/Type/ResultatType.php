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
use Eklerni\DatabaseBundle\Repository\EleveRepository;
use Eklerni\DatabaseBundle\Repository\MatiereRepository;
use Eklerni\DatabaseBundle\Repository\SerieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResultatType extends AbstractType {

    private $enseignant;

    public function __construct(Enseignant $enseignant) {
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
                'property' => "fullName",
                'empty_value' => 'Choisissez un eleve',
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
                'empty_value' => 'Choisissez une matiere',
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
                'property' => "name",
                'empty_value' => 'Choisissez une activite',
                'required' => false,
            )
        );

        $builder->add(
            'serie',
            'entity',
            array(
                'label' => 'serie.text',
                'class' => 'EklerniDatabaseBundle:Serie',
                'query_builder' => function (SerieRepository $er) {
                        return $er->findByProf($this->enseignant);
                    },
                'attr' => array(
                    'class' => 'form-control'
                ),
                'property' => "nom",
                'empty_value' => 'Choisissez une serie',
                'required' => false,
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
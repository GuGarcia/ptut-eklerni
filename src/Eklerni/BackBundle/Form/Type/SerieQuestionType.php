<?php

namespace Eklerni\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SerieQuestionType extends AbstractType
{

    private $_questionMedia;
    private $_reponseMedia;

    public function __construct($questionMedia, $reponseMedia)
    {
        $this->_questionMedia = $questionMedia;
        $this->_reponseMedia = $reponseMedia;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $questionMediaType = "Question" . $this->_questionMedia . "Type";
        $builder->add(
            'questions', 'collection', array(
                'type' => new $questionMediaType($this->_reponseMedia),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'eklerni_seriequestion';
    }
}
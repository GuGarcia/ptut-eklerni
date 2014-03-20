<?php

namespace Eklerni\CASBundle\Manager;

use Eklerni\CASBundle\Entity\BaseEntity;
use Eklerni\CASBundle\Entity\Enseignant;

interface CASManagerInterface {

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param BaseEntity $entity
     * @return mixed
     */
    public function findById(BaseEntity $entity);

    /**
     * @param Enseignant $enseignant
     * @return mixed
     */
    public function findByProf(Enseignant $enseignant);

} 
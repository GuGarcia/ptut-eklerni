<?php

namespace Eklerni\DatabaseBundle\Manager;

use Eklerni\DatabaseBundle\Entity\BaseEntity;
use Eklerni\DatabaseBundle\Entity\Enseignant;

interface CASManagerInterface {

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param BaseEntity $entity
     * @return mixed
     */
    public function findById($id);

    /**
     * @param Enseignant $enseignant
     * @return mixed
     */
    public function findByProf(Enseignant $enseignant);

} 
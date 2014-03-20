<?php

namespace Eklerni\CASBundle\Manager;

interface CASManagerInterface {

    /**
     * @return mixed
     */
    public function findByAll();

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
<?php

namespace Eklerni\DatabaseBundle\Repository;

/**
 * Interface CASRepositoryInterface
 * @package Eklerni\DatabaseBundle\Repository
 */
interface CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf);

} 
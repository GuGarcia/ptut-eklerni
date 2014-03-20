<?php

namespace Eklerni\CASBundle\Repository;

/**
 * Interface CASRepositoryInterface
 * @package Eklerni\CASBundle\Repository
 */
interface CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id);

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf);

} 
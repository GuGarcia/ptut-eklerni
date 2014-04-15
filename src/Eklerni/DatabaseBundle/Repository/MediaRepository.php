<?php


namespace Eklerni\DatabaseBundle\Repository;


class MediaRepository implements CASRepositoryInterface
{

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Media", "m");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("m")
            ->from("EklerniDatabaseBundle:Media", "m")
            ->where("m.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return null;
    }
}
<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EnseignantRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Enseignant", "e");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }
}
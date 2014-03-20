<?php

namespace Eklerni\CASBundle\Repository;

class EnseignantRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findByAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Enseignant", "e");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EkleniCASBundle:Enseignant", "e")
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
            ->from("EkleniCASBundle:Enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }
}
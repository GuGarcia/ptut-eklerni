<?php

namespace Eklerni\CASBundle\Repository;

class EleveRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findByAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Eleve", "e");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EkleniCASBundle:Eleve", "e")
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
            ->from("EkleniCASBundle:Ecole", "e")
            ->innerJoin("e.classes","c")
            ->innerJoin("c.enseignant","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);
    }
}
<?php

namespace Eklerni\CASBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EleveRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll()
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
            ->from("EklerniCASBundle:Eleve", "e")
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
            ->from("EklerniCASBundle:Eleve", "e")
            ->innerJoin("e.classe","c")
            ->innerJoin("c.enseignants","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);
    }
}
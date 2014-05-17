<?php

namespace Eklerni\DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EleveRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e");
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniDatabaseBundle:Eleve", "e")
            ->innerJoin("e.classe","c")
            ->innerJoin("c.enseignants","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);
    }
}
<?php

namespace Eklerni\CASBundle\Repository;

class ClasseRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EkleniCASBundle:Classe", "c");
    }

    /**
     * @param $id integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EkleniCASBundle:Classe", "c")
            ->where("c.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("c")
            ->from("EkleniCASBundle:Classe", "c")
            ->innerJoin("c.enseignant","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);

    }

}
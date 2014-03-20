<?php

namespace Eklerni\CASBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EcoleRepository extends EntityRepository implements CASRepositoryInterface {

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Ecole", "e");
    }

    /**
     * @param $id integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Ecole", "e")
            ->where("e.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Ecole", "e")
            ->innerJoin("e.classes","c")
            ->innerJoin("c.enseignant","p")
            ->where("p.id = :id")
            ->setParameter("id", $idProf);
    }

    /**
     * @param $idEleve
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByEleve($idEleve) {
        return $this->_em->createQueryBuilder()
            ->select("e")
            ->from("EklerniCASBundle:Ecole", "e")
            ->innerJoin("e.classes","c")
            ->innerJoin("c.eleves","p")
            ->where("p.id = :id")
            ->setParameter("id", $idEleve);
    }
}
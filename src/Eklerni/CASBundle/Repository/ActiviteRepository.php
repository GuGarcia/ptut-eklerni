<?php

namespace Eklerni\CASBundle\Repository;

class ActiviteRepository extends EntityRepository implements CASRepositoryInterface
{

    /**
     * @return mixed
     */
    public function findByAll()
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniCASBundle:Activite", "a");
    }

    /**
     * @param $id integer
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EklerniCASBundle:Activite", "a")
            ->where("a.id = :id")
            ->setParameter("id", $id);
    }

    /**
     * @param $idProf integer
     * @return mixed
     */
    public function findByProf($idProf)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EkleniCASBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->innerJoin("m.classes", "c")
            ->innerJoin("c.enseignant", "e")
            ->where("e.id = :id")
            ->setParameter("id", $idProf);
    }

    public function findByMatiere($idMatiere)
    {
        return $this->_em->createQueryBuilder()
            ->select("a")
            ->from("EkleniCASBundle:Activite", "a")
            ->innerJoin("a.matiere", "m")
            ->where("m.id = :id")
            ->setParameter("id", $idMatiere);
    }
}